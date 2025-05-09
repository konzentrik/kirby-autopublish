<?php

namespace konzentrik\AutoPublish;

use Kirby\Http\Response;

return [
    [
        'pattern' => 'autopublish/cron/(:any)',
        'method' => 'GET',
        'action' => function ($secret) {
            if (option('konzentrik.autopublish.secret', '') === $secret) {
                $dateField = option('konzentrik.autopublish.dateField', 'autopublishDate');

                $unpublishedPages = kirby()->site()->index()->drafts()->filter(function ($page) use ($dateField) {
                    return $page->$dateField()->toDate() <= time();
                })->filterBy('autopublish', '==', true);

                kirby()->impersonate('kirby');
                foreach ($unpublishedPages as $page) {
                    $page->changeStatus('listed');
                }

                return new Response('OK', 'text/plain');
            }

            return new Response('Forbidden', 'text/plain', 401);
        }
    ],
];
