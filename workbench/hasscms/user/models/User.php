<?php
namespace  hasscms\user\models;

use Yii;
use amnah\yii2\user\models\Role;


/**
 * User model
 *

 * @property string $fullname read-only 
 */
class User extends \amnah\yii2\user\models\User
{

  public function getCreatedOn(){
    return $this->create_time;
  }
  
  
   public function getFullname(){
   		return $this->username;
   }
   
   public function getRoleName(){
   		return Role::dropdown()[$this->role_id];
   }
   
   public function attributeLabels()
   {
     return [
       'id'          => Yii::t('user', 'ID'),
       'role_id'     => Yii::t('user', 'Role ID'),
       'status'      => Yii::t('user', 'Status'),
       'email'       => Yii::t('user', 'Email'),
       'new_email'   => Yii::t('user', 'New Email'),
       'username'    => Yii::t('user', 'Username'),
       'password'    => Yii::t('user', 'Password'),
       'auth_key'    => Yii::t('user', 'Auth Key'),
       'api_key'     => Yii::t('user', 'Api Key'),
       'login_ip'    => Yii::t('user', 'Login Ip'),
       'login_time'  => Yii::t('user', 'Login Time'),
       'create_ip'   => Yii::t('user', 'Create Ip'),
       'create_time' => Yii::t('user', 'Create Time'),
       'update_time' => Yii::t('user', 'Update Time'),
       'ban_time'    => Yii::t('user', 'Ban Time'),
       'ban_reason'  => Yii::t('user', 'Ban Reason'),
   
       'currentPassword' => Yii::t('user', 'Current Password'),
       'newPassword'     => Yii::t('user', 'New Password'),
       ];
   }
}
