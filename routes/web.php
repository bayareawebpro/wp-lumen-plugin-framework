<?php


$router->group([
	'prefix'=>'lumen/api', 'middleware' => []
], function($router){
	$router->post('auth/login', 'Auth\AuthController@login');
	$router->post('auth/register', 'Auth\AuthController@register');
	$router->get('auth/logout', 'Auth\AuthController@logout');
});
$router->get('test-theme','ExampleRouteThemeViewController@show');

//$router->get('/key-generate', function() {
//	return str_random(32);
//});
