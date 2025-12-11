<?php
/**
 * Динамический генератор sitemap.xml
 * Автоматически создает карту сайта с поддержкой мультиязычности и всех страниц
 */

header('Content-Type: application/xml; charset=utf-8');

// Подключаем систему локализации
require_once __DIR__ . '/includes/i18n.php';

// Базовый URL сайта
$host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$baseUrl = $scheme . '://' . $host;

// Текущая дата для lastmod
$currentDate = date('Y-m-d');

// Статические страницы сайта с приоритетами (оптимизировано для топ-10)
$staticPages = [
    ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
    ['url' => '/seo', 'priority' => '0.95', 'changefreq' => 'daily'], // Высокий приоритет для SEO страницы
    ['url' => '/services', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['url' => '/ads', 'priority' => '0.9', 'changefreq' => 'weekly'],
    ['url' => '/portfolio', 'priority' => '0.85', 'changefreq' => 'weekly'],
    ['url' => '/blog', 'priority' => '0.85', 'changefreq' => 'daily'],
    ['url' => '/faq', 'priority' => '0.8', 'changefreq' => 'weekly'], // FAQ важен для SEO
    ['url' => '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['url' => '/about', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['url' => '/calculator', 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['url' => '/vacancies', 'priority' => '0.6', 'changefreq' => 'weekly'],
];

// Загружаем статьи блога
$blogArticles = [];
$blogFile = __DIR__ . '/data/blog.json';
if (file_exists($blogFile)) {
    $blogArticles = json_decode(file_get_contents($blogFile), true) ?: [];
}

// Поддерживаемые языки
$languages = ['ru', 'en'];

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php
// Генерируем URL для статических страниц с мультиязычностью
foreach ($staticPages as $page) {
    foreach ($languages as $lang) {
        $url = $baseUrl . getLocalizedUrl($lang, $page['url']);
        echo '    <url>' . PHP_EOL;
        echo '        <loc>' . htmlspecialchars($url) . '</loc>' . PHP_EOL;
        echo '        <lastmod>' . $currentDate . '</lastmod>' . PHP_EOL;
        echo '        <changefreq>' . $page['changefreq'] . '</changefreq>' . PHP_EOL;
        echo '        <priority>' . $page['priority'] . '</priority>' . PHP_EOL;
        
        // Добавляем альтернативные языковые версии
        foreach ($languages as $altLang) {
            $altUrl = $baseUrl . getLocalizedUrl($altLang, $page['url']);
            echo '        <xhtml:link rel="alternate" hreflang="' . $altLang . '" href="' . htmlspecialchars($altUrl) . '" />' . PHP_EOL;
        }
        
        echo '    </url>' . PHP_EOL;
    }
}

// Генерируем URL для статей блога с мультиязычностью
foreach ($blogArticles as $article) {
    // Получаем дату статьи
    $articleDate = isset($article['date']) ? date('Y-m-d', strtotime($article['date'])) : $currentDate;
    
    // Русская версия статьи
    if (!empty($article['slug'])) {
        $ruUrl = $baseUrl . getLocalizedUrl('ru', '/blog-post?slug=' . $article['slug']);
        echo '    <url>' . PHP_EOL;
        echo '        <loc>' . htmlspecialchars($ruUrl) . '</loc>' . PHP_EOL;
        echo '        <lastmod>' . $articleDate . '</lastmod>' . PHP_EOL;
        echo '        <changefreq>monthly</changefreq>' . PHP_EOL;
        echo '        <priority>0.7</priority>' . PHP_EOL;
        
        // Добавляем альтернативные языковые версии
        echo '        <xhtml:link rel="alternate" hreflang="ru" href="' . htmlspecialchars($ruUrl) . '" />' . PHP_EOL;
        if (!empty($article['slug_en'])) {
            $enUrl = $baseUrl . getLocalizedUrl('en', '/blog-post?slug=' . $article['slug_en']);
            echo '        <xhtml:link rel="alternate" hreflang="en" href="' . htmlspecialchars($enUrl) . '" />' . PHP_EOL;
        }
        
        echo '    </url>' . PHP_EOL;
    }
    
    // Английская версия статьи
    if (!empty($article['slug_en'])) {
        $enUrl = $baseUrl . getLocalizedUrl('en', '/blog-post?slug=' . $article['slug_en']);
        echo '    <url>' . PHP_EOL;
        echo '        <loc>' . htmlspecialchars($enUrl) . '</loc>' . PHP_EOL;
        echo '        <lastmod>' . $articleDate . '</lastmod>' . PHP_EOL;
        echo '        <changefreq>monthly</changefreq>' . PHP_EOL;
        echo '        <priority>0.7</priority>' . PHP_EOL;
        
        // Добавляем альтернативные языковые версии
        echo '        <xhtml:link rel="alternate" hreflang="en" href="' . htmlspecialchars($enUrl) . '" />' . PHP_EOL;
        if (!empty($article['slug'])) {
            $ruUrl = $baseUrl . getLocalizedUrl('ru', '/blog-post?slug=' . $article['slug']);
            echo '        <xhtml:link rel="alternate" hreflang="ru" href="' . htmlspecialchars($ruUrl) . '" />' . PHP_EOL;
        }
        
        echo '    </url>' . PHP_EOL;
    }
}
?>
</urlset>

