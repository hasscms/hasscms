<?php

namespace hasscms\base\ui\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\adminUi\widget\Dropdown;

class Nav extends \yii\adminUi\widget\Nav
{

  public function renderItem($item)
  {
    if (is_string($item)) {
      return $item;
    }
    if(isset($item['content'])){
      return Html::tag('li', $item['content'], $item['options']);
    }
    if (!isset($item['label'])) {
      throw new InvalidConfigException("The 'label' option is required.");
    }
    $label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
    $options = ArrayHelper::getValue($item, 'options', []);
    $items = ArrayHelper::getValue($item, 'items');
    $url = ArrayHelper::getValue($item, 'url', '#');
    $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
    $badgeOptions = ArrayHelper::getValue($item, 'badgeOptions', []);
    
    //增加
    $activeWithOthers =  ArrayHelper::getValue($item, 'activeWithOthers', []);
  
    if (isset($item['active'])) {
      $active = ArrayHelper::remove($item, 'active', false);
    } else {
      $active = $this->isItemActive($item);
    }
  
    if ($items !== null) {
      //$linkOptions['data-toggle'] = 'treeview';
      Html::addCssClass($options, 'treeview');
      //Html::addCssClass($linkOptions, 'treeview-menu');
      //$label .= ' ' . Html::tag('i', '', ['class' => 'fa fa-angle-left pull-right']);
      if (is_array($items)) {
        if ($this->activateItems) {
          $items = $this->isChildActiveRoute($items, $active,$activeWithOthers);
        }
        $items = Dropdown::widget([
          'items' => $items,
          'encodeLabels' => $this->encodeLabels,
          'clientOptions' => false,
          'type' => Dropdown::NAV,
          'view' => $this->getView(),
          ]);
      }
    }
  
    if ($this->activateItems && $active) {
      Html::addCssClass($options, 'active');
    }
  
    $label = Html::tag('i', '', $linkOptions).Html::tag('span', $label);
    $label .= $this->renderBadge($badgeOptions);
    if ($items !== null) {
      $label .= Html::tag('i', '', ['class' => 'fa fa-angle-left pull-right']);
    }
  
    return Html::tag('li', Html::a($label, $url) . $items, $options);
  }
  
  protected function isChildActiveRoute($items, &$active,$activeWithOthers)
  {
    foreach ($items as $i => $child) {
      if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
        Html::addCssClass($items[$i]['options'], 'active');
        if ($this->activateParents) {
          $active = true;
        }
      }
    }
    
    if(!empty($activeWithOthers)&&$this->isInActives($this->route,$activeWithOthers)){
      $active = true;
    }
    return $items;
  }
  
  
  protected function isInActives($item,$routes)
  {
      $temp = ltrim($item, '/');
      $result = false;
      foreach ( $routes as $value)
      {
        $route = ltrim($value, '/');
        
        if ($temp == $route) {
         $result = true;
         break;
        }
        
        $routeArray = explode("/",$route);        
        if(array_pop($routeArray) === "*" && substr($temp, 0, strrpos( $temp,"/")) == substr($route, 0, strrpos( $route,"/") ))
        {
          $result = true;
          break;
        }
      }
      return $result;
  }
  
  protected function isItemActive($item)
  {
    if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
      $route = $item['url'][0];
      if ($route[0] !== '/' && Yii::$app->controller) {
        $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
      }
      
      $result = false;
      
      $route = ltrim($route, '/');
      
      if (ltrim($route, '/') === $this->route) {
        $result = true;
      }
      
      if(!isset($item['activeWithParent']))
      {
        $item['activeWithParent'] = true;
      }
      
      if($item['activeWithParent'] !=false && substr($route, 0, strrpos( $route,"/")) == substr( $this->route, 0, strrpos(  $this->route,"/") ))
      {
        $result = true;
      }
      
      if($result == false){
        return $result;
      }

      unset($item['url']['#']);
      if (count($item['url']) > 1) {
        foreach (array_splice($item['url'], 1) as $name => $value) {
          if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
            return false;
          }
        }
      }
  
      return true;
    }
  
    return false;
  }
  
  
}