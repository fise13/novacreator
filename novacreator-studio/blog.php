<?php
/**
 * Страница блога
 * Полезные статьи о SEO, маркетинге и разработке
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.blog.breadcrumb');
$pageMetaTitle = t('seo.pages.blog.title');
$pageMetaDescription = t('seo.pages.blog.description');
$pageMetaKeywords = t('seo.pages.blog.keywords');
include 'includes/header.php';

// Загружаем статьи из JSON файла
$blogFile = __DIR__ . '/data/blog.json';
$articles = [];
if (file_exists($blogFile)) {
    $articles = json_decode(file_get_contents($blogFile), true) ?: [];
}

// Сортируем по дате (новые сначала)
usort($articles, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// Пагинация
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 6;
$totalArticles = count($articles);
$totalPages = ceil($totalArticles / $perPage);
$offset = ($page - 1) * $perPage;
$articles = array_slice($articles, $offset, $perPage);

// Функция для получения цвета категории
function getCategoryColor($category) {
    $colors = [
        'SEO' => 'text-neon-purple',
        'Google Ads' => 'text-neon-blue',
        'Разработка' => 'text-neon-purple',
        'Маркетинг' => 'text-neon-blue',
        'Кейсы' => 'text-neon-purple',
        'Аналитика' => 'text-neon-blue'
    ];
    return $colors[$category] ?? 'text-gray-400';
}

// Функция для форматирования даты
function formatDate($date) {
    global $currentLang;
    $parts = explode('-', $date);
    $month = t('months.' . $parts[1]);
    if ($currentLang === 'en') {
        return $month . ' ' . (int)$parts[2] . ', ' . $parts[0];
    }
    return (int)$parts[2] . ' ' . $month . ' ' . $parts[0];
}
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.blog.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.blog.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Статьи -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <?php if (empty($articles)): ?>
            <div class="text-center py-20">
                <p class="text-xl text-gray-400"><?php echo htmlspecialchars(t('pages.blog.noArticles')); ?></p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($articles as $index => $article): ?>
                    <article class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300 hover:-translate-y-2 animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                        <div class="mb-4">
                            <span class="text-sm <?php echo getCategoryColor($article['category']); ?> font-semibold"><?php echo htmlspecialchars($article['category']); ?></span>
                            <span class="text-gray-500 mx-2">•</span>
                            <span class="text-sm text-gray-500"><?php echo formatDate($article['date']); ?></span>
                        </div>
                        <h2 class="text-2xl font-bold mb-4 text-gradient">
                            <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post'); ?>?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="hover:text-neon-blue transition-colors">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </a>
                        </h2>
                        <p class="text-gray-400 mb-6 leading-relaxed">
                            <?php echo htmlspecialchars($article['excerpt']); ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post'); ?>?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                            <?php echo htmlspecialchars(t('pages.blog.readMore')); ?>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Пагинация -->
            <?php if ($totalPages > 1): ?>
                <div class="mt-12 text-center">
                    <div class="inline-flex space-x-2">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>" class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-400 hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                <?php echo htmlspecialchars(t('pages.blog.pagination.prev')); ?>
                            </a>
                        <?php else: ?>
                            <span class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-500 cursor-not-allowed"><?php echo htmlspecialchars(t('pages.blog.pagination.prev')); ?></span>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <?php if ($i == $page): ?>
                                <span class="px-4 py-2 bg-neon-purple text-white rounded-lg font-semibold"><?php echo $i; ?></span>
                            <?php else: ?>
                                <a href="?page=<?php echo $i; ?>" class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-400 hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                    <?php echo $i; ?>
                                </a>
                            <?php endif; ?>
                        <?php endfor; ?>
                        
                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $page + 1; ?>" class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-400 hover:border-neon-purple hover:text-neon-purple transition-all duration-300">
                                <?php echo htmlspecialchars(t('pages.blog.pagination.next')); ?>
                            </a>
                        <?php else: ?>
                            <span class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-500 cursor-not-allowed"><?php echo htmlspecialchars(t('pages.blog.pagination.next')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <?php echo htmlspecialchars(t('pages.blog.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.blog.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.blog.cta.button')); ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

