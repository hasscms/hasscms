
<?php
// 由于重新定义了nav挂件.所以使用自定义的布局
$this->beginContent("@backend/themes/adminui/layouts/_main.php");
?>
<?= $content ?>
<?php
  $this->endContent();
?>