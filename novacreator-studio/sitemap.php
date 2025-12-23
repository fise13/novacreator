<?php
/**
 * Динамический генератор sitemap.xml
 * Автоматически создает карту сайта с поддержкой мультиязычности и всех страниц
 */

header('Content-Type: application/xml; charset=utf-8');

// Подключаем систему локализации
require_once __DIR__ . '/includes/i18n.php';

// Базовый URL сайта (всегда без www и всегда HTTPS для правильной индексации)
$host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
// Убираем www из хоста, чтобы избежать редиректов в sitemap
$host = preg_replace('/^www\./i', '', $host);
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
// Всегда используем HTTPS для sitemap
$scheme = 'https';
$baseUrl = $scheme . '://' . $host;

// Текущая дата для lastmod
$currentDate = date('Y-m-d');

// Статические страницы сайта с приоритетами (оптимизировано для топ-10 Google)
$staticPages = [
    ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily', 'images' => true],
    ['url' => '/seo', 'priority' => '0.95', 'changefreq' => 'daily', 'images' => true], // Высокий приоритет для SEO страницы
    ['url' => '/services', 'priority' => '0.9', 'changefreq' => 'daily', 'images' => true],
    ['url' => '/ads', 'priority' => '0.9', 'changefreq' => 'daily', 'images' => true],
    ['url' => '/portfolio', 'priority' => '0.85', 'changefreq' => 'daily', 'images' => true],
    ['url' => '/blog', 'priority' => '0.85', 'changefreq' => 'daily', 'images' => true],
    ['url' => '/faq', 'priority' => '0.8', 'changefreq' => 'weekly', 'images' => false], // FAQ важен для SEO
    ['url' => '/contact', 'priority' => '0.8', 'changefreq' => 'monthly', 'images' => false],
    ['url' => '/about', 'priority' => '0.75', 'changefreq' => 'monthly', 'images' => true],
    ['url' => '/calculator', 'priority' => '0.7', 'changefreq' => 'monthly', 'images' => false],
    ['url' => '/vacancies', 'priority' => '0.65', 'changefreq' => 'weekly', 'images' => false],
];

// Загружаем статьи блога
$blogArticles = [];
$blogFile = __DIR__ . '/data/blog.json';
if (file_exists($blogFile)) {
    $blogArticles = json_decode(file_get_contents($blogFile), true) ?: [];
}

// Поддерживаемые языки (основные)
$languages = ['ru', 'en'];

