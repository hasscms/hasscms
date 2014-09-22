<?php
use yii\adminUi\widget\Box;
use yii\bootstrap\Nav;
/**
 *
 * @var \yii\web\View $this
 * @var string $content
 */

/**
 * 内容页面子导航
 */

if ($this->context->module->id == "rbac") {
	$menus = $this->context->module->menus;
	array_pop($menus);
  $this->params['contentMenu'] = $menus;
}
?>
<?php
// 由于重新定义了nav挂件.所以使用自定义的布局
$this->beginContent( "@backend/themes/adminui/layouts/_main.php");
?>
<!-- contentMenu -->
<?php if(isset($this->params['contentMenu'])) :?>
<div class="content-menu">
      <?php
      echo Nav::widget([
        'options' => [
          'class' => 'nav nav-tabs'
        ],
        'items' => $this->params['contentMenu']
      ]);
      ?>
</div>
<?php endif;?>
<?php
  Box::begin([
    'type' => Box::TYPE_PRIMARY
  ]);

  echo \yii\helpers\Html::beginTag("div",["class"=>"clearfix"]);
  echo $content;
  echo \yii\helpers\Html::endTag("div");

  Box::end();

  $this->endContent();
?>