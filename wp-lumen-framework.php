<?php
/**
 * @link              http://www.bayareawebpro.com
 * @since             1.0
 * @package           bayareawebpro/wp-lumen-plugin-framework
 * @wordpress-plugin
 *
 * Plugin Name:       WP Lumen Plugin Framework
 * Plugin URI:        https://github.com/bayareawebpro/wp-lumen-plugin-framework/
 * Description:       (Lumen Framework 5.6)
 * Version:           1.0
 * Author:            Some Dev
 * Author URI:        http://www.SomeDev.com/
 * License:           © Copyright 2017 All Rights Reserved.
 * License URI:       http://www.SomeDev.com/terms
 */

/*
|--------------------------------------------------------------------------
| Environment Settings
|--------------------------------------------------------------------------
| To make our plugin portable, we don't use an .env file.  However, if you
| want to use one, simple add one to the plugin's directory.
*/
putenv('APP_ENV=local');
putenv('APP_DEBUG=true');
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
*/
$app = require __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Override the Application Error Reporting Level
|--------------------------------------------------------------------------
| You can override the error reporting level to disable output and prevent
| warning thrown by other plugins.
*/
error_reporting((config('APP_DEBUG') ? E_ALL : 0));

/*
|--------------------------------------------------------------------------
| Resolve Plugin from LumenHelper Example
|--------------------------------------------------------------------------
| You can resolve each plugin by it's namespace.
*/
//dd(\App\Helpers\LumenHelper::plugin('App')->config());