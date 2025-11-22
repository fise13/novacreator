<?php
/**
 * Генератор sitemap.xml
 * Автоматически создает sitemap на основе файлов в корне проекта
 * 
 * Использование: откройте в браузере или запустите через cron
 */

// Базовый URL сайта (автоматическое определение или укажите явно)
$siteUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
// Или укажите явно: $siteUrl = 'https://novacreator-studio.com';

// Список страниц с приоритетами и частотой обновления
$pages = [
    'index.php' => ['priority' => '1.0', 'changefreq' => 'weekly'],
    'services.php' => ['priority' => '0.9', 'changefreq' => 'monthly'],
    'seo.php' => ['priority' => '0.9', 'changefreq' => 'monthly'],
    'ads.php' => ['priority' => '0.9', 'changefreq' => 'monthly'],
    'portfolio.php' => ['priority' => '0.8', 'changefreq' => 'monthly'],
    'about.php' => ['priority' => '0.7', 'changefreq' => 'monthly'],
    'contact.php' => ['priority' => '0.8', 'changefreq' => 'monthly'],
    'vacancies.php' => ['priority' => '0.6', 'changefreq' => 'weekly'],
];

// Получаем дату последнего изменения (сегодня)
$lastmod = date('Y-m-d');

// Генерируем XML
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
$xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
$xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
$xml .= '        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n\n";

foreach ($pages as $file => $settings) {
    $url = $file === 'index.php' ? $siteUrl . '/' : $siteUrl . '/' . $file;
    
    // Получаем реальную дату изменения файла
    if (file_exists($file)) {
        $fileModTime = filemtime($file);
        $lastmod = date('Y-m-d', $fileModTime);
    }
    
    $xml .= "    <url>\n";
    $xml .= "        <loc>" . htmlspecialchars($url) . "</loc>\n";
    $xml .= "        <lastmod>$lastmod</lastmod>\n";
    $xml .= "        <changefreq>{$settings['changefreq']}</changefreq>\n";
    $xml .= "        <priority>{$settings['priority']}</priority>\n";
    $xml .= "    </url>\n\n";
}

$xml .= '</urlset>';

// Сохраняем в файл
file_put_contents(__DIR__ . '/sitemap.xml', $xml);

// Выводим результат
header('Content-Type: text/xml; charset=utf-8');
echo $xml;

?>

