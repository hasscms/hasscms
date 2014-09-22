<?php
namespace hasscms\file\actions;

use Yii;
use yii\helpers\Json;
use yii\base\Action;
class ConfigAction extends Action
{

    public function init()
    {
        parent::init();
    }
    
    public function run()
    {

        $config = Json::decode(preg_replace('/\/\*[\s\S]+?\*\//', "", file_get_contents(__DIR__ . '/config.json')), true);
        
        return $result = Json::encode($config);
    }
    
   
}

?>