<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileUsage */

$this->title = $model->fid;
$this->params['breadcrumbs'][] = ['label' => 'File Usages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-usage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'fid' => $model->fid, 'type' => $model->type, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'fid' => $model->fid, 'type' => $model->type, 'id' => $model->id], [
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
            'type',
            'id',
            'count',
        ],
    ]) ?>

</div>
