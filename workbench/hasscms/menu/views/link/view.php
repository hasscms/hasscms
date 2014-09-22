<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hasscms\menu\models\MenuLink */

$this->title = $model->mlid;
$this->params['breadcrumbs'][] = ['label' => 'Menu Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-link-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create', ['create','menu'=>$model->type], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->mlid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->mlid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'mlid',
            'type',
            'pid',
            'label',
            'encode',
            'options:ntext',
            'url:url',
            'route_name',
            'route_parameters:ntext',
            'linkOptions:ntext',
            'visible',
            'weight',
            'data:ntext',
            'active_with_others:ntext',
            'active_with_parent',
        ],
    ]) ?>

</div>
