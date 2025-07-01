# Autopublish

![GitHub release](https://img.shields.io/github/release/konzentrik/kirby-autopublish.svg?maxAge=1800) ![License](https://img.shields.io/github/license/mashape/apistatus.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-4%2B-black.svg)

![Header](/assets/autopublish-header.png)

This Kirby plugin will auto publish selected pages. Enable auto publishing for certain pages in the panel and set a date when to publish the page. Autopublish will handle the rest.

---

## Installation

Use one of these methods to install the plugin:

- composer (recommended): `composer require konzentrik/konzentrik`
- zip file: unzip [main.zip](https://github.com/konzentrik/kirby-autopublish/releases/latest) as folder `site/plugins/autopublish`

## Usage

### Add panel fields

Add the `autopublish` field to your page blueprint:

```yaml
fields:
  autopublish: fields/autopublish
```

Or add the toggle and date field by yourself:

```yaml
fields:
  autopublish:
    label: Autopublish
    type: toggle
    translate: false
  autopublishDate:
    label: Autopublish Date
    type: date
    time: true
    translate: false
    when:
      autopublish: true
```

If you already have a date field you want to use, you can configure the plugin to use it, by setting this option in your `config.php`

```php
'konzentrik.autopublish.dateField' => 'my-date-field',
```

### Configure and use the webhook

First set a secret in your `config.php`:

```php
'konzentrik.autopublish.secret' => 'my-secret',
```

You can now trigger the Webhook:

`https://example.com/autopublish/cron/my-secret`

Replace example.com with your hostname and `my-secret` with the secret you set in your config.php. Whenever you trigger the Webhook the plugin will look for unpublished pages with a date older or equal to the current date-time and then publishes the page.

## Options

Please make sure to prefix all options with `konzentrik.autopublish` or use the array notation.

| Option      | Default             | Description                       |
| ----------- | ------------------- | --------------------------------- |
| `dateField` | `'autopublishDate'` | The field name of your date field |
| `secret`    | `''`                | A secret to secure the webhook    |
