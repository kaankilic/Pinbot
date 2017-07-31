<?php

namespace Kaankilic\Pinbot\Helpers;

class RecursiveHelper{

	public static function class_uses_recursive($class)
	{
		if (is_object($class)) {
			$class = get_class($class);
		}
		$results = [];
		foreach (array_merge([$class => $class], class_parents($class)) as $class) {
			$results += trait_uses_recursive($class);
		}
		return array_unique($results);
	}

	public static function trait_uses_recursive($trait)
	{
		$traits = class_uses($trait);
		foreach ($traits as $trait) {
			$traits += trait_uses_recursive($trait);
		}
		return $traits;
	}
	
	public static function get_array_data($key = '', $data, $default = null)
	{
		if(empty($key)) return $data;

		$indexes = explode('.', $key);

		$value = $data;

		foreach ($indexes as $index) {
			if(!isset($value[$index])) return $default;

			$value = $value[$index];
		}

		return $value;
	}
}