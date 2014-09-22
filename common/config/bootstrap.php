<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');

if (is_dir ( $workbench = dirname ( dirname ( __DIR__ ) ) . '/workbench' )) {

	if (is_dir ( $workbench . '/Hass/WorkBench' )) {
		$loader = new \Composer\Autoload\ClassLoader ();
		$map = array (
			'Hass\\WorkBench\\' => array (
				$workbench . '/Hass/WorkBench'
			)
		);
		foreach ( $map as $namespace => $path ) {
			$loader->setPsr4 ( $namespace, $path );
		}
		$loader->register ( true );
	}
	yii\base\Event::on ( 'yii\console\Application', yii\base\Application::EVENT_BEFORE_REQUEST, [
	'\Hass\WorkBench\Starter',
	'registerCommend'
		], [
		"author" => "zhepama",
		"email" => "zhepama@gmail.com",
		"workBenchPath"=>$workbench
		] );
		//workbench下的包永遠優先於vendor下的包
		\Hass\WorkBench\Starter::start ( $workbench );
}