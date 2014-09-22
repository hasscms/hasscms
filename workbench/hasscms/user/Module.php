<?php

namespace hasscms\user;

use Yii;
use yii\base\InvalidRouteException;
use hasscms\base\helper\AppHelper;


class Module extends \amnah\yii2\user\Module {
	
	public $emailViewPath = "@common/mail";
	
	/**
	 * @inheritdoc
	 */
	public function init()
	{	        
	  \yii\base\Module::init();
	
	  // check for valid email/username properties
	  $this->checkModuleProperties();
	

	
	  // override modelClasses
	  $this->modelClasses = array_merge($this->getDefaultModelClasses(), $this->modelClasses);
	
	  // set alias
	  $this->setAliases([
	    $this->alias => __DIR__,
	    ]);
	  
	  //先使用自己的viewpath,再使用module的viewpath

	  
	  if (AppHelper::isBackendApp())
	  {
	    Yii::$app->getView()->theme->pathMap["@user/views"][] = "@user/themes/backend";
	  }
	  else 
	  {
	    Yii::$app->getView()->theme->pathMap["@user/views"][] = "@user/themes/frontend";
	  }
	  
	  Yii::$app->getView()->theme->pathMap["@user/views"][] = "@user/views";
	  Yii::$app->getView()->theme->pathMap["@user/views"][] = "@vendor/amnah/yii2-user/views";
	}
	
	/**
	 * Get default model classes
	 */
	protected function getDefaultModelClasses() {
		return array_merge ( parent::getDefaultModelClasses (), [ 
				'User' => 'hasscms\user\models\User',
// 				'Profile' => 'hasscms\user\models\Profile',
// 				'Role' => 'hasscms\user\models\Role',
// 				'UserKey' => 'hasscms\user\models\UserKey',
// 				'UserAuth' => 'hasscms\user\models\UserAuth',
// 				'ForgotForm' => 'hasscms\user\models\forms\ForgotForm',
// 				'LoginForm' => 'hasscms\user\models\forms\LoginForm',
// 				'ResendForm' => 'hasscms\user\models\forms\ResendForm',
// 				'UserSearch' => 'hasscms\user\models\search\UserSearch' 
		] );
	}
	
	/**
	 * 当路由中的控制器不在控制器列表中,则使用default控制器.如果是前台访问admin控制器则不允许
	 * @see \hasscms\user\Module::createController()
	 */
	public function createController($route)
	{
		list ($id) = explode('/', $route);
		
		// check valid routes
		$validRoutes  = [$this->defaultRoute, "admin", "copy", "auth"];
		$isValidRoute = false;

		if($id == "admin" && AppHelper::isBackendApp() === false)
		{
			$id = $this->getUniqueId();
			throw new InvalidRouteException('Unable to resolve the request "' . ($id === '' ? $route : $id . '/' . $route) . '".');
		}
	
		if (in_array($id, $validRoutes)) {
			$isValidRoute = true;
		}
	
		return (empty($route) or $isValidRoute)
		? \yii\base\Module::createController($route)
		: \yii\base\Module::createController("{$this->defaultRoute}/{$route}");
	}
	
	
}