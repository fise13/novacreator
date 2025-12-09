<?php
/**
 * Страница блога
 * Минималистичный дизайн в стиле holymedia.kz
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
<section class="pt-24 md:pt-32 pb-16 md:pb-20" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.blog.title')); ?>
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary); max-width: 65ch;">
                <?php echo htmlspecialchars(t('pages.blog.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Статьи -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <?php if (empty($articles)): ?>
                <div class="text-center py-20 animate-on-scroll">
                    <p class="text-xl md:text-2xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.blog.noArticles')); ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="space-y-12 md:space-y-16">
                    <?php foreach ($articles as $index => $article): ?>
                        <?php
                        $title = getArticleField($article, 'title', $currentLang);
                        $excerpt = getArticleField($article, 'excerpt', $currentLang);
                        $slug = getArticleSlug($article, $currentLang);
                        $category = getArticleField($article, 'category', $currentLang);
                        $date = formatDate($article['date']);
                        ?>
                        <article class="animate-on-scroll" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="mb-4">
                                <span class="text-sm uppercase tracking-wider" style="color: var(--color-text-secondary);">
                                    <?php echo htmlspecialchars($category); ?>
                                </span>
                                <span class="mx-2" style="color: var(--color-text-secondary);">•</span>
                                <span class="text-sm" style="color: var(--color-text-secondary);">
                                    <?php echo htmlspecialchars($date); ?>
                                </span>
                            </div>
                            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                                <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post?slug=' . urlencode($slug)); ?>" class="hover:underline">
                                    <?php echo htmlspecialchars($title); ?>
                                </a>
                            </h2>
                            <p class="text-lg md:text-xl leading-relaxed mb-6" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo htmlspecialchars($excerpt); ?>
                            </p>
                            <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post?slug=' . urlencode($slug)); ?>" class="inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Read more' : 'Читать далее'; ?>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
                
                <!-- Пагинация -->
                <?php if ($totalPages > 1): ?>
                    <div class="mt-16 flex justify-center gap-4 animate-on-scroll">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>" class="px-6 py-3 border-2 rounded-lg hover:bg-gray-50 transition-colors" style="border-color: var(--color-border); color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Previous' : 'Назад'; ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="px-6 py-3 border-2 rounded-lg transition-colors <?php echo $i === $page ? 'bg-black text-white' : 'hover:bg-gray-50'; ?>" style="<?php echo $i === $page ? '' : 'border-color: var(--color-border); color: var(--color-text);'; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                        
                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $page + 1; ?>" class="px-6 py-3 border-2 rounded-lg hover:bg-gray-50 transition-colors" style="border-color: var(--color-border); color: var(--color-text);">
                                <?php echo $currentLang === 'en' ? 'Next' : 'Вперед'; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Скрипт для анимации -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        scrollObserver.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
