<?php

/**
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 * @var amnah\yii2\user\models\Profile $profile
 */
$this->title = Yii::t('user', 'Create {modelClass}', [
  'modelClass' => 'User'
]);
$this->params['breadcrumbs'][] = [
  'label' => Yii::t('user', 'Users'),
  'url' => [
    'index'
  ]
];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
  'user' => $user,
  'profile' => $profile
], $this->context);

?>