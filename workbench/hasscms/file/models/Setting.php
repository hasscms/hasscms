<?php
namespace hasscms\file\models;

use yii\base\Model;

class Setting extends Model
{
    public $allowExtension = "";

    private  $source;
    
    const COLLECTION = "upload";
    
    public function init(){
        parent::init();
        $this->loadDefaultValue();
        $this->source = new \hasscms\setting\models\Setting();
        $this->load($this->source->getSettingsByCollection(static::COLLECTION),'');
    }
    
    public function loadDefaultValue()
    {
        $this->allowExtension = "jpg,png,gif,mp3";
    }
    
    public function rules()
    {
        return [
            [
                [
                    "allowExtension",
      
                ],
                "required"
            ],
    
            [
                [
                    "allowExtension",

                ],
                'filter',
                'filter' => 'trim'
            ]
        ]
        ;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            "allowExtension" => "允许上传的扩展名"
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

?>