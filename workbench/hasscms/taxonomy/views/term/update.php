<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model hasscms\taxonomy\models\TaxonomyTerm */

$this->title = 'Update Taxonomy Term: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Taxonomy Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->tid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="taxonomy-term-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
