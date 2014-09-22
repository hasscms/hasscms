<?php
namespace hasscms\rbac;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;


class Module extends \mdm\admin\Module
{

  public function init()
  {
    parent::init();
    $this->setAliases([
      "rbac" => __DIR__,
      ]);

     Yii::$app->getView()->theme->pathMap["@rbac/views"] = ["@rbac/views","@mdm/admin/views"];
  }
  
  private function normalizeController()
  {
    $controllers = [];
    $this->menus = [];
    $mid = '/' . $this->getUniqueId() . '/';
    $items = ArrayHelper::merge($this->getCoreItems(), $this->items);
    foreach ($items as $id => $config) {
      $label = Inflector::humanize($id);
      $visible = true;
      if (is_array($config)) {
        $label = ArrayHelper::remove($config, 'label', $label);
        $visible = ArrayHelper::remove($config, 'visible', true);
      }
      if ($visible) {
        $this->menus[] = ['label' => $label, 'url' => [$mid . $id."/index"]];
        $controllers[$id] = $config;
      }
    }
    $this->controllerMap = ArrayHelper::merge($this->controllerMap, $controllers);
  }
  
  public function createController($route)
  {
    $this->normalizeController();
    return \yii\base\Module::createController($route);
  }
  
}

?>