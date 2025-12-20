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

<!-- Hero секция - Apple минималистичный дизайн на весь экран -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.blog.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.blog.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Статьи -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <?php if (empty($articles)): ?>
                <div class="text-center py-20 reveal">
                    <p class="text-xl md:text-2xl" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('pages.blog.noArticles')); ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    <?php foreach ($articles as $index => $article): ?>
                        <?php
                        $title = getArticleField($article, 'title', $currentLang);
                        $excerpt = getArticleField($article, 'excerpt', $currentLang);
                        $slug = getArticleSlug($article, $currentLang);
                        $category = getArticleField($article, 'category', $currentLang);
                        $date = formatDate($article['date']);
                        ?>
                        <article class="blog-card reveal group relative overflow-hidden rounded-2xl p-8 md:p-10 transition-all duration-500 hover:scale-[1.02]" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                            <!-- Декоративный градиент при hover -->
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);"></div>
                            
                            <div class="relative z-10">
                                <!-- Метаданные -->
                                <div class="mb-6 flex items-center gap-3 flex-wrap">
                                    <span class="blog-category px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider transition-all duration-300" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%); color: var(--color-text); border: 1px solid rgba(99, 102, 241, 0.2);">
                                        <?php echo htmlspecialchars($category); ?>
                                    </span>
                                    <span class="text-sm" style="color: var(--color-text-secondary);">
                                        <?php echo htmlspecialchars($date); ?>
                                    </span>
                                </div>
                                
                                <!-- Заголовок -->
                                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 leading-tight transition-colors duration-300 group-hover:opacity-90" style="color: var(--color-text);">
                                    <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post?slug=' . urlencode($slug)); ?>" class="blog-title-link">
                                        <?php echo htmlspecialchars($title); ?>
                                    </a>
                                </h2>
                                
                                <!-- Описание -->
                                <p class="text-base md:text-lg leading-relaxed mb-6 line-clamp-3" style="color: var(--color-text-secondary);">
                                    <?php echo htmlspecialchars($excerpt); ?>
                                </p>
                                
                                <!-- Кнопка "Читать далее" -->
                                <a href="<?php echo getLocalizedUrl($currentLang, '/blog-post?slug=' . urlencode($slug)); ?>" class="blog-read-more-btn inline-flex items-center gap-2 px-6 py-3 rounded-full font-medium transition-all duration-300 group-hover:gap-3" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);">
                                    <span><?php echo $currentLang === 'en' ? 'Read more' : 'Читать далее'; ?></span>
                                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                
                <!-- Пагинация -->
                <?php if ($totalPages > 1): ?>
                    <div class="mt-16 flex flex-wrap justify-center items-center gap-3 reveal">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>" class="pagination-btn pagination-btn-prev inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-medium transition-all duration-300 hover:gap-3" style="border: 1px solid var(--color-border); color: var(--color-text); background-color: var(--color-bg);">
                                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span><?php echo $currentLang === 'en' ? 'Previous' : 'Назад'; ?></span>
                            </a>
                        <?php endif; ?>
                        
                        <div class="flex gap-2">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <?php if ($i === $page): ?>
                                    <span class="pagination-btn pagination-btn-active inline-flex items-center justify-center w-10 h-10 rounded-full font-medium transition-all duration-300" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);">
                                        <?php echo $i; ?>
                                    </span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>" class="pagination-btn pagination-btn-number inline-flex items-center justify-center w-10 h-10 rounded-full font-medium transition-all duration-300 hover:scale-110" style="border: 1px solid var(--color-border); color: var(--color-text); background-color: var(--color-bg);">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        
                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $page + 1; ?>" class="pagination-btn pagination-btn-next inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-medium transition-all duration-300 hover:gap-3" style="border: 1px solid var(--color-border); color: var(--color-text); background-color: var(--color-bg);">
                                <span><?php echo $currentLang === 'en' ? 'Next' : 'Вперед'; ?></span>
                                <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Стили для блога -->
<style>
/* Карточки блога */
.blog-card {
    position: relative;
    overflow: hidden;
    will-change: transform;
}

.blog-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(99, 102, 241, 0.08), 
        transparent);
    transition: left 0.6s ease;
    pointer-events: none;
}

.blog-card:hover::before {
    left: 100%;
}

.blog-title-link {
    transition: color 0.3s ease;
    text-decoration: none;
}

.blog-title-link:hover {
    color: #6366f1;
}

/* Кнопка "Читать далее" */
.blog-read-more-btn {
    position: relative;
    overflow: hidden;
    text-decoration: none;
}

.blog-read-more-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.2), 
        transparent);
    transition: left 0.5s ease;
}

.blog-read-more-btn:hover::before {
    left: 100%;
}

.blog-read-more-btn:hover {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    transform: translateY(-2px);
}

.blog-read-more-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(99, 102, 241, 0.3);
}

/* Категория блога */
.blog-category {
    transition: all 0.3s ease;
}

.blog-card:hover .blog-category {
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.15) 100%);
    border-color: rgba(99, 102, 241, 0.3);
    transform: scale(1.05);
}

/* Кнопки пагинации */
.pagination-btn {
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.pagination-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(99, 102, 241, 0.1), 
        transparent);
    transition: left 0.4s ease;
}

.pagination-btn:hover::before {
    left: 100%;
}

.pagination-btn:hover {
    border-color: rgba(99, 102, 241, 0.5);
    background-color: rgba(99, 102, 241, 0.05);
    transform: translateY(-2px);
}

.pagination-btn-prev:hover svg {
    transform: translateX(-2px);
}

.pagination-btn-next:hover svg {
    transform: translateX(2px);
}

.pagination-btn-number:hover {
    border-color: rgba(99, 102, 241, 0.5);
    background-color: rgba(99, 102, 241, 0.1);
    color: #6366f1;
}

.pagination-btn-active {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }
    50% {
        box-shadow: 0 4px 16px rgba(99, 102, 241, 0.5);
    }
}

/* Адаптивность */
@media (max-width: 768px) {
    .blog-card {
        padding: 1.5rem;
    }
    
    .pagination-btn {
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
    }
    
    .pagination-btn-number {
        width: 2.5rem;
        height: 2.5rem;
    }
}

/* Утилита для ограничения строк */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

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
    
    document.querySelectorAll('.reveal').forEach(el => {
        scrollObserver.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
