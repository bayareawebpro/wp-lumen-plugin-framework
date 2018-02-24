<?php namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Contracts\Bus\Dispatcher;
class LumenHelper {

	private $app;
	static $app_instances;

	/**
	 * Construct Get Plugin Container from Static Array
	 * @param $app \Illuminate\Contracts\Foundation\Application
	 * @throws \Exception
	 */
	public function __construct($app) {
		$namespace = $this->getNamespace();
		if(!isset(self::$app_instances[$namespace])){
			$this->app = self::$app_instances[$namespace] = $app;
		}else{
			$this->app = self::$app_instances[$namespace];
		}
	}

	/**
	 * Get Application Namespace
	 * @return string
	 */
	public function getNamespace(){
		return explode('\\', with(new \ReflectionClass($this))->getNamespaceName())[0];
	}

	/**
	 * Get Lumen Plugin Instance
	 * @param $namespace
	 * @return mixed
	 */
	public static function plugin($namespace){
		if(isset(self::$app_instances[$namespace])){
			return new self(self::$app_instances[$namespace]);
		}
		return false;
	}


	/**
	 * Load Configurations.
	 * @return void
	 */
	function loadConfigurations()
	{
		foreach($this->app->get('files')->files(realpath($this->base_path('config'))) as $configFile){
			$this->app->configure($configFile->getBasename('.php'));
		}
	}

	/**
	 * Get Lumen App
	 * @return \Illuminate\Contracts\Foundation\Application
	 */
	public function app(){
		return $this->app;
	}

	/**
	 * Get Lumen App
	 * @return \Illuminate\Session\SessionServiceProvider
	 */
	public function session(){
		return $this->app->get('session.store');
	}

	/**
	 * Get wpHelper
	 * @return \App\Helpers\WpHelper
	 */
	public function wpHelper(){
		return $this->app->get('wpHelper');
	}

	/**
	 * Get Cache
	 * @return \Illuminate\Cache\CacheManager
	 */
	public function cache(){
		return $this->app->make('cache');
	}

	/**
	 * Get Auth
	 * @return \Illuminate\Auth\AuthManager
	 */
	public function auth(){
		return $this->app->make('auth');
	}

	/**
	 * Get Public Asset
	 * @return string
	 */
	public function asset($url){
		return plugin_dir_url($this->base_path().'/plugin.php').$url;
	}

	/**
	 * Throw an HttpException with the given data.
	 *
	 * @param  int     $code
	 * @param  string  $message
	 * @param  array   $headers
	 * @return void
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 */
	function abort($code, $message = '', array $headers = [])
	{
		$this->app->abort($code, $message, $headers);
		return;
	}

	/**
	 * Get the available container instance.
	 *
	 * @param  string  $make
	 * @return mixed|\Laravel\Lumen\Application
	 */
	function make($make)
	{
		return $this->app->make($make);
	}

	/**
	 * Get the path to the base of the install.
	 *
	 * @param  string  $path
	 * @return string
	 */
	function base_path($path = '')
	{
		return $this->app->basePath().($path ? '/'.$path : $path);
	}

	/**
	 * Decrypt the given value.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function decrypt($value)
	{
		return $this->app->make('encrypter')->decrypt($value);
	}

	/**
	 * Dispatch a job to its appropriate handler.
	 *
	 * @param  mixed  $job
	 * @return mixed
	 */
	function dispatch($job)
	{
		return $this->app->make(Dispatcher::class)->dispatch($job);
	}

	/**
	 * Get / set the specified configuration value.
	 *
	 * If an array is passed as the key, we will assume you want to set an array of values.
	 *
	 * @param  array|string  $key
	 * @param  mixed  $default
	 * @return mixed
	 */
	function config($key = null, $default = null)
	{
		if (is_null($key)) {
			return $this->app->make('config');
		}

		if (is_array($key)) {
			return $this->app->make('config')->set($key);
		}

		return $this->app->make('config')->get($key, $default);
	}
	/**
	 * Get the path to the database directory of the install.
	 *
	 * @param  string  $path
	 * @return string
	 */
	function database_path($path = '')
	{
		return $this->app->databasePath($path);
	}

	/**
	 * Encrypt the given value.
	 *
	 * @param  string  $value
	 * @return string
	 */
	function encrypt($value)
	{
		return $this->app->make('encrypter')->encrypt($value);
	}

	/**
	 * Gets the value of an environment variable. Supports boolean, empty and null.
	 *
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	function env($key, $default = null)
	{
		$value = getenv($key);

		if ($value === false) {
			return value($default);
		}

		switch (strtolower($value)) {
			case 'true':
			case '(true)':
				return true;

			case 'false':
			case '(false)':
				return false;

			case 'empty':
			case '(empty)':
				return '';

			case 'null':
			case '(null)':
				return;
		}

		if (Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
			return substr($value, 1, -1);
		}

		return $value;
	}

	/**
	 * Fire an event and call the listeners.
	 *
	 * @param  object|string  $event
	 * @param  mixed   $payload
	 * @param  bool    $halt
	 * @return array|null
	 */
	function event($event, $payload = [], $halt = false)
	{
		return $this->app->make('events')->fire($event, $payload, $halt);
	}

