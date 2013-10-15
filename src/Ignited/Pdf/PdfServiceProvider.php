<?php namespace Ignited\Pdf;

use Illuminate\Support\ServiceProvider;

use Ignited\Pdf\PdfFactory;

class PdfServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['pdf'] = $this->app->share(function($app)
        {
        	$config = $app['config']['laravel-pdf'] ?: $app['config']['laravel-pdf::config'];

        	if(!$config || !$config['bin'])
        	{
        		throw new \RunTimeException('Bin path for wkhtmltopdf is not configured.');
        	}

        	if(!file_exists($config['bin']))
        	{
        		throw new \RunTimeException('Cannot find bin for wkhtmltopdf - have you included it in composer?');
        	}

        	return new PdfFactory($config);
        });
	}

	public function boot()
	{
		$this->package('ignited/laravel-pdf');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}