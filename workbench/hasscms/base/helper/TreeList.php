<?php
namespace hasscms\base\helper;

use Yii;

use yii\helpers\ArrayHelper;


class TreeList extends \yii\base\Object
{


  public $key = 'id';

  public $parentKey = 'pid';

  public $valueKey = 'name';
  
  public $orderKey= "weight";

  public $data;
  
  public $repeatString = "--";
  
  public $result;
  
  public $rootName = "根";

  public function init()
  {
    parent::init();

    if($this->data !== null)
    {
      $this->data = static::format($this->data,  $this->key, $this->valueKey,$this->parentKey,$this->orderKey);
    }
    else
    {
      $this->data = [];
    }

    $this->result[0] =$this->rootName;
  }
  
  public static function format($data,$key,$valueKey,$parentKey="pid",$orderKey = null,$orderDirection = SORT_DESC)
  {
    if($orderKey == null)
    {
      $orderKey = $valueKey;
      $orderDirection = SORT_ASC;
    }

    ArrayHelper::multisort($data, [$parentKey,$orderKey],[SORT_ASC,$orderDirection]);
    $data = ArrayHelper::map($data, $key, $valueKey,$parentKey);
    return $data;
  }
  
  public function run()
  {
    if(!empty($this->data))
    {
      $this->tree($this->data, 0);
    }

    return $this->result;
  }
  
  
  public function tree($data,$pid,$level = 0)
  {

    foreach ($data[$pid] as $key =>$value)
    {
      $this->result[$key] = str_repeat(" - - ", $level).$value;
      if(isset($data[$key]))
      {
        $multiplier = $level+1;
        $this->tree($data,$key,$multiplier);
      }
    }
  }

}