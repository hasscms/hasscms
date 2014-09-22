<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileUsage */

$this->title = 'Update File Usage: ' . ' ' . $model->fid;
$this->params['breadcrumbs'][] = ['label' => 'File Usages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fid, 'url' => ['view', 'fid' => $model->fid, 'type' => $model->type, 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-usage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