// Дополнительные языки для глобального охвата в sitemap
// Google будет знать, что сайт доступен для всех этих регионов
$globalLanguageMap = [
    'ru' => 'ru-RU',
    'en' => 'en-US',
    'zh-CN' => 'zh-CN', // Китай
    'zh-TW' => 'zh-TW', // Тайвань
    'ja' => 'ja-JP', // Япония
    'ko' => 'ko-KR', // Корея
    'de' => 'de-DE', // Германия
    'fr' => 'fr-FR', // Франция
    'es' => 'es-ES', // Испания
    'it' => 'it-IT', // Италия
    'pt' => 'pt-PT', // Португалия
    'pt-BR' => 'pt-BR', // Бразилия
    'ar' => 'ar-SA', // Саудовская Аравия
    'hi' => 'hi-IN', // Индия
    'nl' => 'nl-NL', // Нидерланды
    'pl' => 'pl-PL', // Польша
    'tr' => 'tr-TR', // Турция
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
        http://www.google.com/schemas/sitemap-image/1.1
        http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd">
<?php
// Генерируем URL для статических страниц с мультиязычностью и изображениями
foreach ($staticPages as $page) {
    foreach ($languages as $lang) {
        $url = $baseUrl . getLocalizedUrl($lang, $page['url']);
        echo '    <url>' . PHP_EOL;
        echo '        <loc>' . htmlspecialchars($url) . '</loc>' . PHP_EOL;
        echo '        <lastmod>' . $currentDate . '</lastmod>' . PHP_EOL;
        echo '        <changefreq>' . $page['changefreq'] . '</changefreq>' . PHP_EOL;
        echo '        <priority>' . $page['priority'] . '</priority>' . PHP_EOL;
        
        // Добавляем альтернативные языковые версии (основные)
        foreach ($languages as $altLang) {
            $altUrl = $baseUrl . getLocalizedUrl($altLang, $page['url']);
            $hreflang = $altLang === 'ru' ? 'ru-RU' : 'en-US';
            echo '        <xhtml:link rel="alternate" hreflang="' . $hreflang . '" href="' . htmlspecialchars($altUrl) . '" />' . PHP_EOL;
        }
        
        // Добавляем x-default для глобального охвата
        $defaultUrl = $baseUrl . getLocalizedUrl('ru', $page['url']);
        echo '        <xhtml:link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($defaultUrl) . '" />' . PHP_EOL;
        
        // Добавляем изображения для страниц с images = true (улучшение для Google Images)
        if (!empty($page['images'])) {
            $imageUrl = $baseUrl . '/assets/img/og-default.webp';
            echo '        <image:image>' . PHP_EOL;
            echo '            <image:loc>' . htmlspecialchars($imageUrl) . '</image:loc>' . PHP_EOL;
            echo '            <image:title>' . htmlspecialchars($siteName . ' - ' . ($lang === 'ru' ? 'SEO продвижение сайтов' : 'SEO Website Promotion')) . '</image:title>' . PHP_EOL;
            echo '            <image:caption>' . htmlspecialchars($siteName . ' - ' . ($lang === 'ru' ? 'Профессиональное SEO-продвижение' : 'Professional SEO Promotion')) . '</image:caption>' . PHP_EOL;
            echo '        </image:image>' . PHP_EOL;
            
            // Добавляем логотип
            $logoUrl = $baseUrl . '/assets/img/logo.svg';
            echo '        <image:image>' . PHP_EOL;
            echo '            <image:loc>' . htmlspecialchars($logoUrl) . '</image:loc>' . PHP_EOL;
            echo '            <image:title>' . htmlspecialchars($siteName) . '</image:title>' . PHP_EOL;
            echo '        </image:image>' . PHP_EOL;
        }
        
        echo '    </url>' . PHP_EOL;
    }
}

// Генерируем URL для статей блога с мультиязычностью и изображениями
foreach ($blogArticles as $article) {
    // Получаем дату статьи
    $articleDate = isset($article['date']) ? date('Y-m-d', strtotime($article['date'])) : $currentDate;
    $articleImage = !empty($article['image']) ? $baseUrl . $article['image'] : $baseUrl . '/assets/img/og-default.webp';
    $articleTitle = !empty($article['title']) ? htmlspecialchars($article['title']) : '';
    
    // Русская версия статьи
    if (!empty($article['slug'])) {
        $ruUrl = $baseUrl . getLocalizedUrl('ru', '/blog-post?slug=' . $article['slug']);
        echo '    <url>' . PHP_EOL;
        echo '        <loc>' . htmlspecialchars($ruUrl) . '</loc>' . PHP_EOL;
        echo '        <lastmod>' . $articleDate . '</lastmod>' . PHP_EOL;
        echo '        <changefreq>weekly</changefreq>' . PHP_EOL; // Увеличиваем частоту обновления для блога
        echo '        <priority>0.75</priority>' . PHP_EOL; // Повышаем приоритет блога
        
        // Добавляем альтернативные языковые версии
        echo '        <xhtml:link rel="alternate" hreflang="ru-RU" href="' . htmlspecialchars($ruUrl) . '" />' . PHP_EOL;
        if (!empty($article['slug_en'])) {
            $enUrl = $baseUrl . getLocalizedUrl('en', '/blog-post?slug=' . $article['slug_en']);
            echo '        <xhtml:link rel="alternate" hreflang="en-US" href="' . htmlspecialchars($enUrl) . '" />' . PHP_EOL;
        }
        
        // Добавляем изображение статьи
        echo '        <image:image>' . PHP_EOL;
        echo '            <image:loc>' . htmlspecialchars($articleImage) . '</image:loc>' . PHP_EOL;
        if ($articleTitle) {
            echo '            <image:title>' . $articleTitle . '</image:title>' . PHP_EOL;
            echo '            <image:caption>' . $articleTitle . ' - ' . htmlspecialchars($siteName) . '</image:caption>' . PHP_EOL;
        }
        echo '        </image:image>' . PHP_EOL;
        
        echo '    </url>' . PHP_EOL;
    }
    
    // Английская версия статьи
    if (!empty($article['slug_en'])) {
        $enUrl = $baseUrl . getLocalizedUrl('en', '/blog-post?slug=' . $article['slug_en']);
        echo '    <url>' . PHP_EOL;
        echo '        <loc>' . htmlspecialchars($enUrl) . '</loc>' . PHP_EOL;
        echo '        <lastmod>' . $articleDate . '</lastmod>' . PHP_EOL;
        echo '        <changefreq>weekly</changefreq>' . PHP_EOL;
        echo '        <priority>0.75</priority>' . PHP_EOL;
        
        // Добавляем альтернативные языковые версии
        echo '        <xhtml:link rel="alternate" hreflang="en-US" href="' . htmlspecialchars($enUrl) . '" />' . PHP_EOL;
        if (!empty($article['slug'])) {
            $ruUrl = $baseUrl . getLocalizedUrl('ru', '/blog-post?slug=' . $article['slug']);
            echo '        <xhtml:link rel="alternate" hreflang="ru-RU" href="' . htmlspecialchars($ruUrl) . '" />' . PHP_EOL;
        }
        
        // Добавляем изображение статьи
        echo '        <image:image>' . PHP_EOL;
        echo '            <image:loc>' . htmlspecialchars($articleImage) . '</image:loc>' . PHP_EOL;
        if ($articleTitle) {
            echo '            <image:title>' . $articleTitle . '</image:title>' . PHP_EOL;
            echo '            <image:caption>' . $articleTitle . ' - ' . htmlspecialchars($siteName) . '</image:caption>' . PHP_EOL;
        }
        echo '        </image:image>' . PHP_EOL;
        
        echo '    </url>' . PHP_EOL;
    }
}
?>
</urlset>

