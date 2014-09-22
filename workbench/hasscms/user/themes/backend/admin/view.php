<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 *
 * @var yii\web\View $this
 * @var amnah\yii2\user\models\User $user
 */

$this->title = "查看用户";
$this->params['breadcrumbs'][] = [
  'label' => Yii::t('user', 'Users'),
  'url' => [
    'index'
  ]
];
$this->params['breadcrumbs'][] = $this->title;

echo Html::a(Yii::t('user', 'Update'), [
  'update',
  'id' => $user->id
], [
  'class' => 'btn btn-default btn-sm btn-flat margin'
]);

echo Html::a(Yii::t('user', 'Delete'), [
  'delete',
  'id' => $user->id
], [
  'class' => 'btn btn-danger btn-sm btn-flat margin',
  'data' => [
    'confirm' => Yii::t('user', 'Are you sure you want to delete this item?'),
    'method' => 'post'
  ]
]);

echo DetailView::widget([
  'model' => $user,
  'attributes' => [
    'id',
    'role_id',
    'status',
    'email:email',
    'new_email:email',
    'username',
    'profile.full_name',
    'password',
    'auth_key',
    'api_key',
    'login_ip',
    'login_time',
    'create_ip',
    'create_time',
    'update_time',
    'ban_time',
    'ban_reason'
  ]
]);

?>
