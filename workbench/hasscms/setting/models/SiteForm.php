<?php
namespace hasscms\setting\models;

use yii\base\Model;


/**
 *
 * @author Administrator
 *        
 */
class SiteForm extends Model
{

    public $siteUrl = "";

    public $siteName = "";

    public $siteDesc = "";
    
    public $staticUrl="";
    
    private  $source;
    const COLLECTION = "site";
    
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
                    "siteUrl",
                    "siteName",
                    "siteDesc",
                    "staticUrl"
                ],
                "required"
            ],
            
            [
                [
                    "siteUrl",
                    "siteName",
                    "siteDesc",
                    "staticUrl"
                ],
                'filter',
                'filter' => 'trim'
            ],
            
            [["siteUrl","staticUrl"],"url"]
        ]
        ;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
        "siteUrl" => "站点地址",
        "siteName"=>"站点名称",
        "siteDesc"=>"站点说明",
        "staticUrl"=>"静态地址",
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
