<?php

/*
|--------------------------------------------------------------------------
| Bootstrap WP for Artisan
|--------------------------------------------------------------------------
| If using a symlink to develop locally, specify your local project path.
| Or, if installed normally the parent path should work.
*/
if (!defined('DB_HOST')) {
    $wpLoadLocal = realpath("/Users/builder/Projects/wp-lumen-local/wp-load.php");
    $wpLoadParent = realpath(__DIR__ . "/../../../../wp-load.php");
    if (is_file($wpLoadParent)) {
        require_once($wpLoadParent);
    } elseif (is_file($wpLoadLocal)) {
        require_once($wpLoadLocal);
    } else {
        exit('Wp-Lumen: Laravel\Lumen\Application Class not found.  Check wp-load.php path in bootstrap/app.php (17)');
    }
}

/*
|--------------------------------------------------------------------------
| Require The Composer AutoLoader
|--------------------------------------------------------------------------
| Loaded in mu-plugins or, include here.
*/
require_once __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Load Env with Overload Enabled (last plugin loaded will overwrite)
| Only used if .env file is added, otherwise define env vars in wp-lumen-framework.php
|--------------------------------------------------------------------------
*/
//try {
//    (new Dotenv\Dotenv(__DIR__ . '/../'))->overload();
//} catch (Dotenv\Exception\InvalidPathException $e) {
//    exit('Wp-Lumen: No Environment Settings (.env) Found.');
//}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
*/
$app = new Laravel\Lumen\Application(
    realpath(__DIR__ . '/../')
);
$app->withEloquent();
//Facades will not work with multiple WP-Lumen Plugins Running, use the Helper instead.
//$app->withFacades(true);

$config = $app->make('config');
$middleware = [];
/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);


/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\RoutingServiceProvider::class);
$app->register(App\Providers\WordpressServiceProvider::class);
$app->register(App\Providers\WordpressCleanUpServiceProvider::class);
$app->register(App\Providers\UtilityServiceProvider::class);

/** Sessions */
if ($config->get('session.enabled', false)) {
    $app->bind(\Illuminate\Session\SessionManager::class, function ($app) {
        return new \Illuminate\Session\SessionManager($app);
    });
    $app->register(\Illuminate\Session\SessionServiceProvider::class);
    array_push($middleware, \Illuminate\Session\Middleware\StartSession::class);
}
/** DebugBar */
if(!$app->runningInConsole() && $config->get('app.debug')){
    $app->configure('debugbar');
    $app->register(\Barryvdh\Debugbar\LumenServiceProvider::class);
    $app->register(App\Providers\DebugbarServiceProvider::class);
}

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'start_session' => \Illuminate\Session\Middleware\StartSession::class,
    'share_errors' => \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    'no404s' => App\Http\Middleware\SilenceWp404s::class,
    //Route Middleware goes here.
]);
$app->middleware(array_merge($middleware, [
    //App Middleware goes here.
]));

return $app;
