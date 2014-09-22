<?php
namespace hasscms\base\ui\bundles;
use yii\web\AssetBundle;

class BootstrapProgressbarAsset extends AssetBundle
{
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-progressbar/bootstrap-progressbar.min.css',
    ];
    
    public $js  = [
            'js/bootstrap-progressbar/bootstrap-progressbar.min.js'
    ];      
        
    public $depends = [
      'yii\adminUi\assetsBundle\AdminUiAsset',
    ];        
    
    public function init()
    {
        $this->sourcePath = dirname(__DIR__)."/assets";
        parent::init();
    }
}


?>