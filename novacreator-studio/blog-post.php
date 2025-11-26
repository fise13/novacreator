<?php
/**
 * Страница отдельной статьи блога
 */
$blogFile = __DIR__ . '/data/blog.json';
$articles = [];
if (file_exists($blogFile)) {
    $articles = json_decode(file_get_contents($blogFile), true) ?: [];
}

// Находим статью по slug
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$article = null;
foreach ($articles as $item) {
    if ($item['slug'] === $slug) {
        $article = $item;
        // Увеличиваем счетчик просмотров
        $article['views'] = ($article['views'] ?? 0) + 1;
        // Обновляем в массиве
        foreach ($articles as &$art) {
            if ($art['id'] === $article['id']) {
                $art['views'] = $article['views'];
                break;
            }
        }
        // Сохраняем обновленные данные
        file_put_contents($blogFile, json_encode($articles, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        break;
    }
}

if (!$article) {
    header('HTTP/1.0 404 Not Found');
    include '404.php';
    exit;
}

$host = $_SERVER['HTTP_HOST'] ?? 'novacreator-studio.com';
$isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
$scheme = $isSecure ? 'https' : 'http';
$siteBase = $scheme . '://' . $host;
$absoluteUrl = static function (?string $path) use ($siteBase): string {
    if (!$path) {
        return $siteBase;
    }
    if (preg_match('#^https?://#i', $path)) {
        return $path;
    }
    return rtrim($siteBase, '/') . '/' . ltrim($path, '/');
};
$articleUrl = $siteBase . '/blog-post?slug=' . urlencode($article['slug']);
$articleImage = $absoluteUrl($article['image'] ?? '/assets/img/og-default.webp');

$pageTitle = $article['title'];
$pageMetaTitle = $article['title'] . ' - NovaCreator Studio';
$pageMetaDescription = $article['excerpt'];
$pageMetaKeywords = $article['category'] . ', ' . strtolower($article['category']) . ' статьи, digital маркетинг';
$pageMetaImage = $articleImage;
$pageMetaCanonical = $articleUrl;
$pageMetaOgType = 'article';
$pageBreadcrumbs = [
    ['name' => 'Главная', 'url' => $siteBase . '/'],
    ['name' => 'Блог', 'url' => $siteBase . '/blog'],
    ['name' => $article['title'], 'url' => $articleUrl]
];
$pageStructuredData = [
    '@type' => 'BlogPosting',
    'headline' => $article['title'],
    'description' => $article['excerpt'],
    'image' => $articleImage,
    'datePublished' => $article['date'],
    'dateModified' => $article['date'],
    'author' => [
        '@type' => 'Organization',
        'name' => 'NovaCreator Studio',
        'url' => $siteBase
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'NovaCreator Studio',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $siteBase . '/assets/img/logo.svg'
        ]
    ],
    'mainEntityOfPage' => $articleUrl
];

include 'includes/header.php';

// Функция для форматирования даты
function formatDate($date) {
    $months = [
        '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
        '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
        '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
    ];
    $parts = explode('-', $date);
    return (int)$parts[2] . ' ' . $months[$parts[1]] . ' ' . $parts[0];
}

// Получаем похожие статьи
$relatedArticles = array_filter($articles, function($item) use ($article) {
    return $item['category'] === $article['category'] && $item['id'] !== $article['id'];
});
$relatedArticles = array_slice($relatedArticles, 0, 3);
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div class="mb-6">
                <a href="/blog" class="text-neon-purple hover:text-neon-blue transition-colors inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Вернуться к блогу
                </a>
            </div>
            
            <div class="mb-6">
                <span class="text-sm text-neon-purple font-semibold"><?php echo htmlspecialchars($article['category']); ?></span>
                <span class="text-gray-500 mx-2">•</span>
                <span class="text-sm text-gray-500"><?php echo formatDate($article['date']); ?></span>
                <?php if (isset($article['views']) && $article['views'] > 0): ?>
                    <span class="text-gray-500 mx-2">•</span>
                    <span class="text-sm text-gray-500"><?php echo $article['views']; ?> просмотров</span>
                <?php endif; ?>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars($article['title']); ?></span>
            </h1>
            
            <p class="text-xl text-gray-400 mb-8">
                <?php echo htmlspecialchars($article['excerpt']); ?>
            </p>
            
            <div class="flex items-center space-x-4 text-gray-400">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span><?php echo htmlspecialchars($article['author']); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Содержание статьи -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <article class="prose prose-invert prose-lg max-w-none">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-6 md:p-8 lg:p-12 shadow-2xl" style="box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(139, 92, 246, 0.1);">
                    <div class="article-content">
                        <?php echo $article['content']; ?>
                    </div>
                </div>
            </article>
            
            <!-- Поделиться -->
            <div class="mt-12 pt-8 border-t border-dark-border">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-gradient">Поделиться статьей</h3>
                        <div class="flex space-x-4">
                            <a href="https://vk.com/share.php?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&title=<?php echo urlencode($article['title']); ?>" target="_blank" class="w-10 h-10 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.785 16.241s-.224.015-.339.015c-.66 0-1.22-.061-1.672-.172-.9-.224-1.554-.785-1.554-1.554 0-.615.405-1.003 1.003-1.003.405 0 .75.195.975.405.405.36.81.615 1.554.615 1.003 0 1.554-.615 1.554-1.554 0-1.003-.615-1.554-1.554-1.554-.36 0-.66.09-.9.195l-.195-.405c.36-.195.81-.3 1.35-.3 1.554 0 2.559.975 2.559 2.559 0 1.554-.975 2.559-2.559 2.559zm-1.554-6.015c-1.554 0-2.559.975-2.559 2.559 0 1.554.975 2.559 2.559 2.559.36 0 .66-.09.9-.195l.195.405c-.36.195-.81.3-1.35.3-1.554 0-2.559-.975-2.559-2.559 0-1.003.615-1.554 1.554-1.554.405 0 .75.195.975.405.405.36.81.615 1.554.615 1.003 0 1.554-.615 1.554-1.554 0-1.003-.615-1.554-1.554-1.554-.36 0-.66.09-.9.195l-.195-.405c.36-.195.81-.3 1.35-.3 1.554 0 2.559.975 2.559 2.559 0 1.554-.975 2.559-2.559 2.559z"/>
                                </svg>
                            </a>
                            <a href="https://t.me/share/url?url=<?php echo urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" class="w-10 h-10 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.223s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Похожие статьи -->
<?php if (!empty($relatedArticles)): ?>
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-gradient text-center">Похожие статьи</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($relatedArticles as $related): ?>
                    <article class="bg-dark-bg border border-dark-border rounded-xl p-6 hover:border-neon-purple transition-all duration-300">
                        <div class="mb-4">
                            <span class="text-sm text-neon-purple font-semibold"><?php echo htmlspecialchars($related['category']); ?></span>
                            <span class="text-gray-500 mx-2">•</span>
                            <span class="text-sm text-gray-500"><?php echo formatDate($related['date']); ?></span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gradient">
                            <a href="/blog-post?slug=<?php echo htmlspecialchars($related['slug']); ?>" class="hover:text-neon-blue transition-colors">
                                <?php echo htmlspecialchars($related['title']); ?>
                            </a>
                        </h3>
                        <p class="text-gray-400 mb-4 text-sm leading-relaxed">
                            <?php echo htmlspecialchars(mb_substr($related['excerpt'], 0, 100)) . '...'; ?>
                        </p>
                        <a href="/blog-post?slug=<?php echo htmlspecialchars($related['slug']); ?>" class="text-neon-purple hover:text-neon-blue transition-colors text-sm font-semibold">
                            Читать →
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Нужна помощь с вашим проектом?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Свяжитесь с нами и получите бесплатную консультацию
            </p>
            <a href="/contact" class="btn-neon inline-block">
                Получить консультацию
            </a>
        </div>
    </div>
</section>

<style>
/* ============================================
   КРАСИВАЯ ТИПОГРАФИКА ДЛЯ БЛОГА
   ============================================ */

.article-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #E5E7EB;
}

