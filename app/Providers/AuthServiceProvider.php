<?php namespace App\Providers;

use App\Models\WpUser;
use Illuminate\Support\ServiceProvider;
use function PHPSTORM_META\type;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

	    $gate = $this->app->make('Illuminate\Contracts\Auth\Access\Gate');


	    $gate->define('update-user', function ($user, $userObject) {
	    	return intval($user->ID) === intval($userObject->ID);
	    });

	    $gate->define('update-post', function ($user, $postObject) {
		    return intval($user->ID) === intval($postObject->post_author);
	    });
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
	    $this->app['auth']->viaRequest('wp', function ($request) {

	    	$currentUser = WpUser::where('ID', get_current_user_id())->first();
		    $request->setUserResolver(function () use ($currentUser) {
			    return $currentUser;
		    });
		    return $currentUser;
	    });



    }
}
