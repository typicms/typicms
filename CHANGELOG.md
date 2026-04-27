# Changelog

All notable changes to TypiCMS will be documented in this file.

## 17.0.0 - 2026

### Changed

- Laravel 13
- PHP 8.4 required
- Base model replaced by traits
- Presenter pattern replaced by presenter traits
- JSON-LD structured data migrated to `<x-core::json-ld>` Blade component for News, Events, Places, Partners, and Pages
- Croppa 8
- Security fixes
- View composers removed: use app()->getLocale() in place of $lang and websiteTitle() in place of $websiteTitle

### Added

- spatie/laravel-responsecache for response caching on public routes
- spatie/laravel-markdown-response middleware on public routes
- `llms.txt` route with pages and module content
- PHPStan level 8 configuration with Larastan
- Rector configuration for code modernization
- Test (with Pest)

### Removed

- genealabs/laravel-model-caching
- Laracasts/Presenter package

## 16.1.8 - 2026-02-21

### Changed

- SVG files are now sanitized during upload. Run `composer require enshrined/svg-sanitize`

## 16.1.0 - 2026-01-14

### Added

- Default section template support.
- Page section edit button for quick editing.
- Display tagged items in tag admin form.
- Show locale indicator in TipTap editor label.
- Show template name in section list.
- TipTap editor: floating images support.

### Changed

- Section form displayed on two columns.
- Template field is now required in section form.
- Refactored slug generation and uniqueness checks.
- Improved form validation and page selection in link dialog.
- Enhanced filename normalization in file uploads.
- Improved error handling in item deletion.
- Stricter code across all packages.
- Removed v-html usage for improved accessibility.

### Fixed

- Repeater component bug.
- Move to parent folder button enable logic in file manager.
- HTML decoding in TipTap HTML observer.
- Menu link cache now properly flushed after page update.

## 16.0.12 - 2025-11-24

### Added

- Ability to configure the sidebar label and group of each module.

## 16.0.6 - 2025-11-12

### Added

- Search functionality added to admin pages tree.
- TipTap editor: source code button to view/edit HTML source.
- TipTap editor: iframe embed support.
- Search the pages tree.

## 16.0.0 - 2025-11-02

### Changed

- Spatie/Translatable replaced by TypiCMS\translatable
- Validation rules specified as arrays

## 15.0.11 - 2025-10-08

### Changed

- Use Uppy headless components in place of Dashboard.
- Breaking change: add Cropper.js by running `bun add cropperjs@^1.6.2 --dev` and republish TypiCMS Core files.

## 15.0.11 - 2025-09-27

### Changed

- Use of Compressor.js, run `bun add @uppy/compressor --dev`.

## 15.0.10 - 2025-09-26

### Changed

- Uppy 5 – You will have to republish the FileManagerContent.vue file.
- Swiper 12 – You will have to republish the swiper.scss file.

## 15.0.8 - 2025-09-17

### Changed

- Alt + click on a checkbox in the pages and menu links trees will check and expand all child items.
- Toggle arrows in the pages and menu links trees are now accessible with keyboard.

## 15.0.7 - 2025-09-15

### Changed

- Added checkboxes to the pages and menu links trees in the admin panel.
- To expand or collapse all child items in the pages and menu links trees, hold the Option key while clicking.

## 15.0.0 - 2025-08-18

### Changed

- Refreshed UI with dark mode support
- Passkey and one time password authentication
- Tiptap editor in place of CKEditor
- Lucide in place of Bootstrap Icons

## 14.0.4 - 2025-03-31

### Changed

- Use of Vue.js composition API

## 14.0.0 - 2025-03-26

### Changed

- Vue.js 3

### Added

- Ability to swap a file in the file manager

## 13.0.0 - 2025-03-04

### Changed

- Laravel 12

## 12.0.0 - 2025-01-23

### Changed

- Laravel 11
- Images from `/public/img` directory moved to `/resources/images` directory.
- TypiCMS Service class and Facade removed, use `/app/helpers.php` instead.
- Open Graph Image field added to pages, news, events, projects, places.
- Models’ method `uri()` replaced by method `url()`.
- Use of `app()->getLocale()` in place of `config('app.locale')`.
- password_resets table renamed to password_reset_tokens
- Uppy 4

