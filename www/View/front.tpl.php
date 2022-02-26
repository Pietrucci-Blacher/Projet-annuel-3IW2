<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $title??"Template du front" ?></title>
    <meta name="description" content="ceci est la description de ma page">
    <link rel="stylesheet" href="../Public/css/framework.css">
    <link rel="stylesheet" href="../Public/css/stylesheet.css">
</head>
<body>

<?php include $this->view.".view.php";?>

</body>
</html>