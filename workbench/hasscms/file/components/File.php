<?php
namespace hasscms\file\components;

use yii\di\ServiceLocator;
use yii\base\Component;

class File extends ServiceLocator
{

    public function __construct($config = [])
    {
        $this->preInit($config);
        Component::__construct($config);
    }

    public function preInit(&$config)
    {
        foreach ($this->coreComponents() as $id => $component) {
            if (! isset($config['components'][$id])) {
                $config['components'][$id] = $component;
            } elseif (is_array($config['components'][$id]) && ! isset($config['components'][$id]['class'])) {
                $config['components'][$id]['class'] = $component['class'];
            }
            
            if (!isset($config['components'][$id]['scheme']))
            {
                $config['components'][$id]['scheme'] = $id;
            }
        }
    }

    public function init()
    {
        parent::init();
    }

    public function coreComponents()
    {
        return [
            'local' => [
                'class' => 'hasscms\file\storage\LocalStorage'
            ],
            'ftp' => [
                'class' => 'hasscms\file\storage\FtpStorage'
            ]
        ];
    }
}

?>