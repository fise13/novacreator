<?php
/**
 * Страница портфолио
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.portfolio.breadcrumb');
$pageMetaTitle = t('seo.pages.portfolio.title');
$pageMetaDescription = t('seo.pages.portfolio.description');
$pageMetaKeywords = t('seo.pages.portfolio.keywords');
include 'includes/header.php';

// Фиксированный набор проектов (без JSON), чтобы структура была простой и прозрачной.
$projects = [
    [
        'id' => 1,
        'title' => 'Motor-Land.kz',
        'title_en' => 'Motor-Land.kz',
        'category' => 'ecommerce',
        'service_type' => 'development',
        'city' => 'Казахстан',
        'city_en' => 'Kazakhstan',
        'description' => 'Коммерческий web-проект по продаже контрактных двигателей и автозапчастей: понятная структура каталога, доверительные блоки и удобная форма заявки.',
        'description_en' => 'A commercial web project for contract engines and auto parts sales: clear catalog structure, trust-focused sections, and a streamlined lead form.',
        'results' => [
            'traffic_increase' => 'Улучшена видимость ключевых посадочных страниц',
            'conversion_increase' => 'Сделан более прямой путь пользователя до заявки',
            'leads_increase' => 'Стабильный поток обращений через формы'
        ],
        'duration' => 'Итерационная разработка',
        'duration_en' => 'Iterative development',
        'project_url' => 'https://motor-land.kz',
        'project_url_label' => 'Открыть сайт',
        'project_url_label_en' => 'Open Website',
        'repo_url' => '',
        'repo_url_label' => '',
        'repo_url_label_en' => '',
        'testimonial' => [
            'text' => 'Сильный проект с точки зрения структуры и конверсии: пользователю проще понять предложение и оставить заявку.',
            'text_en' => 'A strong project in terms of structure and conversion: users can understand the offer faster and submit a lead more easily.',
            'author' => 'Команда проекта',
            'author_en' => 'Project Team',
            'position' => 'Motor-Land.kz',
            'position_en' => 'Motor-Land.kz'
        ]
    ],
    [
        'id' => 2,
        'title' => 'AutoCore (iOS + macOS)',
        'title_en' => 'AutoCore (iOS + macOS)',
        'category' => 'b2b',
        'service_type' => 'development',
        'city' => 'Казахстан',
        'city_en' => 'Kazakhstan',
        'description' => 'Нативный продукт для iOS и macOS: рабочие сценарии, авторизация, синхронизация данных и масштабируемая архитектура приложения.',
        'description_en' => 'A native product for iOS and macOS: operational workflows, authentication, data sync, and scalable app architecture.',
        'results' => [
            'platform_coverage' => 'Единый продукт на iOS и macOS',
            'sync_stability' => 'Надежная синхронизация рабочих данных',
            'architecture' => 'Масштабируемая архитектура под новые модули'
        ],
        'duration' => 'Продуктовая разработка',
        'duration_en' => 'Product development',
        'project_url' => '',
        'project_url_label' => '',
        'project_url_label_en' => '',
        'repo_url' => 'https://github.com',
        'repo_url_label' => 'Смотреть код (GitHub)',
        'repo_url_label_en' => 'View Code (GitHub)',
        'testimonial' => [
            'text' => 'AutoCore стал единым рабочим инструментом для мобильной и десктопной среды.',
            'text_en' => 'AutoCore became a unified operational tool across mobile and desktop environments.',
            'author' => 'Внутренняя команда',
            'author_en' => 'Internal Team',
            'position' => 'AutoCore',
            'position_en' => 'AutoCore'
        ]
    ]
];

function getProjectField($project, $field, $lang) {
    if ($lang === 'en' && isset($project[$field . '_en']) && !empty($project[$field . '_en'])) {
        return $project[$field . '_en'];
    }
    return $project[$field] ?? '';
}

// Фильтрация по типу услуги
$serviceFilter = $_GET['service'] ?? 'all';
if ($serviceFilter !== 'all' && in_array($serviceFilter, ['seo', 'development', 'ads'])) {
    $projects = array_filter($projects, function($project) use ($serviceFilter) {
        return isset($project['service_type']) && $project['service_type'] === $serviceFilter;
    });
}

// Переиндексируем массив после фильтрации
$projects = array_values($projects);
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.portfolio.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Фильтры -->
<section class="reveal-group py-8 md:py-12" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-wrap items-center gap-4 md:gap-6 mb-8 reveal">
                <span class="text-lg font-semibold" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Filter by:' : 'Фильтр по:'; ?>
                </span>
                
                <!-- Фильтр по типу услуги -->
                <div class="flex flex-wrap gap-2">
                    <a href="?service=all" 
                       class="portfolio-filter px-4 py-2 text-base transition-all <?php echo $serviceFilter === 'all' ? 'active' : ''; ?>" 
                       style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'All' : 'Все'; ?>
                    </a>
                    <a href="?service=development" 
                       class="portfolio-filter px-4 py-2 text-base transition-all <?php echo $serviceFilter === 'development' ? 'active' : ''; ?>" 
                       style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Development' : 'Разработка'; ?>
                    </a>
                    <a href="?service=seo" 
                       class="portfolio-filter px-4 py-2 text-base transition-all <?php echo $serviceFilter === 'seo' ? 'active' : ''; ?>" 
                       style="color: var(--color-text);">
                        SEO
                    </a>
                    <a href="?service=ads" 
                       class="portfolio-filter px-4 py-2 text-base transition-all <?php echo $serviceFilter === 'ads' ? 'active' : ''; ?>" 
                       style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Ads' : 'Реклама'; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Проекты -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <?php if (empty($projects)): ?>
                <div class="text-center py-20 reveal">
                    <p class="text-xl md:text-2xl mb-4" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'No projects found' : 'Проекты не найдены'; ?>
                    </p>
                    <?php if ($serviceFilter !== 'all'): ?>
                        <p class="text-base mt-4 mb-4" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' 
                                ? 'Try changing filters or view all projects' 
                                : 'Попробуйте изменить фильтры или посмотреть все проекты'; ?>
                        </p>
                        <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" 
                           class="inline-block px-6 py-3 border rounded-lg transition-colors hover:opacity-70" 
                           style="border-color: var(--color-border); color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Show all projects' : 'Показать все проекты'; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div id="portfolioProjects" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
                    <?php foreach ($projects as $index => $project): ?>
                        <?php
                        // Проверяем, что проект валидный
                        if (empty($project) || !isset($project['title'])) {
                            continue;
                        }
                        
                        $title = getProjectField($project, 'title', $currentLang);
                        $description = getProjectField($project, 'description', $currentLang);
                        $city = getProjectField($project, 'city', $currentLang);
                        $category = $project['category'] ?? 'general';
                        $serviceType = $project['service_type'] ?? 'development';
                        $results = $project['results'] ?? [];
                        $price = !empty($project['price']) ? number_format((int)$project['price'], 0, ',', ' ') . ' ₸' : '';
                        $duration = getProjectField($project, 'duration', $currentLang);
                        $testimonial = $project['testimonial'] ?? null;
                        $projectUrl = trim((string)($project['project_url'] ?? ''));
                        $repoUrl = trim((string)($project['repo_url'] ?? ''));
                        $projectUrlLabel = getProjectField($project, 'project_url_label', $currentLang);
                        $repoUrlLabel = getProjectField($project, 'repo_url_label', $currentLang);
                        ?>
                        <article class="portfolio-item reveal group relative overflow-hidden rounded-2xl transition-all duration-500 hover:scale-[1.02]" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                            <!-- Изображение проекта -->
                            <div class="relative h-64 overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 flex items-center justify-center">
                                    <span class="text-6xl opacity-50"><?php 
                                        $icons = [
                                            'restaurant' => '☕',
                                            'fitness' => '💪',
                                            'ecommerce' => '🛍️',
                                            'tourism' => '🏨',
                                            'medical' => '🦷',
                                            'education' => '📚',
                                            'b2b' => '💼',
                                            'beauty' => '💅'
                                        ];
                                        echo $icons[$category] ?? '📁';
                                    ?></span>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                                    <div class="text-white">
                                        <div class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($title); ?></div>
                                        <div class="text-sm opacity-90"><?php echo htmlspecialchars($city); ?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Контент -->
                            <div class="p-6">
                                <div class="mb-4">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-2" style="background-color: var(--color-bg-lighter); color: var(--color-text-secondary);">
                                        <?php 
                                        $serviceLabels = [
                                            'development' => $currentLang === 'en' ? 'Development' : 'Разработка',
                                            'seo' => 'SEO',
                                            'ads' => $currentLang === 'en' ? 'Ads' : 'Реклама'
                                        ];
                                        echo $serviceLabels[$serviceType] ?? $serviceType;
                                        ?>
                                    </span>
                                </div>
                                
                                <h3 class="text-2xl font-bold mb-3" style="color: var(--color-text);">
                                    <?php echo htmlspecialchars($title); ?>
                                </h3>
                                
                                <p class="text-base mb-4 leading-relaxed" style="color: var(--color-text-secondary);">
                                    <?php echo htmlspecialchars($description); ?>
                                </p>
                                
                                <!-- Результаты -->
                                <?php if (!empty($results)): ?>
                                    <div class="mb-4 space-y-2">
                                        <?php 
                                        $resultLabels = [
                                            'traffic_increase' => $currentLang === 'en' ? 'Traffic' : 'Трафик',
                                            'conversion_increase' => $currentLang === 'en' ? 'Conversion' : 'Конверсия',
                                            'orders_online' => $currentLang === 'en' ? 'Orders' : 'Заказы',
                                            'leads_increase' => $currentLang === 'en' ? 'Leads' : 'Заявки',
                                            'calls_increase' => $currentLang === 'en' ? 'Calls' : 'Звонки',
                                            'revenue_increase' => $currentLang === 'en' ? 'Revenue' : 'Выручка',
                                            'positions_top10' => $currentLang === 'en' ? 'Top-10 positions' : 'Позиций в топ-10',
                                            'cpc_reduction' => $currentLang === 'en' ? 'CPC reduction' : 'Снижение CPC',
                                            'roi' => 'ROI',
                                            'time_to_load' => $currentLang === 'en' ? 'Load time' : 'Время загрузки',
                                            'bookings_online' => $currentLang === 'en' ? 'Bookings' : 'Бронирования',
                                            'appointments_online' => $currentLang === 'en' ? 'Appointments' : 'Записи',
                                            'new_patients' => $currentLang === 'en' ? 'New patients' : 'Новых пациентов',
                                            'students_registered' => $currentLang === 'en' ? 'Students' : 'Студентов',
                                            'courses_sold' => $currentLang === 'en' ? 'Courses sold' : 'Курсов продано',
                                            'platform_coverage' => $currentLang === 'en' ? 'Platform coverage' : 'Покрытие платформ',
                                            'sync_stability' => $currentLang === 'en' ? 'Sync stability' : 'Стабильность синхронизации',
                                            'native_ux' => $currentLang === 'en' ? 'Native UX' : 'Нативный UX',
                                            'architecture' => $currentLang === 'en' ? 'Architecture' : 'Архитектура'
                                        ];
                                        $displayedResults = array_slice($results, 0, 2);
                                        foreach ($displayedResults as $key => $value): 
                                        ?>
                                            <div class="flex justify-between text-sm">
                                                <span style="color: var(--color-text-secondary);">
                                                    <?php echo $resultLabels[$key] ?? $key; ?>:
                                                </span>
                                                <span class="font-semibold" style="color: var(--color-text);">
                                                    <?php echo htmlspecialchars($value); ?>
                                                </span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Цена и сроки -->
                                <?php if ($price || $duration): ?>
                                <div class="flex justify-between items-center pt-4 border-t" style="border-color: var(--color-border);">
                                    <div>
                                        <?php if ($price): ?>
                                        <div class="text-lg font-bold" style="color: var(--color-text);"><?php echo $price; ?></div>
                                        <?php endif; ?>
                                        <?php if ($duration): ?>
                                        <div class="text-sm" style="color: var(--color-text-secondary);"><?php echo htmlspecialchars($duration); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <!-- Ссылки на проект -->
                                <?php if ($projectUrl || $repoUrl): ?>
                                    <div class="mt-4 pt-4 border-t flex flex-wrap gap-2" style="border-color: var(--color-border);">
                                        <?php if ($projectUrl): ?>
                                            <a href="<?php echo htmlspecialchars($projectUrl); ?>"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="portfolio-link-btn inline-flex items-center justify-center px-3 py-2 text-sm font-semibold rounded-lg transition-all"
                                               style="background-color: var(--color-text); color: var(--color-bg);">
                                                <?php echo htmlspecialchars($projectUrlLabel ?: ($currentLang === 'en' ? 'Open project' : 'Открыть проект')); ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($repoUrl): ?>
                                            <a href="<?php echo htmlspecialchars($repoUrl); ?>"
                                               target="_blank"
                                               rel="noopener noreferrer"
                                               class="portfolio-link-btn inline-flex items-center justify-center px-3 py-2 text-sm font-semibold rounded-lg transition-all"
                                               style="background-color: var(--color-bg-lighter); color: var(--color-text); border: 1px solid var(--color-border);">
                                                <?php echo htmlspecialchars($repoUrlLabel ?: 'GitHub'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Отзыв клиента -->
                                <?php if ($testimonial): ?>
                                    <div class="mt-4 pt-4 border-t" style="border-color: var(--color-border);">
                                        <p class="text-sm italic mb-2" style="color: var(--color-text-secondary);">
                                            "<?php echo htmlspecialchars(getProjectField($testimonial, 'text', $currentLang)); ?>"
                                        </p>
                                        <div class="text-xs" style="color: var(--color-text-secondary);">
                                            <span class="font-semibold"><?php echo htmlspecialchars(getProjectField($testimonial, 'author', $currentLang)); ?></span>,
                                            <?php echo htmlspecialchars(getProjectField($testimonial, 'position', $currentLang)); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="text-xl md:text-2xl mb-8 reveal" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="reveal inline-block px-10 py-5 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.button')); ?>
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Плавное появление карточек при скролле
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.portfolio-item').forEach(item => {
        observer.observe(item);
    });
});
</script>

<?php include 'includes/footer.php'; ?>

