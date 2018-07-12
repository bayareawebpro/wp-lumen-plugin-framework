<?php namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class WordpressCleanUpServiceProvider extends ServiceProvider
{

    /** @var \App\Helpers\LumenHelper $lumenHelper **/
    /** @var \App\Helpers\WpHelper $wpHelper **/
    /** @var \Laravel\Lumen\Application $app **/

    protected $app, $files, $cleanup;

    /**
     * WordpressServiceProvider constructor.
     * @param $app \Illuminate\Contracts\Foundation\Application
     */
    public function __construct( $app ) {
        parent::__construct( $app );
        $this->files = $app->make('files');
        $this->cleanup = array(
//            'head',
//            'rest-api',
//            'emojis',
//            'admin-bar',
        );
    }

    /**
     * Register any application services.
     * Here we will register all of the Wordpress modifications.
     * @return void
     */
    public function register()
    {
        foreach($this->cleanup as $filename){
            $this->files->requireOnce($this->app->basePath("cleanup/{$filename}.php"));
        }
    }
}
