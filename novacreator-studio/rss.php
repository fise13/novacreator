<?php
/**
 * RSS Feed для блога NovaCreator Studio
 * Генерирует RSS 2.0 фид для всех статей блога
 */

header('Content-Type: application/rss+xml; charset=utf-8');

// Загружаем статьи
$blogFile = __DIR__ . '/data/blog.json';
$articles = [];
if (file_exists($blogFile)) {
    $articles = json_decode(file_get_contents($blogFile), true) ?: [];
}

// Сортируем по дате (новые сначала)
usort($articles, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// Берем последние 20 статей
$articles = array_slice($articles, 0, 20);

// Определяем базовый URL
$host = $_SERVER['HTTP_HOST'] ?? 'novacreatorstudio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$siteUrl = $scheme . '://' . $host;
$siteName = 'NovaCreator Studio';
$siteDescription = 'Digital агентство: SEO-оптимизация, разработка сайтов, Google Ads, маркетинг';

// Функция для получения локализованного контента
function getArticleField($article, $field, $lang) {
    if ($lang === 'en' && isset($article[$field . '_en']) && !empty($article[$field . '_en'])) {
        return $article[$field . '_en'];
    }
    return $article[$field] ?? '';
}

function getArticleSlug($article, $lang) {
    if ($lang === 'en' && isset($article['slug_en']) && !empty($article['slug_en'])) {
        return $article['slug_en'];
    }
    return $article['slug'] ?? '';
}

// Определяем язык из параметра или используем русский по умолчанию
$lang = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'ru';
$langCode = $lang === 'ru' ? 'ru-RU' : 'en-US';

// Генерируем XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title><?php echo htmlspecialchars($siteName); ?> - <?php echo $lang === 'ru' ? 'Блог' : 'Blog'; ?></title>
        <link><?php echo htmlspecialchars($siteUrl); ?>/blog</link>
        <description><?php echo htmlspecialchars($siteDescription); ?></description>
        <language><?php echo htmlspecialchars($langCode); ?></language>
        <lastBuildDate><?php echo date('r'); ?></lastBuildDate>
        <pubDate><?php echo !empty($articles) ? date('r', strtotime($articles[0]['date'])) : date('r'); ?></pubDate>
        <ttl>60</ttl>
        <generator>NovaCreator Studio RSS Generator</generator>
        <image>
            <url><?php echo htmlspecialchars($siteUrl); ?>/assets/img/logo.svg</url>
            <title><?php echo htmlspecialchars($siteName); ?></title>
            <link><?php echo htmlspecialchars($siteUrl); ?></link>
        </image>
        <atom:link href="<?php echo htmlspecialchars($siteUrl); ?>/rss.php?lang=<?php echo $lang; ?>" rel="self" type="application/rss+xml"/>
        
        <?php foreach ($articles as $article): ?>
            <?php
            $title = getArticleField($article, 'title', $lang);
            $excerpt = getArticleField($article, 'excerpt', $lang);
            $slug = getArticleSlug($article, $lang);
            $content = getArticleField($article, 'content', $lang);
            $category = getArticleField($article, 'category', $lang);
            $image = $article['image'] ?? '/assets/img/og-default.webp';
            $articleUrl = $siteUrl . ($lang === 'en' ? '/en' : '') . '/blog-post?slug=' . urlencode($slug);
            $imageUrl = $siteUrl . $image;
            $pubDate = date('r', strtotime($article['date']));
            $author = $article['author'] ?? 'NovaCreator Studio';
            ?>
            <item>
                <title><?php echo htmlspecialchars($title); ?></title>
                <link><?php echo htmlspecialchars($articleUrl); ?></link>
                <guid isPermaLink="true"><?php echo htmlspecialchars($articleUrl); ?></guid>
                <description><![CDATA[<?php echo htmlspecialchars($excerpt); ?>]]></description>
                <content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
                <pubDate><?php echo $pubDate; ?></pubDate>
                <dc:creator><?php echo htmlspecialchars($author); ?></dc:creator>
                <category><?php echo htmlspecialchars($category); ?></category>
                <enclosure url="<?php echo htmlspecialchars($imageUrl); ?>" type="image/jpeg"/>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>

