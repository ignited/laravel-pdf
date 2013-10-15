<?php namespace Ignited\Pdf\Facades;

use Illuminate\Support\Facades\Facade;

class Pdf extends Facade {
	protected static function getFacadeAccessor() { return 'pdf'; }
}