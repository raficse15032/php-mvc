<?php ob_start() ?>
<h1><?= $name ?></h1>
<h1><?= $message ?></h1>
<?php $content = (string) ob_get_clean() ?>

<?php include VIEW_PATH."/layouts/index.php"; ?>