## 11.0.20 - 2024-01-10

### Changed

- Breaking change: 3 files need to be republished. To do so, you can run these commands: `cp vendor/typicms/core/resources/js/admin/set-content-locale.ts resources/js/admin/`, `cp vendor/typicms/core/resources/js/admin/preview-window.ts resources/js/admin/` and `cp vendor/typicms/core/resources/views/core/admin/_buttons-form.blade.php resources/views/vendor/core/admin/`.

## 11.0.11 - 2023-11-02

### Changed

- Breaking change: Use of Laravel/prompt package for the TypiCMS commands. You have to run `composer require laravel/prompts`.

## 11.0.3 - 2023-07-26

### Changed

- Use of @remotedevforce/tom-select in place of tom-select npm package.

## 11.0.0 - 2023-07-14

### Changed

- Laravel 10
- Bootstrap 5.3
- Removed: jQuery, Lodash, axios and webpack removed.
- Uppy for file uploads.
- PhotoSwipe for viewing images.
- PHP CS Fixer (and Laravel Pint) rules changed.
- Blade files formatted with Prettier.
- JavaScript files rewritten to TypeScript.

## 10.0.19 - 2022-07-01

### Changed

- Vue.js 2.7
- Bootstrap 5.2 (you will have to add `@import '../../../node_modules/bootstrap/scss/maps';` in your bootstrap.scss files)

## 10.0.9 - 2022-05-20

### Changed

- Breaking change: In `config/app.php`, you have to move `TypiCMS\Modules\Core\Providers\ModuleServiceProvider::class,` above the _TypiCMS Modules Service Providers_ and add `TypiCMS\Modules\Core\Providers\PagesRoutesServiceProvider::class,` at the end of the `providers` array.

## 10.0.6 - 2022-05-15

### Added

- Support for WebP (Croppa 6 uses Intervention Image).

### Changed

- Breaking change: Because of Bkwld/Croppa v6, you have to republish the config file by running `php artisan vendor:publish --tag=croppa-config`.
- Breaking change: Croppa facade changed from `Bkwld\Croppa\Facade` to `Bkwld\Croppa\Facades\Croppa`.

## 10.0.0 - 2022-04-27

### Added

- Ability to impersonate users
- Translatable title field added to files
- Page sections templates
- Events module has a simple reservation system

### Changed

- Tables name changed: permission_role to role_has_permissions, role_user to model_has_role, permission_user to model_has_permissions.
- Table primary keys are now big increments.
- Modules Pages, Menus, Users, Roles, Files, Tags, Taxonomies, Blocks, History, Setting, Translations are now part of Core.
- TypiCMS config file structure has changed.
- laravelium/feed replaced by spatie/laravel-feed.

## 9.0.17 - 2021-03-24

### Changed

- Bootstrap 5 beta3
- Assets compiled during installation process.

## 9.0.12 - 2021-02-25

### Changed

- The locales should now be configured in config/typicms.php
- The SetLocale middleware is now splited in four smaller middlewares: AddLocaleToRootUrl, VerifyLocalizedUrl, SetLocaleFromUrl and SetSystemLocale.
- New permission added: see unpublished items

## 9.0.4 - 2021-01-25

### Changed

- The route named 'dashboard' is renamed to 'admin::dashboard'.

## 9.0.3 - 2021-01-20

### Changed

- CKEditor: oEmbed plugin remplaced by Embed.

## 9.0.0 - 2021-01-07

### Changed

- Bootstrap 5
- Laravel Mix 6

## 8.0.0 - 2020-10-01

### Added

- Description textarea added to menu links
- A menu link can be linked to a section of a page
- Export to Excel functionality added to some modules
- Facebook App Id & Twitter fields added to settings
- Search module
- Subscriptions module, works with Laravel Cashier for Mollie
- Forum module
- New Artisan command to create a superuser (php artisan typicms:user)

### Changed

- Laravel 8
- ModuleProvider are renamed to ModuleServiceProvider
- Permissions are now shared with the frontend
- Font Awesome replaced by Bootstrap Icons
- $request->all() replaced everywhere by $request->validated()

## 7.0.39 - 2020-07-08

### Added

- LiveReload preloaded, can be enabled in webpack.mix.js.

### Fixed

