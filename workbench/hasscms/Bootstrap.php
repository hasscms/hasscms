<?php
namespace common\hasscms;

use yii\base\BootstrapInterface;

use Yii;
class Bootstrap implements BootstrapInterface
{

  public function bootstrap($app)
    {
        Yii::setAlias('hasscms', __DIR__);
        Yii::setAlias('localStroage', dirname(dirname(__DIR__)));
    }
}
