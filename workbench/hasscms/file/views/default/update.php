<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileManaged */

$this->title = 'Update File Managed: ' . ' ' . $model->fid;
$this->params['breadcrumbs'][] = ['label' => 'File Manageds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fid, 'url' => ['view', 'id' => $model->fid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="file-managed-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