	/**
	 * Create a model factory builder for a given class, name, and amount.
	 *
	 * @param  dynamic  class|class,name|class,amount|class,name,amount
	 * @return \Illuminate\Database\Eloquent\FactoryBuilder
	 */
	function factory()
	{
		$this->app->make('db');

		$factory = $this->app->make('Illuminate\Database\Eloquent\Factory');

		$arguments = func_get_args();

		if (isset($arguments[1]) && is_string($arguments[1])) {
			return $factory->of($arguments[0], $arguments[1])->times(isset($arguments[2]) ? $arguments[2] : null);
		} elseif (isset($arguments[1])) {
			return $factory->of($arguments[0])->times($arguments[1]);
		} else {
			return $factory->of($arguments[0]);
		}
	}

	/**
	 * Write some information to the log.
	 *
	 * @param  string  $message
	 * @param  array   $context
	 * @return void
	 */
	function info($message, $context = [])
	{
		$this->app->make('Psr\Log\LoggerInterface')->info($message, $context);
	}

	/**
	 * Get an instance of the redirector.
	 *
	 * @param  string|null  $to
	 * @param  int     $status
	 * @param  array   $headers
	 * @param  bool    $secure
	 * @return \Laravel\Lumen\Http\Redirector|\Illuminate\Http\RedirectResponse
	 */
	function redirect($to = null, $status = 302, $headers = [], $secure = null)
	{
		$redirector = new \Laravel\Lumen\Http\Redirector($this->app);

		if (is_null($to)) {
			return $redirector;
		}

		return $redirector->to($to, $status, $headers, $secure);
	}
	/**
	 * Get the path to the resources folder.
	 *
	 * @param  string  $path
	 * @return string
	 */
	function resource_path($path = '')
	{
		return $this->app->resourcePath($path);
	}

	/**
	 * Make Validator
	 * @return \Illuminate\Validation\Validator
	 */
	function validator()
	{
		return $this->app->make('validator');
	}

	/**
	 * Return the current request from the application.
	 * @return \Illuminate\Http\Request
	 */
	function request()
	{
		return $this->app->make('request');
	}

	/**
	 * Return a new response from the application.
	 *
	 * @param  string  $content
	 * @param  int     $status
	 * @param  array   $headers
	 * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
	 */
	function response($content = '', $status = 200, array $headers = [])
	{
		$factory = new \Laravel\Lumen\Http\ResponseFactory;

		if (func_num_args() === 0) {
			return $factory;
		}

		return $factory->make($content, $status, $headers);
	}

	/**
	 * Generate a URL to a named route.
	 *
	 * @param  string  $name
	 * @param  array   $parameters
	 * @param  bool    $secure
	 * @return string
	 */
	function route($name, $parameters = [], $secure = null)
	{
		return $this->app->make('url')->route($name, $parameters, $secure);
	}

	/**
	 * Get the path to the storage folder.
	 *
	 * @param  string  $path
	 * @return string
	 */
	function storage_path($path = '')
	{
		return $this->app->storagePath($path);
	}

	/**
	 * Translate the given message.
	 *
	 * @param  string  $id
	 * @param  array   $replace
	 * @param  string  $locale
	 * @return \Illuminate\Contracts\Translation\Translator|string
	 */
	function trans($id = null, $replace = [], $locale = null)
	{
		if (is_null($id)) {
			return $this->app->make('translator');
		}

		return $this->app->make('translator')->trans($id, $replace, $locale);
	}

	/**
	 * Translates the given message based on a count.
	 *
	 * @param  string  $id
	 * @param  int|array|\Countable  $number
	 * @param  array   $replace
	 * @param  string  $locale
	 * @return string
	 */
	function trans_choice($id, $number, array $replace = [], $locale = null)
	{
		return $this->app->make('translator')->transChoice($id, $number, $replace, $locale);
	}

	/**
	 * Generate a url for the application.
	 *
	 * @param  string  $path
	 * @param  mixed   $parameters
	 * @param  bool    $secure
	 * @return string
	 */
	function url($path = null, $parameters = [], $secure = null)
	{
		return $this->app->make('url')->to($path, $parameters, $secure);
	}

	/**
	 * Get the evaluated view contents for the given view.
	 *
	 * @param  string  $view
	 * @param  array   $data
	 * @param  array   $mergeData
	 * @return \Illuminate\View\View
	 */
	function view($view = null, $data = [], $mergeData = [])
	{
		$factory = $this->app->make('view');

		if (func_num_args() === 0) {
			return $factory;
		}
		return $factory->make($view, $data, $mergeData);


	}

	/**
	 * Recursive Collection
	 * @param array $array
	 * @return mixed
	 */
	function recursiveCollection( array $array ) {
		\Illuminate\Support\Collection::macro( 'recursive', function () {
			return $this->map( function ( $value ) {
				if ( is_array( $value ) ) {
					return collect( $value )->recursive();
				}

				return $value;
			} );
		} );
		return collect( $array )->recursive();
	}
}
