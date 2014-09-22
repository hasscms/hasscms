<?php

namespace hasscms\cleancache;

class Config {
	/**
	 * [
	 *attribute=> [
	 *    "key"=>"",
	 *    "label"=>""
	 * ]
	 * ]
	 * @var unknown
	 */
	public static $items = [];

	public static function setItems($configs)
	{
		foreach ($configs as $id => $config) {
			static::setItem($id, $config);
		}
	}

	public static function setItem($id,$config)
	{
		if (!isset(static::$items[$id])) {
			static::$items[$id] = $config;
		} else {
			static::$items[$id] = array_merge(static::$items[$id],$config);
		}
	}
}

?>