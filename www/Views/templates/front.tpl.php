<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= $this->title ?? \App\Core\Config::getInstance()->get('app_name') ?></title>
    <?php include(__DIR__ . '/../includes/head.view.php') ?>
</head>

<body>
<?php include(__DIR__ . '/../partial/menuFront.partial.php'); ?>
<div class="front container">
    <?php include __DIR__ .'/../' . $this->view. '.view.php';?>
</div>
</body>
</html>