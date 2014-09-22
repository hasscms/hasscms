<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\node\models\NodeType */

$this->title = 'Create Node Type';
$this->params['breadcrumbs'][] = ['label' => 'Node Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="node-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
