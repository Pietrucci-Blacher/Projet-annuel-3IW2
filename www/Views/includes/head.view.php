<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='description' content= '<?php echo \App\Core\Config::getInstance()->get('app_description'); ?>'>
<meta name="robots" content="index,follow">
<meta name="googlebot" content="index,follow">
<base href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' ?>">
<meta name="authors" content="Maxime Pietrucci-Blacher , Chemseddine Ameziane, Benjamin Li">

<!-- Style tags -->
<link rel="stylesheet" href="/Public/css/framework.css">
<link rel="stylesheet" href="/Public/css/stylesheet.css">
<link rel="stylesheet" href="/Public/css/normalize.css">
<link rel="stylesheet" href="/Public/css/backend.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;700&display=swap" rel="stylesheet">
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<!-- App meta tags -->
<meta name="application-name" content="<?= \App\Core\Config::getInstance()->get('app_name')?>">
<meta name="rating" content="General">
<meta name="subject" content="your document's subject">
<link rel="manifest" href="manifest.json">

<!--Apple tags -->
<meta name="apple-mobile-web-app-title" content="<?= \App\Core\Config::getInstance()->get('app_name')?>">



<?php require __DIR__ .  '/script.view.php'; ?>




