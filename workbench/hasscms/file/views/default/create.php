<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\file\models\FileManaged */

$this->title = 'Create File Managed';
$this->params['breadcrumbs'][] = ['label' => 'File Manageds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-managed-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
