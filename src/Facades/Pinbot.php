<?php
namespace Kaankilic\Pinbot\Facades;
use Illuminate\Support\Facades\Facade;
class Pinbot extends Facade {
  protected static function getFacadeAccessor() { 
  		return 'Pinbot'; 
	}
}