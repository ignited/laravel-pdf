<?php namespace Ignited\Pdf;

use WkHtmlToPdf;

class PdfFactory {

	protected $config;

	public function __construct($config){
		$this->config = $config;
	}

	public function make($options=array())
	{
		$wkhtml = new WkHtmlToPdf($this->config);

		if(!empty($options))
		{
			$wkhtml->setPageOptions($options);
		}

		return $wkhtml;
	}

}