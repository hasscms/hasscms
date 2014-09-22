<?php

use yii\helpers\Html;
use yii\jui\Spinner;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hasscms\taxonomy\models\TaxonomyTerm */
/* @var $form yii\bootstrap\ActiveForm */

$tree = new \hasscms\base\helper\TreeList([
  'data' => $model->getTermsByTaxonomySlug(),
  'key' => "tid"
])

?>

<div class="taxonomy-term-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type',['options'=>['class'=>"hide"]])->hiddenInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'pid')->dropDownList($tree->run())?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?=$form->field($model, 'weight', ['inputTemplate' => "<div>" . Spinner::widget(['model' => $model,'attribute' => 'weight','clientOptions' => ['step' => 1]]) . "</div>"])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
