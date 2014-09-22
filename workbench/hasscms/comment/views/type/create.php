<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model hasscms\comment\models\CommentType */

$this->title = 'Create Comment Type';
$this->params['breadcrumbs'][] = ['label' => 'Comment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
