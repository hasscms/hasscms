<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

$this->title = "清除缓存";
$this->params['breadcrumbs'][] = "工具";
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([]);

echo DetailView::widget([
  'model' => $model,
  'template' => "<tr><th>{label}</th><td>" . Html::checkbox("cache[{value}]", true) . "</td></tr>"
]);

echo Html::tag("div", Html::submitButton("清除选中缓存", [
  'class' => 'btn btn-default btn-sm btn-flat margin'
]) . Html::a('清除全部缓存', [
  'flush'
], [
  'class' => 'btn btn-danger btn-sm btn-flat margin',
  'data' => [
    'confirm' => '你确定要清除所有缓存吗?',
    'method' => 'post'
  ]
]), [
  'class' => "form-group"
]);

ActiveForm::end();

?>
