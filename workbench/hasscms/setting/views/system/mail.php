<?php
/**
 * @var yii\base\View $this
 */
use yii\helpers\Html;
use hasscms\setting\Module;
use yii\bootstrap\ActiveForm;

$this->params['contentMenu'] = Module::getInstance()->getSyestemMenus();
$this->title = '邮件设置';
$this->params['breadcrumbs'][] = $this->title;



$form = ActiveForm::begin([]);
echo $form->field($model, 'mailServer')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'mailLogin')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'mailPass')->passwordInput([
  'maxlength' => 128
]);

echo $form->field($model, 'mailPort')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'mailExpirationTime')->textInput([
  'maxlength' => 128
]);

echo $form->field($model, 'regVerificationEmail')->radioList([
  "1" => "是",
  "0" => "否"
]);

echo Html::tag("div", Html::submitButton('Update', [
  'class' => 'btn btn-primary'
]), [
  'class' => "form-group"
]);

ActiveForm::end();
