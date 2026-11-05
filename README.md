# TypiCMS

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Larastan](https://img.shields.io/badge/PHPStan-level%2010-brightgreen.svg?style=flat-square)](https://github.com/nunomaduro/larastan)

TypiCMS is a modular multilingual content management system built with [Laravel](https://laravel.com). Out of the box you can manage pages, events, news, places, menus, translations, and more.

![TypiCMS screenshot](https://typicms.org/uploads/files/typicms-screenshot.png?2)

## Table of contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
  - [Assets](#assets)
  - [Locales configuration](#locales-configuration)
  - [Installation of a module](#installation-of-a-module)
  - [Module scaffolding](#module-scaffolding)
- [Available modules](#available-modules)
  - [Pages](#pages)
  - [Menus](#menus)
  - [Projects](#projects)
  - [Tags](#tags)
  - [Events](#events)
  - [News](#news)
  - [Contacts](#contacts)
  - [Partners](#partners)
  - [Files](#files)
  - [Users and roles](#users-and-roles)
  - [Blocks](#blocks)
  - [Translations](#translations)
  - [Sitemap](#sitemap)
  - [llms.txt](#llmstxt)
  - [JSON-LD](#json-ld)
  - [Markdown responses](#markdown-responses)
  - [Settings](#settings)
  - [History](#history)
- [Artisan commands](#artisan-commands)
- [Change log](#change-log)
- [Contributing](#contributing)
- [Credits](#credits)
- [Licence](#licence)

## Features

- **Multilingual** — full support for multiple languages with locale-prefixed URLs
- **Modular** — install only the modules you need; publish and customize any of them
- **Dark mode** — the admin panel supports both light and dark themes
- **Rich text editing** — [TipTap](https://tiptap.dev) editor with support for floating images, tables, YouTube embeds, iframes, and an HTML source view
- **Passkey and OTP authentication** — secure, passwordless login options for admin users
- **Page sections** — pages can have multiple content sections, each with its own template
- **Nestable pages and menus** — drag-and-drop reordering with automatic URI generation
- **File management** — upload and organize images, documents, and folders with [Uppy](https://uppy.io), image cropping with [Cropper.js](https://fengyuanchen.github.io/cropperjs/), and SVG sanitization on upload
- **Roles and permissions** — fine-grained access control via [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- **History log** — create, update, delete, online, and offline events are logged and shown in the dashboard
- **SEO friendly** — automatic `sitemap.xml`, locale-aware `llms.txt`, and a reusable `<x-json-ld>` Blade component for structured data
- **Markdown responses** — every public page can be served as Markdown by appending `.md` to the URL or sending an `Accept: text/markdown` header
- **Vue.js 3** frontend powered by [Vite](https://vitejs.dev) and written in TypeScript

### URLs

The CMS manages the following URL patterns:

**Modules:**

- /en/events/slug-in-english
- /fr/evenements/slug-en-francais

**Pages:**

- /en/parent-page-slug/subpage-slug/page-slug
- /fr/slug-parent/slug-sous-page/slug-page

## Requirements

- PHP 8.4+
- MySQL, MariaDB, or PostgreSQL

For all server requirements, see the [Laravel deployment documentation](https://laravel.com/docs/master/deployment#server-requirements).

## Installation

```
composer create-project typicms/typicms mywebsite
```

---

Go to https://mywebsite.test/admin and log in using a password.

### Assets

Assets are bundled with [Vite](https://laravel.com/docs/master/vite). Install [Bun](https://bun.sh), then run:

1. Install npm packages:

    ```
    bun install
    ```

2. Start the development server:

    ```
    bun run dev
    ```

3. Build for production:

    ```
    bun run prod
    ```

### Locales configuration

1. Set the locales in `config/typicms.php`. The first key of this array is the main locale and must match the locale defined in `config/app.php`.
2. Set `main_locale_in_url` in `config/typicms.php` to `true` or `false` depending on whether you want the main locale to appear in the URL.

### Installation of a module

The following example installs the News module. After these steps, the module will appear in the admin sidebar.

1. Install the module with Composer:

    ```
    composer require typicms/news
    ```

2. Publish the views and migrations:

    ```
    php artisan vendor:publish
    ```

3. Run the database migration:

    ```
    php artisan migrate
    ```

### Module scaffolding

To generate a new custom module called Cats:

1. Create the module:

    ```
    php artisan typicms:create cats
    ```

2. The module is created in `/Modules/Cats`. Customize it as needed.
3. Add `TypiCMS\Modules\Cats\Providers\ModuleServiceProvider::class,` to `bootstrap/providers.php`, in the _TypiCMS Modules Service Providers_ section.
4. Run the migration:

    ```
    php artisan migrate
    ```

## Available modules

Each module can be [published](#publish-a-module) to be tracked by git and customized locally.

### Pages

Pages are nestable with drag and drop. On a drop, URIs are regenerated and saved in the database. Each translation of a page has its own route. A page can be linked to a module and can have multiple sections, each using its own template.

The admin panel includes a searchable pages tree with keyboard-accessible expand/collapse controls.

### Menus

Each menu has nestable entries. An entry can link to a page or a URL, and can optionally link to a specific section of a page.

Render an HTML menu in a Blade file with `@menu('menuname')`.

### Projects

Projects have categories. Project URLs follow this pattern: `/en/projects/category-slug/project-slug`.

### Tags

Tags support polymorphic many-to-many relations, so they can be linked to any module. The tag input uses [Tom Select](https://tom-select.js.org).

### Events

Events have starting and ending dates.

### News

News module.

### Contacts

Frontend contact form with admin-side records management. Notifications are sent to the visitor and the webmaster.

### Partners

A partner has a logo, website URL, title, and body content.

### Files

The file manager lets you upload and organize images, documents, and folders. File uploads use [Uppy](https://uppy.io) with drag-and-drop support and a compression step before upload. Images can be cropped using [Cropper.js](https://fengyuanchen.github.io/cropperjs/). SVG files are sanitized on upload. Images can be swapped in place from the file manager.

To store original images on a remote service such as Amazon S3 while serving cropped images from local disk, set `FILESYSTEM_DRIVER=s3` in your `.env` file and configure `croppa.php` accordingly.

### Users and roles

Admins can authenticate with a passkey or a one-time password in addition to a standard password. User registration can be enabled in the settings panel (`/admin/settings`). Roles and permissions are managed with [spatie/laravel-permission](https://github.com/spatie/laravel-permission). Admins can impersonate users.

### Blocks

Blocks let you display custom content in your views.

Render a block in Blade with `Blocks::render('blockname')` or `@block('blockname')`.

### Translations

Translations can be managed in the database via the admin panel (`/admin/translations`).

Retrieve a translation using the standard Laravel helpers: `__('Key')`, `trans('Key')`, or `@lang('Key')`.

### Sitemap

A sitemap is generated automatically from all published pages. It is available at `/sitemap.xml`.

### llms.txt

A locale-aware [`llms.txt`](https://llmstxt.org) file is generated automatically and served at `/llms.txt`. It lists published pages and module content so that LLM-based agents can discover and index the site.

### JSON-LD

The Pages, News, Events, Places, and Partners modules ship with [Schema.org](https://schema.org) structured data via the reusable `<x-core::json-ld>` Blade component. Use it in your own views to add structured data for any model:

```blade
<x-core::json-ld :schema="[
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $model->title,
]" />
```

### Markdown responses

Every public route can be served as Markdown thanks to [spatie/laravel-markdown-response](https://github.com/spatie/laravel-markdown-response). Append `.md` to any URL (e.g. `/en/about.md`) or send an `Accept: text/markdown` header, and the same controller will return a Markdown representation of the page — handy for LLM consumption and feeding `llms.txt` clients.

### Settings

Manage the website title, baseline, description, contact details (email, phone, address), logo, and other global options in the settings panel (`/admin/settings`).

### History

Create, update, delete, online, and offline events are logged in the database. The most recent records are shown on the back-office dashboard.

## Artisan commands

### Install TypiCMS

```
php artisan typicms:install
```

### Run the initial migration and seed

```
php artisan typicms:database
```

This command is called automatically by `typicms:install`.

### Create a superuser

```
php artisan typicms:user
```

### Publish a module

To customize a module — for example, to add fields or a relation — publish it:

```
php artisan typicms:publish <modulename>
```

This will:

1. Publish the module's views and migrations.
2. Copy the module source to `/Modules/<Modulename>`.
3. Remove the Composer package with `composer remove typicms/<modulename>`.

Once published, the module lives in `/Modules/<Modulename>` and is tracked by git, so changes are preserved across `composer update` runs.

## Changelog

Please see [CHANGELOG](https://github.com/TypiCMS/Base/blob/master/CHANGELOG.md) for more information on what has changed.

## Contributing

Please see [CONTRIBUTING](https://github.com/TypiCMS/Base/blob/master/CONTRIBUTING.md) for details.

## Credits

- [Samuel De Backer](https://github.com/sdebacker)
- [All contributors](https://github.com/TypiCMS/Base/graphs/contributors)

## License

TypiCMS is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).
