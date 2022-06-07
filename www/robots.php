<?php
header('Content-Type: text/plain; charset=UTF-8', true);
$urlsforbiden = [
    "login.php",
    "login.doc",
    "login.txt",
    "login.pdf",
    "login.docx",
    "login.php"
];

echo "User-agent: *" . "\n";
foreach ($urlsforbiden as $url){
    echo "Disallow:" . $url . "\n";
}
echo "Sitemap:" . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]/sitemap.xml";