/* Заголовки с градиентами */
.article-content h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid rgba(139, 92, 246, 0.3);
    background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.article-content h2::before {
    content: '';
    position: absolute;
    left: -1.5rem;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 60%;
    background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
    border-radius: 2px;
}

.article-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #D1D5DB;
    position: relative;
    padding-left: 1rem;
}

.article-content h3::before {
    content: '▸';
    position: absolute;
    left: 0;
    color: #8B5CF6;
    font-size: 1.25rem;
}

.article-content h4 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #9CA3AF;
}

/* Параграфы с улучшенной читаемостью */
.article-content p {
    margin-bottom: 1.5rem;
    color: #E5E7EB;
    line-height: 1.8;
    font-size: 1.125rem;
    text-align: justify;
}

.article-content p:first-of-type {
    font-size: 1.25rem;
    color: #D1D5DB;
    font-weight: 500;
    line-height: 1.9;
    margin-bottom: 2rem;
}

/* Списки с красивым оформлением */
.article-content ul,
.article-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
    color: #E5E7EB;
}

.article-content ul {
    list-style: none;
    padding-left: 0;
}

.article-content ul li {
    position: relative;
    padding-left: 2rem;
    margin-bottom: 1rem;
    line-height: 1.8;
    color: #E5E7EB;
}

.article-content ul li::before {
    content: '▹';
    position: absolute;
    left: 0;
    color: #8B5CF6;
    font-size: 1.25rem;
    font-weight: bold;
}

.article-content ol {
    counter-reset: list-counter;
    list-style: none;
    padding-left: 0;
}

