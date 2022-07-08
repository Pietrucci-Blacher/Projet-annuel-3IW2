<!-- General Meta tags -->
<meta charset='UTF-8'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='description' content='<?= \App\Core\Config::getInstance()->get('app_description')?>'>
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<base href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' ?>">
<meta name="authors" content="Maxime Pietrucci-Blacher , Chemseddine Ameziane, Benjamin Li">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<!-- App meta tags -->
<meta name="application-name" content="<?= \App\Core\Config::getInstance()->get('app_name')?>">
<meta name="rating" content="General">
<meta name="subject" content="your document's subject">
<link rel="manifest" href="manifest.json">

<!-- Style tags -->
<link rel="stylesheet" href="./Public/css/stylesheet.css" type="text/css">
<link rel="stylesheet" href="./Public/css/framework.css" type="text/css">
<link rel="stylesheet" href="./Public/css/normalize.css" type="text/css">
<!--<link rel="stylesheet" href="./Public/css/backend.css" type="text/css">-->

<!-- App icons -->
<link rel="icon" sizes="192x192" href="https://png.pngitem.com/pimgs/s/49-497482_random-cartoon-png-transparent-png.png">
<link rel="apple-touch-icon" href="https://png.pngitem.com/pimgs/s/49-497482_random-cartoon-png-transparent-png.png">
<link rel="mask-icon" href="https://png.pngitem.com/pimgs/s/49-497482_random-cartoon-png-transparent-png.png" color="blue">

<!--Apple tags -->
<meta name="apple-mobile-web-app-title" content="<?= \App\Core\Config::getInstance()->get('app_name')?>">

<?php include('script.view.php'); ?>

