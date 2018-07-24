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
//You can disable Eloquent if needed for speed.
$app->withEloquent();

//Facades & global helper functions will not work with multiple WP-Lumen Plugins Running, use the Helper class instead.
//$app->withFacades(true);

//Define the middleware array for use below...
$middleware = [];

//Get the configuration repository.
$config = $app->make('config');
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
$app->register(App\Providers\UtilityServiceProvider::class);
//$app->register(App\Providers\WordpressCleanUpServiceProvider::class);

//Get the json settings repository.
$settings = $app->make('settings');

/** Sessions */
if ($config->get('session.enabled', false)) {
    array_push($middleware, \Illuminate\Session\Middleware\StartSession::class);
    $app->register(\Illuminate\Session\SessionServiceProvider::class);
    $app->when(Illuminate\Session\SessionManager::class)
        ->needs('$app')
        ->give($app);
}
/** DebugBar */
if(!$app->runningInConsole() && $config->get('app.debug', false)){
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
*/
$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'start_session' => \Illuminate\Session\Middleware\StartSession::class,
    'share_errors' => \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    'no404s' => App\Http\Middleware\SilenceWp404s::class,
    //Additional Route Middleware goes here.
]);
$app->middleware(array_merge($middleware, [
    //Additional App Middleware goes here.
]));

return $app;
