<?php
namespace hasscms\menu\components;

use Yii;
use yii\caching\Cache;
use yii\helpers\ArrayHelper;
use hasscms\base\helper\Serializer;

class Menu extends \yii\base\Component
{

  /**
   *
   * @var string
   */
  public $modelClass = '\hasscms\menu\models\MenuLink';

  /**
   * Model to for storing and retrieving settings
   *
   * @var \hasscms\menu\models\MenuLink
   */
  protected $model;

  /**
   *
   * @var Cache string cache object or the application component ID of the cache object.
   *      Settings will be cached through this cache object, if it is available.
   *     
   *      After the Settings object is created, if you want to change this property,
   *      you should only assign it with a cache object.
   *      Set this property to null if you do not want to cache the settings.
   */
  public $cache = 'cache';

  public $cacheKey = "hasscms.menu";
  /**
   * To be used by the cache component.
   *
   * @var string cache key
   */  
  private $_data = [];

  public function init()
  {
    parent::init();
    $this->model = new $this->modelClass();
    
    if (is_string($this->cache)) {
      $this->cache = Yii::$app->get($this->cache, false);
    }
  }

  public function getMenu($menu)
  {
    $data = [];
    
    if (! isset($this->_data[$menu])) {
      
      if ($this->cache instanceof Cache) {
        
        $data = $this->cache->get($this->cacheKey);
        
        if ($data === false || ! isset($data[$menu])) {
          
          $data[$menu] = $this->getDataFromDB($menu);
          $this->cache->set($this->cacheKey, $data);
        }
      } else {
        
        $data[$menu] = $this->getDataFromDB($menu);
      }
      $this->_data[$menu] = $data[$menu];
    }
    
    return $this->_data[$menu];
  }

  public function getDataFromDB($menu)
  {
    $this->model->type = $menu;
    
    $data = $this->model->getLinksByMenuSlug($menu);

    ArrayHelper::multisort($data, ["pid","weight"],[SORT_ASC,SORT_DESC]);
    
    $temp = [];
    
    foreach ($data as $link)
    {
      $temp[$link['pid']][] = $link;
    }
     
    $items = [];  

    $this->buildNavItems($temp,0,$items);
    
    return $items;
  }
    
  public function buildNavItems($data,$key,&$result)
  {
    foreach ($data[$key] as $link)
    {
      $pid = $link['mlid'];
      $link = $this->buildItem($link);
      
      if(isset($data[$pid]))
      {
         $this->buildNavItems($data,$pid,$link['items']);
      }
      $result[] = $link;
    }
  }
  
  public function buildItem($link)
  {
    $result['label'] = $link['label'];
    $result['encode'] = boolval($link["encode"]); 
    $result['options']=Serializer::unserializeToArray($link['options']);
    if(empty($link['url']))
    {
      $link['url'] = (Array)Serializer::unserializeToArray($link['route_parameters']);
      array_unshift( $link['url'] ,$link['route_name']);
    }
    $result['url'] = $link['url'];
    $result['linkOptions']=(Array)Serializer::unserializeToArray($link['linkOptions']);
    $result['visible'] = $link['visible'];
    return $result;
  }
}

?>