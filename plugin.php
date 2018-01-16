<?php
/**
 * @link              http://www.bayareawebpro.com
 * @since             1.0
 * @package           bayareawebpro/illumine-framework-starter
 * @wordpress-plugin
 *
 * Plugin Name:       WP Lumen
 * Plugin URI:        http://www.bayareawebpro.com/
 * Description:       (Lumen Framework 5.5)
 * Version:           1.0
 * Author:            Some Dev
 * Author URI:        http://www.SomeDev.com/
 * License:           © Copyright 2017 All Rights Reserved.
 * License URI:       http://www.SomeDev.com/terms
 * Text Domain: lumen
 * Domain Path: /language
 */


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/
add_action('init',function(){
	require __DIR__.'/bootstrap/app.php';
});

