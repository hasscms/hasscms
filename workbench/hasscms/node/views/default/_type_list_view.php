<?php
use yii\helpers\Url;
?>
<li class="clearfix">
<a href="<?php echo Url::to(["create","type"=>$model->type]) ?>">
<span class="name"><?php echo $model->name; ?></span>
<div class="description">
<?php echo $model->description; ?>
</div>
</a>
</li>