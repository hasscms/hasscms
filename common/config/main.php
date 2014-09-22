<?php
return [
	'name' => "HassCMS",
	'sourceLanguage' => 'en-US',
	'language' => 'zh-CN',
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => [
		'moduleManager'
	],
	'components' => [
		'cache' => [
			'class' => 'yii\caching\DbCache'
		],
		'session' => [
			'class' => 'yii\web\DbSession'
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => false,
			'messageConfig' => [
				'from' => [
					'noreply@hasscms.com' => 'hasscms'
				],
				'charset' => 'UTF-8'
			],
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'encryption' => 'ssl'
			],
			'viewPath' => "@common/mail"
		],
		'i18n' => [
			'class' => 'Zelenin\yii\modules\I18n\components\I18N',
			'languages' => [
				'zh-CN',
				'en-US'
			]
		],
		"moduleManager" => [
			"class" => 'Hass\ModuleManager\ModuleManager',
			"config" => []
		]
	],
	'modules' => [
		'translations' => [
			'class' => 'Zelenin\yii\modules\I18n\Module',
			"defer"=>true,
		],
		'user' => [
			'class' => 'Hass\User\Module'
		],
		'setting' => [
			'class' => 'Hass\Setting\Module'
		],
		'auth' => [
			'class' => 'Hass\Auth\Module'
		],
		'cleancache' => [
			'class' => 'Hass\CleanCache\Module'
		],
		'system' => [
			'class' => 'Hass\System\Module'
		]
	]

];
