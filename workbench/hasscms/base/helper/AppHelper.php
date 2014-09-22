<?php
namespace hasscms\base\helper;

use Yii;

class AppHelper
{
  
  public static function  isBackendApp(){
    if (str_replace(["\\",'/'],"",Yii::getAlias("@app")) === str_replace(["\\",'/'],"",Yii::getAlias("@backend"))) {
      return true;
    }
    
    return false;
  }
  
  public static function  isFrontendApp(){
    if (str_replace(["\\",'/'],"",Yii::getAlias("@app")) === str_replace(["\\",'/'],"",Yii::getAlias("@frontend"))) {
      return true;
    }
  
    return false;
  }
}

?>