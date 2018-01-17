<?php
/**
 * @link              http://www.bayareawebpro.com
 * @since             1.0
 * @package           bayareawebpro/wp-lumen-plugin-framework
 * @wordpress-plugin
 *
 * Plugin Name:       WP Lumen Plugin Framework
 * Plugin URI:        https://github.com/bayareawebpro/wp-lumen-plugin-framework/
 * Description:       (Lumen Framework 5.5)
 * Version:           1.0
 * Author:            Some Dev
 * Author URI:        http://www.SomeDev.com/
 * License:           © Copyright 2017 All Rights Reserved.
 * License URI:       http://www.SomeDev.com/terms
 */

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
*/
register_activation_hook(realpath(__FILE__), array('\App\Utilities\Activate', 'init'));
register_deactivation_hook(realpath(__FILE__), array('\App\Utilities\DeActivate', 'init'));
register_uninstall_hook(realpath(__FILE__), array('\App\Utilities\UnInstall', 'init'));

require_once __DIR__.'/bootstrap/app.php';
add_action('init',function(){

	//Resolve the Framework Helper for your Namespace:
	//$lumenHelper = \App\Helpers\LumenHelper::plugin('App');

});