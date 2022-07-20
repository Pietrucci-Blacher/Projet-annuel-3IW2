<?php
header('Content-Type: text/plain; charset=UTF-8', true);

echo "User-agent: *" . "\n";

foreach ($this->data['forbiddenCrawlUrls'] as $index => $forbiddenCrawlUrl) {
    echo 'Disallow:' . $forbiddenCrawlUrl . "\n";
}
echo 'Sitemap: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]/sitemap";