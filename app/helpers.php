<?php

declare(strict_types=1);

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;
use TypiCMS\Modules\Core\Models\File as FileModel;
use TypiCMS\Modules\Core\Models\Page;

if (! function_exists('homeUrl')) {
    function homeUrl(): string
    {
        $uri = '/';
        if (config('typicms.main_locale_in_url') || mainLocale() !== config('app.locale')) {
            $uri .= app()->getLocale();
        }

        return url($uri);
    }
}

if (! function_exists('showAdminButtons')) {
    function showAdminButtons(): bool
    {
        return (bool) auth('web')->user()?->can('see navbar')
            && ! request()->boolean('preview')
            && ! request()->is('*/create-passkey');
    }
}

if (! function_exists('imageOrDefault')) {
    function imageOrDefault(?FileModel $image, ?int $width = null, ?int $height = null): string
    {
        if ($image instanceof FileModel) {
            return $image->render($width, $height);
        }

        return new FileModel()->render($width, $height);
    }
}

if (! function_exists('column')) {
    function column(string $column): string
    {
        return $column.'->'.app()->getLocale();
    }
}

if (! function_exists('locales')) {
    /** @return array<string> */
    function locales(): array
    {
        if (is_array(config('typicms.locales'))) {
            return array_keys(config('typicms.locales'));
        }

        return [];
    }
}

if (! function_exists('enabledLocales')) {
    /** @return array<string> */
    function enabledLocales(): array
    {
        $locales = [];
        foreach (locales() as $locale) {
            if (config('typicms.'.$locale.'.status') || request('preview')) {
                $locales[] = $locale;
            }
        }

        return $locales;
    }
}

if (! function_exists('localeAndRegion')) {
    function localeAndRegion(?string $separator = null, ?string $locale = null): ?string
    {
        $localeAndRegion = Arr::get(config('typicms.locales'), app()->getLocale());
        if (! is_null($separator)) {
            return str_replace('_', $separator, $localeAndRegion);
        }

        return $localeAndRegion;
    }
}

if (! function_exists('mainLocale')) {
    function mainLocale(): string
    {
        return Arr::first(locales()) ?? '';
    }
}

if (! function_exists('isLocaleEnabled')) {
    function isLocaleEnabled(string $locale): bool
    {
        return in_array($locale, enabledLocales(), true);
    }
}

if (! function_exists('modules')) {
    /** @return array<string> */
    function modules(): array
    {
        $modules = config('typicms.modules');
        ksort($modules);

        return $modules;
    }
}

if (! function_exists('getModulesForSelect')) {
    /** @return array<string, string> */
    function getModulesForSelect(): array
    {
        $modules = config('typicms.modules');
        $options = ['' => ''];
        foreach ($modules as $module => $properties) {
            if (isset($properties['linkable_to_page']) && $properties['linkable_to_page'] === true) {
                $options[$module] = __(ucfirst((string) $module));
            }
        }

        asort($options);

        return $options;
    }
}

if (! function_exists('permissions')) {
    /** @return array<string, array<mixed>> */
    function permissions(): array
    {
        $permissions = [];
        foreach (config('typicms.modules') as $module => $data) {
            if (isset($data['permissions']) && is_array($data['permissions'])) {
                $key = (string) __(ucfirst((string) $module));
                $permissions[$key] = $data['permissions'];
            }
        }

        ksort($permissions, SORT_LOCALE_STRING);

        return $permissions;
    }
}

if (! function_exists('websiteTitle')) {
    function websiteTitle(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        return config('typicms.'.$locale.'.website_title');
    }
}

if (! function_exists('appBaseline')) {
    function appBaseline(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        return config('typicms.'.$locale.'.website_baseline');
    }
}

if (! function_exists('getMigrationFileName')) {
    function getMigrationFileName(string $name, int $count = 0): string
    {
        $directory = database_path(DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR);
        $migrations = File::glob($directory.'*_'.$name.'.php');

        return $migrations[0] ?? $directory.date('Y_m_d_His', time() + $count).'_'.$name.'.php';
    }
}

if (! function_exists('getPagesLinkedToModule')) {
    /** @return array<int, Page> */
    function getPagesLinkedToModule(?string $module = null): array
    {
        $module = mb_strtolower((string) $module);
        $routes = resolve('typicms.routes');

        $pages = [];
        foreach ($routes as $page) {
            if ($page->module === $module) {
                $pages[] = $page;
            }
        }

        return $pages;
    }
}

if (! function_exists('getPageLinkedToModule')) {
    function getPageLinkedToModule(?string $module = null): ?Page
    {
        $pages = getPagesLinkedToModule($module);

        return Arr::first($pages);
    }
}

if (! function_exists('feeds')) {
    /** @return Collection<(int|string), array{url: string, title: string}> */
    function feeds(): Collection
    {
        $locale = config('app.locale');

        return collect((array) config('typicms.modules'))
            ->transform(function (array $properties, string $module) use ($locale): ?array {
                $routeName = $locale.'::'.$module.'-feed';
                if (isset($properties['has_feed']) && $properties['has_feed'] === true && Route::has($routeName)) {
                    return [
                        'url' => route($routeName, $module),
                        'title' => __(ucfirst($module).' feed').' – '.websiteTitle(),
                    ];
                }

                return null;
            })
            ->reject(fn ($value): bool => $value === null);
    }
}

if (! function_exists('pageTemplates')) {
    /** @return array<string, string> */
    function pageTemplates(): array
    {
        /** @var FileViewFinder $finder */
        $finder = View::getFinder();
        $hints = $finder->getHints()['pages'] ?? [];
        $path = collect($hints)->map(fn (string $hint): string => "{$hint}/public")->first(
            fn (string $dir): bool => File::isDirectory($dir),
        );

        if ($path === null) {
            return ['' => 'Default'];
        }

        $templates = [];
        foreach (File::files($path) as $file) {
            $filename = File::name($file->getPathname());
            if ($filename === 'default.blade') {
                continue;
            }

            $name = str_replace('.blade', '', $filename);
            $label = ucfirst(str_replace('-', ' ', $name));
            if ($name[0] !== '_' && $name !== 'master') {
                $templates[$name] = $label;
            }
        }

        return ['' => 'Default'] + $templates;
    }
}

if (! function_exists('pageSectionTemplates')) {
    /** @return array<string, string> */
    function pageSectionTemplates(): array
    {
        /** @var FileViewFinder $finder */
        $finder = View::getFinder();
        $hints = $finder->getHints()['pages'] ?? [];
        $path = collect($hints)->map(fn (string $hint): string => "{$hint}/public")->first(
            fn (string $dir): bool => File::isDirectory($dir),
        );

        if ($path === null) {
            return ['default' => 'Default'];
        }

        $templates = [];
        foreach (File::files($path) as $file) {
            $filename = File::name($file->getPathname());
            if ($filename === '_section-default.blade') {
                continue;
            }

            if (str_starts_with($filename, '_section-')) {
                $name = str_replace(['_section-', '.blade'], '', $filename);
                $label = ucfirst(str_replace('-', ' ', $name));
                $templates[$name] = $label;
            }
        }

        return ['default' => 'Default'] + $templates;
    }
}
