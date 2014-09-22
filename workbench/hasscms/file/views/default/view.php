<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileManaged */

$this->title = $model->fid;
$this->params['breadcrumbs'][] = ['label' => 'File Manageds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-managed-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fid], [
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
            'fid',
            'uid',
            'filename',
            'uri',
            'filemime',
            'filesize',
            'status',
            'created',
            'changed',
        ],
    ]) ?>

</div>
