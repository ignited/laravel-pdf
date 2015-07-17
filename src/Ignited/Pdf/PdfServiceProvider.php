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
            $config = $app['config']['pdf'] ?: $app['config']['pdf::config'];

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

        // merge & publihs config
        $configPath = __DIR__ . '/../../config/config.php';
        $this->mergeConfigFrom($configPath, 'pdf');
        $this->publishes([$configPath => config_path('pdf.php')]);

	}

	public function boot()
	{
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('pdf.php'),
        ], 'config');
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