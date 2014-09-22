<?php
namespace hasscms\setting\models;

use yii\base\Model;

/**
 *
 * @author Administrator
 *        
 */
class MailForm extends Model
{

    public $regVerificationEmail = "0";

    public $mailServer = "";

    public $mailLogin = "";

    public $mailPass = "";

    public $mailPort = "25";

    public $mailExpirationTime = "0";


    private  $source;
    const COLLECTION = "mail";
    
    public function init(){
      parent::init();
      $this->source = new Setting();
      $this->load($this->source->getSettingsByCollection(static::COLLECTION),'');
    }
    
    
    public function rules()
    {
        return [
            [
                [
                    "regVerificationEmail",
                    "mailServer",
                    "mailLogin",
                    "mailPass",
                    "mailPort",
                    "mailExpirationTime"
                ],
                "required"
            ],
            
            [
                [
                    "regVerificationEmail",
                    "mailServer",
                    "mailLogin",
                    "mailPass",
                    "mailPort",
                    "mailExpirationTime"
                ],
                'filter',
                'filter' => 'trim'
            ],
            [
                [
                    "regVerificationEmail",
                    "mailPort",
                    "mailExpirationTime"
                ],
                'integer'
            ],
            [
                [
                    "mailLogin"
                ],
                "email"
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                    "regVerificationEmail"=>"注册是否验证email",
                    "mailServer"=>"邮箱服务器",
                    "mailLogin"=>"邮箱登录名",
                    "mailPass"=>"邮箱密码",
                    "mailPort"=>"服务器端口",
                    "mailExpirationTime"=>"邮件验证过期时间"
        ];
    }

    public function save()
    {
      if ($this->source->setSettingsWithCollection(static::COLLECTION,$this->getAttributes())) {
        return true;
      }
        
        return false;
    }
}