<?php
namespace hasscms\taxonomy\components;

use Yii;
use yii\caching\Cache;
use hasscms\base\helper\TreeList;

class Taxonomy extends \yii\base\Component
{

  /**
   *
   * @var string
   */
  public $modelClass = '\hasscms\taxonomy\models\TaxonomyTerm';

  /**
   * Model to for storing and retrieving settings
   *
   * @var \hasscms\taxonomy\models\TaxonomyTerm
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

  public $cacheKey = "hasscms.taxonomy";
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

  public function getTaxonomy($taxonomy)
  {
    $data = [];
    
    if (! isset($this->_data[$taxonomy])) {
      
      if ($this->cache instanceof Cache) {
        
        $data = $this->cache->get($this->cacheKey);
        
        if ($data === false || ! isset($data[$taxonomy])) {
          
          $data[$taxonomy] = $this->getDataFromDB($taxonomy);
          $this->cache->set($this->cacheKey, $data);
        }
      } else {
        
        $data[$taxonomy] = $this->getDataFromDB($taxonomy);
      }
      $this->_data[$taxonomy] = $data[$taxonomy];
    }
    
    return $this->_data[$taxonomy];
  }

  public function getDataFromDB($taxonomy)
  {
    $this->model->type = $taxonomy;
    
    $data = $this->model->getTermsByTaxonomySlug($taxonomy);
    
    $data = TreeList::format($data, "tid", "name", "pid");
    
    return $data;
  }
}

?>