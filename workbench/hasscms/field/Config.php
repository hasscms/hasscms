<?php

namespace hasscms\field;

class Config  {
	public static $widgets;
	public static $valicatios;

	public static $defaultFields;

	public static function setWidgets($configs)
	{
		foreach ($configs as $id => $config) {
			static::addWidget($id, $config);
		}
	}

	public static function addWidget($id,$config)
	{
		if (!isset(static::$widgets[$id])) {
			static::$widgets[$id] = $config;
		} else {
			static::$widgets[$id] = array_merge(static::$widgets[$id],$config);
		}
	}

	public static function getWidget($id)
	{
		return static::$widgets[$id];
	}
}

?>