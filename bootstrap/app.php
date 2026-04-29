<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Sentry\Laravel\Integration;
use Spatie\MarkdownResponse\Middleware\ProvideMarkdownResponse;
use Spatie\ResponseCache\Middlewares\CacheResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use TypiCMS\Modules\Core\Http\Middleware\Impersonate;
use TypiCMS\Modules\Core\Http\Middleware\JavaScriptData;
use TypiCMS\Modules\Core\Http\Middleware\PoweredByHeader;
use TypiCMS\Modules\Core\Http\Middleware\PublicAccess;
use TypiCMS\Modules\Core\Http\Middleware\SetContentLocale;
use TypiCMS\Modules\Core\Http\Middleware\SetLocaleFromUrl;
use TypiCMS\Modules\Core\Http\Middleware\SetLocaleFromUser;
use TypiCMS\Modules\Core\Http\Middleware\SetTranslatableFallbackLocaleToNull;
use TypiCMS\Modules\Core\Http\Middleware\UserPrefs;
use TypiCMS\Modules\Core\Http\Middleware\VerifyLocalizedUrl;
use TypiCMS\Modules\Core\Providers\PagesRoutesServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function (Application $app): void {
            $app->booted(function ($app): void {
                $app->register(PagesRoutesServiceProvider::class);
            });
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api([
            SetLocaleFromUser::class,
        ]);
        $middleware->appendToGroup('public', [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            PreventRequestForgery::class,
            SubstituteBindings::class,

            ProvideMarkdownResponse::class,
            CacheResponse::class,
            PoweredByHeader::class,
            Impersonate::class,
            SetLocaleFromUrl::class,
            VerifyLocalizedUrl::class,
            PublicAccess::class,
        ]);
        $middleware->appendToGroup('admin', [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            PreventRequestForgery::class,
            SubstituteBindings::class,

            Authenticate::class,

            SetTranslatableFallbackLocaleToNull::class,
            SetLocaleFromUser::class,
            SetContentLocale::class,

            Impersonate::class,

            JavaScriptData::class,
            UserPrefs::class,
        ]);
        $middleware->redirectGuestsTo(fn (Request $request): string => route(
            ($request->getPreferredLanguage(enabledLocales()) ?? mainLocale()).'::login',
        ));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->dontReport([]);

        $exceptions->render(function (HttpException $e, Request $request) {
            $statusCode = $e->getStatusCode();
            if ($request->is('admin/*') && view()->exists('admin::errors.'.$statusCode)) {
                return response()->view('admin::errors.'.$statusCode, [], $statusCode);
            }
        });

        if (app()->bound('sentry')) {
            Integration::handles($exceptions);
        }
    })
    ->create();