- Use of Node Sass in place of Dart Sass, Node Sass consumes less memory and is faster.

## 7.0.35 - 2020-06-09

### Added

- Added the possibility to specify IP’s that can see the website without login, when the website is protected by a login and a password.

## 7.0.34 - 2020-04-15

### Fixed

- The SetLocale middleware has been removed from the web group, allowing to use Laravel Telescope without further config. The SetLocale middleware has been added to the routes of the Users module.

## 7.0.31 - 2020-04-06

### Added

- Added the possibility to make links to CMS pages via CKEditor.

## 7.0.13 - 2019-12-09

### Changed

- The CKEditor directory has changed from public/components/ckeditor to ckeditor4. Please republish assets and update you blade views to point to this new directory. Also, there are now two initial possible configurations: config-full (class .ckeditor-full in markup) and config-light (class .ckeditor-light in markup).

## 7.0.0 - 2019-09-04

### Changed

- Upgraded to Laravel 6.
- Return type definitions in models and controllers
- Repositories removed, queries are now cached with genealabs/laravel-model-caching

## 6.0.7 - 2019-05-08

### Changed

- This version contains a breaking change in the croppa config file ('path' value). Please copy the content of the config file at this address: `https://github.com/TypiCMS/Base/blob/master/config/croppa.php` and paste it into your project’s `/config/croppa.php` file.

## 6.0.0 - 2019-04-06

### Changed

- Upgraded to Laravel 5.8.
- An image_id field was added to each module.
- Use of json-ld in place of microdata for structured content.
- [Module Events] A route was added to view past events.
- Classes name in views changed.
- Email verification added to the Users module.
- Make use of Laravel notification system in Contacts module.
- Login, register, forgot password views are now translated.
- In the core presenter, the thumb() method was renamed to image().

## 5.0.0 - 2018-09-29

### Changed

- Vue.js in place of angular
- Server side lists in admin
- Many other enhancements

## 4.0.0 - 2018-05-14

### Changed

- Bootstrap 4
- CKEditor 4.9
- Page model: the method 'children' is renamed to 'subpages'.
- pagesState cookie renamed to typicms_pagestree

## 3.0.0 - 2017-09-01

### Changed

- Upgraded to Laravel 5.5 LTS
- Use of Laravel Mix
- Use of translation strings stored in json files
- New filemanager with directories and drag and drop
- A page can have sections
- Use of spatie/laravel-translatable in place of dimsav/laravel-translatable
- Use of rinvex/repository
- locales() helper method to get an array of all locales
- @block('name') blade directive
- @menu('name') blade directive
- Better roles and permissions management

## 2.8.0 - 2016-04-13

### Changed

