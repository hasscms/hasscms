<?php
/**
 * @var yii\base\View $this
 */
use yii\helpers\Html;
use hasscms\setting\Module;
use yii\bootstrap\ActiveForm;

$this->params['contentMenu'] =  Module::getInstance()->getSyestemMenus();
$this->title = '上传配置';
$this->params['breadcrumbs'][] = $this->title;


$form = ActiveForm::begin([]);
echo $form->field($model, 'allowExtension')->textInput([
  'maxlength' => 128
]);

echo Html::tag("div", Html::submitButton('Update', [
  'class' => 'btn btn-primary'
]), [
  'class' => "form-group"
]);

ActiveForm::end();