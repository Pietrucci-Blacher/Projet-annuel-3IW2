<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?= $this->title ?? null ?></title>
    <?php include(__DIR__ . '/../includes/head.view.php') ?>
</head>
<body>

    <?php include __DIR__ .'/../' . $this->view. '.view.php';?>

</body>
</html>