<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model hasscms\menu\models\MenuLinkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-link-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mlid') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'pid') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'encode') ?>

    <?php // echo $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'route_name') ?>

    <?php // echo $form->field($model, 'route_parameters') ?>

    <?php // echo $form->field($model, 'linkOptions') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'active_with_others') ?>

    <?php // echo $form->field($model, 'active_with_parent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
