<?php

namespace hasscms\user\components;

use Yii;

/**
 * User component
 */
class User extends \amnah\yii2\user\components\User
{
	public $identityClass = 'hasscms\user\models\User';
	
	
	/**
	 * Check if user can do $permissionName.
	 * If "authManager" component is set, this will simply use the default functionality.
	 * Otherwise, it will use our custom permission system
	 *
	 * @param string $permissionName
	 * @param array  $params
	 * @param bool   $allowCaching
	 * @return bool
	 */
	public function can($permissionName, $params = [], $allowCaching = true)
	{
	  if($permissionName == "admin")
	  {
	    return true;
	  }
	  
	  // check for auth manager to call parent
	  $auth = Yii::$app->getAuthManager();
	  if ($auth) {
	    return \yii\web\User::can($permissionName, $params, $allowCaching);
	  }
	
	  // otherwise use our own custom permission (via the role table)
	  /** @var \amnah\yii2\user\models\User $user */
	  $user = $this->getIdentity();
	  return $user ? $user->can($permissionName) : false;
	}
}
