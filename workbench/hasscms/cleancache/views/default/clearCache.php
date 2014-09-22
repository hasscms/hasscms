<?php

use yii\helpers\Html;
use yii\bootstrap\Progress;
use hasscms\base\ui\bundles\BootstrapProgressbarAsset;

BootstrapProgressbarAsset::register($this);


$this->title = "清除缓存";
$this->params['breadcrumbs'][] = "工具";
$this->params['breadcrumbs'][] = $this->title;



echo Progress::widget([
  'options' => [
    'class' => 'progress-striped',
    ],
  
 
  'barOptions' => [
    'class' => 'progress-bar-primary',
     'role'=>"progressbar"
    ]
  ]);

echo Html::tag("p","清除缓存完成...");

$this->registerJs('
 var $pb = $(".progress .progress-bar");
$pb.attr("data-transitiongoal", 100).progressbar({ transition_delay: 500,display_text: "fill"});  
',\yii\web\View::POS_READY);
?>
