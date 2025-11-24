<?php
/**
 * Breadcrumbs (хлебные крошки) для SEO
 * Показывает навигационный путь по сайту
 */

// Определяем текущую страницу
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Словарь с названиями и человекочитаемыми URL
$pageMap = [
    'services' => ['name' => 'Услуги', 'url' => '/services'],
    'seo' => ['name' => 'SEO-оптимизация', 'url' => '/seo'],
    'ads' => ['name' => 'Google Ads', 'url' => '/ads'],
    'portfolio' => ['name' => 'Портфолио', 'url' => '/portfolio'],
    'about' => ['name' => 'О нас', 'url' => '/about'],
    'contact' => ['name' => 'Контакты', 'url' => '/contact'],
    'vacancies' => ['name' => 'Вакансии', 'url' => '/vacancies'],
    'calculator' => ['name' => 'Калькулятор', 'url' => '/calculator'],
    'blog' => ['name' => 'Блог', 'url' => '/blog']
];

// Формируем breadcrumbs
$breadcrumbs = [
    ['name' => 'Главная', 'url' => '/']
];

if (!empty($pageBreadcrumbs) && is_array($pageBreadcrumbs)) {
    $breadcrumbs = $pageBreadcrumbs;
} elseif ($currentPage !== 'index' && isset($pageMap[$currentPage])) {
    $breadcrumbs[] = $pageMap[$currentPage];
}
?>

<!-- Breadcrumbs для SEO -->
<nav aria-label="Хлебные крошки" class="container mx-auto px-4 md:px-6 lg:px-8 pt-24 pb-4">
    <ol class="flex items-center space-x-2 text-sm text-gray-400" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($breadcrumbs as $index => $crumb): ?>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex items-center">
                <?php if ($index < count($breadcrumbs) - 1): ?>
                    <a href="<?php echo htmlspecialchars($crumb['url']); ?>" itemprop="item" class="hover:text-neon-purple transition-colors">
                        <span itemprop="name"><?php echo htmlspecialchars($crumb['name']); ?></span>
                    </a>
                    <meta itemprop="position" content="<?php echo $index + 1; ?>">
                    <svg class="w-4 h-4 mx-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                <?php else: ?>
                    <span itemprop="name" class="text-gray-300" aria-current="page"><?php echo htmlspecialchars($crumb['name']); ?></span>
                    <meta itemprop="position" content="<?php echo $index + 1; ?>">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>

