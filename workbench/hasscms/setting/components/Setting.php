<?php
namespace hasscms\setting\components;

use yii\base\Component;
use yii\caching\Cache;
use Yii;

class Setting extends Component
{

  /**
   *
   * @var string
   */
  public $modelClass = '\hasscms\setting\models\Setting';

  /**
   * Model to for storing and retrieving settings
   * 
   * @var \hasscms\setting\models\SettingInterface
   */
  protected $model;

  /**
   *
   * @var Cache string cache object or the application component ID of the cache object.
   *      Setting will be cached through this cache object, if it is available.
   *     
   *      After the Setting object is created, if you want to change this property,
   *      you should only assign it with a cache object.
   *      Set this property to null if you do not want to cache the settings.
   */
  public $cache = 'cache';
  
  public $cacheKey = "hasscms.setting";

  /**
   * Holds a cached copy of the data for the current request
   *
   * @var mixed
   */
  private $_data = null;

  /**
   * Initialize the component
   *
   * @throws \yii\base\InvalidConfigException
   */
  public function init()
  {
    parent::init();
    
    $this->model = new $this->modelClass();

    if (is_string($this->cache)) {
      $this->cache = Yii::$app->get($this->cache, false);
    }
  }

  /**
   * Get's the value for the given key and collection.
   * You can use dot notation to separate the collection from the key:
   * $value = $settings->get('collection.key');
   * and
   * $value = $settings->get('key', 'collection');
   * are equivalent
   *
   * @param
   *          $key
   * @param null $collection          
   * @return mixed
   */
  public function get($key, $collection = null)
  {
    if (is_null($collection)) {
      $pieces = explode('.', $key);
      $collection = $pieces[0];
      $key = $pieces[1];
    }
    
    $data = $this->getRawConfig();
    return $data[$collection][$key];
  }

  /**
   *
   * @param
   *          $key
   * @param
   *          $value
   * @param null $collection          
   * @param null $type          
   * @return boolean
   */
  public function set($key, $value, $collection = null, $type = null)
  {
    if (is_null($collection)) {
      $pieces = explode('.', $key);
      $collection = $pieces[0];
      $key = $pieces[1];
    }
    
    if ($this->model->setSetting($collection, $key, $value, $type)) {
      if ($this->clearCache()) {
        return true;
      }
    }
    return false;
  }

  /**
   * Deletes a setting
   *
   * @param
   *          $key
   * @param null|string $collection          
   * @return bool
   */
  public function delete($key, $collection = null)
  {
    if (is_null($collection)) {
      $pieces = explode('.', $key);
      $collection = $pieces[0];
      $key = $pieces[1];
    }
    return $this->model->deleteSetting($collection, $key) && $this->clearCache();
  }

  /**
   * Deletes all setting.
   * Be careful!
   *
   * @return bool
   */
  public function deleteAll()
  {
    return $this->model->deleteAllSettings() && $this->clearCache();
  }

  /**
   * Activates a setting
   *
   * @param
   *          $key
   * @param null|string $collection          
   * @return bool
   */
  public function activate($key, $collection = null)
  {
    if (is_null($collection)) {
      $pieces = explode('.', $key);
      $collection = $pieces[0];
      $key = $pieces[1];
    }
    return $this->model->activateSetting($collection, $key) && $this->clearCache();
  }

  /**
   * Deactivates a setting
   *
   * @param
   *          $key
   * @param null|string $collection          
   * @return bool
   */
  public function deactivate($key, $collection = null)
  {
    if (is_null($collection)) {
      $pieces = explode('.', $key);
      $collection = $pieces[0];
      $key = $pieces[1];
    }
    return $this->model->deactivateSetting($collection, $key) && $this->clearCache();
  }

  /**
   * Clears the settings cache on demand.
   * If you haven't configured cache this does nothing.
   *
   * @return boolean True if the cache key was deleted and false otherwise
   */
  public function clearCache()
  {
    $this->_data = null;
    if ($this->cache instanceof Cache) {
      return $this->cache->delete($this->cacheKey);
    }
    return true;
  }

  /**
   * Returns the raw configuration array
   *
   * @return array
   */
  public function getRawConfig()
  {
    if ($this->_data === null) {
      if ($this->cache instanceof Cache) {
        
        $data = $this->cache->get($this->cacheKey);
        
        if ($data === false) {
          $data = $this->model->getSettings();
          $this->cache->set($this->cacheKey, $data);
        }
      } else {
        $data = $this->model->getSettings();
      }
      $this->_data = $data;
    }
    return $this->_data;
  }
}
