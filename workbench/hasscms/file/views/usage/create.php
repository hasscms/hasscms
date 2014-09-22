<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileUsage */

$this->title = 'Create File Usage';
$this->params['breadcrumbs'][] = ['label' => 'File Usages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-usage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