.article-content ol li {
    position: relative;
    padding-left: 2.5rem;
    margin-bottom: 1rem;
    line-height: 1.8;
    color: #E5E7EB;
    counter-increment: list-counter;
}

.article-content ol li::before {
    content: counter(list-counter);
    position: absolute;
    left: 0;
    top: 0;
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
    border: 1px solid rgba(139, 92, 246, 0.5);
    border-radius: 0.375rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #8B5CF6;
    font-size: 0.875rem;
}

/* Выделение текста */
.article-content strong {
    color: #FFFFFF;
    font-weight: 700;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
}

.article-content em {
    color: #D1D5DB;
    font-style: italic;
    font-weight: 500;
}

/* Ссылки */
.article-content a {
    color: #8B5CF6;
    text-decoration: underline;
    text-decoration-color: rgba(139, 92, 246, 0.3);
    text-underline-offset: 0.25rem;
    transition: all 0.3s ease;
    font-weight: 500;
}

.article-content a:hover {
    color: #06B6D4;
    text-decoration-color: rgba(6, 182, 212, 0.5);
    text-decoration-thickness: 2px;
}

/* Цитаты */
.article-content blockquote {
    margin: 2rem 0;
    padding: 1.5rem 2rem;
    border-left: 4px solid #8B5CF6;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
    border-radius: 0.5rem;
    font-style: italic;
    color: #D1D5DB;
    position: relative;
}

.article-content blockquote::before {
    content: '"';
    position: absolute;
    top: -0.5rem;
    left: 1rem;
    font-size: 4rem;
    color: rgba(139, 92, 246, 0.2);
    font-family: Georgia, serif;
}

.article-content blockquote p {
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

/* Код */
.article-content code {
    background-color: rgba(139, 92, 246, 0.15);
    color: #A78BFA;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.article-content pre {
    background-color: #1a1a24;
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 0.5rem;
    padding: 1.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.article-content pre code {
    background: none;
    border: none;
    padding: 0;
    color: #E5E7EB;
}

/* Горизонтальная линия */
.article-content hr {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, rgba(139, 92, 246, 0.5) 50%, transparent 100%);
    margin: 3rem 0;
}

/* Таблицы */
.article-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    background-color: rgba(26, 26, 36, 0.5);
    border-radius: 0.5rem;
    overflow: hidden;
}

.article-content table th {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%);
    color: #FFFFFF;
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid rgba(139, 92, 246, 0.3);
}

.article-content table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(42, 42, 58, 0.5);
    color: #E5E7EB;
}

.article-content table tr:hover {
    background-color: rgba(139, 92, 246, 0.05);
}

/* Изображения */
.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.75rem;
    margin: 2rem 0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(139, 92, 246, 0.2);
}

/* Акценты и выделения */
.article-content mark {
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.3) 0%, rgba(6, 182, 212, 0.3) 100%);
    color: #FFFFFF;
    padding: 0.125rem 0.375rem;
    border-radius: 0.25rem;
    font-weight: 500;
}

/* Адаптивность */
@media (max-width: 768px) {
    .article-content {
        font-size: 1rem;
    }
    
    .article-content h2 {
        font-size: 1.75rem;
        padding-left: 1.5rem;
    }
    
    .article-content h2::before {
        left: 0;
        width: 3px;
    }
    
    .article-content h3 {
        font-size: 1.25rem;
    }
    
    .article-content p:first-of-type {
        font-size: 1.125rem;
    }
    
    .article-content ul,
    .article-content ol {
        padding-left: 1.5rem;
    }
    
    .article-content ul li {
        padding-left: 1.5rem;
    }
    
    .article-content ol li {
        padding-left: 2rem;
    }
    
    .article-content blockquote {
        padding: 1rem 1.5rem;
    }
}

/* Декоративные элементы */
.article-content p:first-of-type::first-letter {
    float: left;
    font-size: 4rem;
    line-height: 1;
    font-weight: 700;
    margin: 0.1em 0.1em 0 0;
    background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Улучшение для абзацев с отступами */
.article-content p + p {
    text-indent: 0;
}

/* Красивое оформление для вложенных списков */
.article-content ul ul,
.article-content ol ol,
.article-content ul ol,
.article-content ol ul {
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
    padding-left: 1.5rem;
}

.article-content ul ul li::before {
    content: '▪';
    color: #06B6D4;
}

/* Улучшение для выделения важных моментов */
.article-content p.highlight,
.article-content p[style*="background"],
.article-content p[style*="border"] {
    font-weight: 500;
    padding-left: 1.5rem;
    border-left: 3px solid rgba(139, 92, 246, 0.5);
    background: rgba(139, 92, 246, 0.05);
    padding: 1rem 1rem 1rem 1.5rem;
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}

/* Плавное появление элементов (опционально, можно отключить) */
.article-content > * {
    animation: fadeInUp 0.5s ease-out forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<?php include 'includes/footer.php'; ?>

