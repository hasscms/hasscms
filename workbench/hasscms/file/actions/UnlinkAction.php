<?php
namespace hasscms\file\actions;

use yii\base\Action;
/**
 * public function actions(){
 *   return [
 *           'upload'=>[
 *               'class'=>'trntv\filekit\actions\DeleteAction',
 *           ]
 *       ];
 *   }
 */
class UnlinkAction extends Action
{
    
    public $fileStorage = 'fileStorage';
    public $fileparam = 'path';
    public $repositoryparam = 'repository';
    
    public function run()
    {
        return \Yii::$app->{$this->fileStorage}->delete(
            \Yii::$app->request->get($this->fileparam),
            \Yii::$app->request->get($this->repositoryparam)
        );
    }
}

?>