- Groups is replaced by roles
- Permissions are now stored in database, see [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- Preview button in form is only present when the module is linked to a page.
- Routes name in admin have changed from **admin.{module}.{action}** to admin::{action}-{module(s)}
- index, edit and create methods where removed from BaseAdminController.

## 2.7.25 - 2016-03-29

### Changed

- Class img-responsive removed from core presenter method thumb().
- width and height attributes added to <img> tag generated by thumb() in core presenter.

## 2.7.15 - 2016-03-13

### Fixed

- Bug where old input value where empty when form validation failed.

## 2.7.14 - 2016-03-09

### Added

- app/helpers.php file autoloaded.
- mb_ucfirst method in helpers.php.

## 2.7.6 - 2016-02-15

### Added

- Offcanvas navigation on public side.

## 2.7.5 - 2016-02-08

### Changed

- Possibility to show every languages in a form.

### Breaking change

- Replace file /resources/assets/js/admin/set-content-locale.js with https://github.com/TypiCMS/TypiCMS/blob/master/resources/assets/js/admin/set-content-locale.js
- Add 'languages.all' key in /resources/lang/\*/global.php

## 2.7.3 - 2016-02-05

### Changed

- Angular 1.5, CKEditor 4.5.7, jQuery 2.2.0 (Drop IE 8 support).

## 2.7.0 - 2016-02-04

### Changed

- Translatable fields are grouped by fields, not by locale, TypiCMS now use Propaganistas\LaravelTranslatableBootForms.
- Bower is removed from TypiCMS.

## 2.6.6 - 2016-01-13

### Fixed

- Bug with PHP < 7 in history module.

## 2.6.3 - 2016-01-06

### Added

- Command typicms:create {module} to scaffold a module.

## 2.6.0 - 2016-01-03

### Added

- Command typicms:publish {module} to move a module from vendor directory to the Modules directory.
- Added a button to clear latest changes in dashboard.
- TypiCMS now require Laravel 5.2.

### Fixed

- Old value are preserved in tags and date fields when a form has errors.
- When Tags module was loaded, there was a query to get all tags on every requests.
- API GET methods are now protected.
- Find nearest address is repaired in Places module.

### Removed

- TypiCMS@logo(), TypiCMS@logoOrTitle() method.
- Methods previously marked @deprecated are removed.
- Menulinks module has been merged with Menus.

## 2.5.21 - 2015-12-19

### Fixed

- Disabling all "Online" languages throws error #38.
  BREAKING CHANGE: in app/Http/Kernel.php, move PublicLocale middleware from $middleware to $routeMiddleware array.

## 2.5.18 - 2015-12-15

### Added

- Multiple pages can be linked to same module (require modules Core 2.5.10 and Pages 2.5.5).

## 2.5.12 - 2015-10-29

### Added

- Redirect + Notification on TokenMismatchException in place of server error.

## 2.5.0 - 2015-10-19

### Added

- Custom script (clear-compiled) to avoid composer update issues. See https://github.com/laravel/framework/issues/9678.
- Pages can be saved to static html files in the public/html directory, to be served directly by the webserver. See config/typicms.html_cache.
- New command `php artisan clear-html` to empty the public/html directory.
- Pages that shouldn't be cached have a no_cache attribute.
- cviebrock/image-validator 2.0

### Changed

- dimsav/laravel-translatable 5.2
- adamwathan/bootforms 0.7
- edvinaskrucas/notification 5.1
- TypiCMS coding style follows the "recommended" preset of StyleCI. See https://styleci.readme.io/docs/presets#recommended

### Fixed

- TypiCMS can be installed on systems without memcached.
- Edvinaskrukas/Notification system was misconfigured.

## 2.4.32 - 2015-10-14

### Changed

- BREAKING CHANGE: Add this line after publicAccess in routeMiddleware array: 'publicCache' => \TypiCMS\Modules\Core\Http\Middleware\PublicCache::class,
- BREAKING CHANGE: Add a new column in pages table: `no_cache` tinyint(1) NOT NULL DEFAULT '0'.

## 2.4.24 - 2015-09-25

### Changed

- BREAKING CHANGE: store and update methods where removed from TypiCMS\Modules\Core\Http\Controllers\BaseApiController, so you will have to implement these methods in your custom modules ApiController classes.

## 2.4.18 - 2015-08-09

### Added

- Dynamic links to a resource in text editor, for example {!! page:3 !!} or {!! news:5 !!}

## 2.4.13 - 2015-08-01

- CKEditor 4.5.1

## 2.4.12 - 2015-08-01

- Angular 1.4
- Font Awesome 4.4
- npm in place of Bower when possible

## 2.4.4 - 2015-06-30

- bkwld/croppa 4.2

## 2.4.0 - 2015-06-09

### Changed

- Laravel 5.1

## 2.3.0 - 2015-05-26

### Changed

- Authentication is now based on Laravel Auth.
- Composer set to "minimum-stability": "stable"
- Better wysiwyg filepicker

### Removed

- Cartalyst/Sentry (No more throttling feature)
- angular-gettext
- cviebrock/image-validator

## 2.2.0 - 2015-05-10

### Added

- Laracasts\Presenter package

### Changed

- Core module Namespace is now TypiCMS\Modules\Core.

## 2.1.6 - 2015-04-28

### Added

- A page can be private.
- Content of a page linked to a module is shown in module’s list template.
- Contacts module has an event that send mail to visitor and webmaster.
- laracasts/generators package added.
- CKEditor autocorrect plugin.
- Assets versionning with elixir.
- Possibility to upload the website logo via settings module in admin interface.
- During page creation, possibility to add it to a menu.
- (BETA) Enabling config/typicms.html_cache cause frontend pages being saved as static html in public/html folder.

### Changed

- Locale is no more stored in page’s uri.

### Fixed

- Lot of code cleaning and bug fixes.
