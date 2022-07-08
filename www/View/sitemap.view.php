<?php header('Content-Type: application/xml; charset="utf-8"', true) ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($indexinglinks as $key => $url): ?>
        <url>
            <loc><?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $url->link; ?></loc>
            <lastmod><?php echo date("Y-m-d"); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>1.00</priority>
        </url>
    <?php endforeach; ?>
</urlset>