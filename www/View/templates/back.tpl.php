<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $this->title ?? \App\Core\Config::getInstance()->get('app_name') ?></title>
    <?php include('../includes/head.view.php') ?>
</head>
<body>

<?php include '../' . $this->view.".view.php";?>

</body>
</html>