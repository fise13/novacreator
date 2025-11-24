<?php
/**
 * Страница блога
 * Полезные статьи о SEO, маркетинге и разработке
 */
$pageTitle = 'Блог';
$pageMetaTitle = 'Блог о Digital-маркетинге | Полезные статьи - NovaCreator Studio';
$pageMetaDescription = 'Полезные статьи о SEO, разработке сайтов, Google Ads и digital-маркетинге. Советы экспертов, кейсы, новости индустрии.';
$pageMetaKeywords = 'блог digital маркетинг, статьи о SEO, статьи о разработке сайтов, статьи о рекламе, полезные материалы, кейсы, советы экспертов';
include 'includes/header.php';

// Подключаем кэш
require_once __DIR__ . '/includes/cache.php';

// Загружаем статьи из кэша или JSON файла
$cacheKey = 'blog_articles_all';
$articles = getCache($cacheKey, 1800); // Кэш на 30 минут

if ($articles === false) {
    $blogFile = __DIR__ . '/data/blog.json';
    $articles = [];
    if (file_exists($blogFile)) {
        $articles = json_decode(file_get_contents($blogFile), true) ?: [];
    }
    
    // Сортируем по дате (новые сначала)
    usort($articles, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    
    // Сохраняем в кэш
    setCache($cacheKey, $articles);
}

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
    $months = [
        '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
        '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
        '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
    ];
    $parts = explode('-', $date);
    return (int)$parts[2] . ' ' . $months[$parts[1]] . ' ' . $parts[0];
}
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">Блог</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Полезные статьи о SEO, разработке, маркетинге и digital-продвижении
            </p>
        </div>
    </div>
</section>

<!-- Статьи -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <?php if (empty($articles)): ?>
            <div class="text-center py-20">
                <p class="text-xl text-gray-400">Статьи пока не добавлены</p>
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
                            <a href="/blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="hover:text-neon-blue transition-colors">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </a>
                        </h2>
                        <p class="text-gray-400 mb-6 leading-relaxed">
                            <?php echo htmlspecialchars($article['excerpt']); ?>
                        </p>
                        <a href="/blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" class="text-neon-purple hover:text-neon-blue transition-colors font-semibold">
                            Читать далее →
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
                                Назад
                            </a>
                        <?php else: ?>
                            <span class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-500 cursor-not-allowed">Назад</span>
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
                                Вперед →
                            </a>
                        <?php else: ?>
                            <span class="px-4 py-2 bg-dark-surface border border-dark-border rounded-lg text-gray-500 cursor-not-allowed">Вперед →</span>
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

<?php include 'includes/footer.php'; ?>

