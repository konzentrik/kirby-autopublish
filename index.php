<?php

namespace konzentrik\AutoPublish;

use Kirby\Cms\App as Kirby;

Kirby::plugin("konzentrik/autopublish", [
    'blueprints' => require_once(__DIR__ . '/plugin/blueprints.php'),
    'routes' => require_once(__DIR__ . '/plugin/routes.php'),
]);
