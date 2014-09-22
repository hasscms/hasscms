<?php
/**
 * @var yii\base\View $this
 */
use yii\helpers\Html;
use hasscms\setting\Module;
use yii\bootstrap\ActiveForm;

$this->params['contentMenu'] =  Module::getInstance()->getSyestemMenus();
$this->title = '站点设置';
$this->params['breadcrumbs'][] = $this->title;


$form = ActiveForm::begin([]);
echo $form->field($model, 'siteUrl')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'siteName')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'staticUrl')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'siteDesc')->textArea([
  'rows' => 6
]);

echo Html::tag("div", Html::submitButton('Update', [
  'class' => 'btn btn-primary'
]), [
  'class' => "form-group"
]);

ActiveForm::end();


