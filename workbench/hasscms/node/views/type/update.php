<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hasscms\node\models\NodeType */

$this->title = 'Update Node Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Node Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->type]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="node-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
