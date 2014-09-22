<?php
namespace hasscms\setting;

class Module extends \yii\base\Module
{
  private $_systemMenus;
    
  public function init()
  {
    parent::init();
    
    $this->_systemMenus = [
      [
        'label' => '站点配置',
        'url' => [
          '/setting/system/site'
        ],
        'activeWithParent'=>false
      ],
      [
        'label' => '邮箱配置',
        'url' => [
          '/setting/system/mail'
        ],
        'activeWithParent'=>false
      ]
    ];
  }

  public  function getSyestemMenus()
  {
    return $this->_systemMenus;
  }
  
  public function registerSystemMenus($menu)
  {
      $this->_systemMenus = array_merge($this->_systemMenus,[$menu]);
  }

  public static function getCustomMenus()
  {
  }
}