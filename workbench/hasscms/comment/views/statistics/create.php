<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentStatistics */

$this->title = 'Create Comment Statistics';
$this->params['breadcrumbs'][] = ['label' => 'Comment Statistics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-statistics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
