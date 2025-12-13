<?php
/**
 * Главная страница NovaCreator Studio
 * Создана по образцу holymedia.kz с улучшенной структурой и анимациями
 */

// Подключаем локализацию
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('seo.pages.index.breadcrumb');
$pageMetaTitle = t('seo.pages.index.title');
$pageMetaDescription = t('seo.pages.index.description');
$pageMetaKeywords = t('seo.pages.index.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - крупный заголовок, подзаголовок и CTA -->
<section class="parallax-hero reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Parallax background elements -->
    <div class="parallax-bg absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-br from-neon-purple/30 to-neon-blue/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-br from-neon-blue/30 to-neon-purple/30 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="parallax-content max-w-7xl mx-auto text-center">
            <!-- Главный заголовок -->
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php 
                static $headlinesData = null;
                if ($headlinesData === null) {
                    $langFile = __DIR__ . '/lang/' . $currentLang . '.json';
                    if (file_exists($langFile)) {
                        $headlinesData = json_decode(file_get_contents($langFile), true);
                    } else {
                        $headlinesData = [];
                    }
                }
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => 'Your growth is our goal', 'subtitle' => ''];
                echo htmlspecialchars($currentLang === 'en' ? 'Your growth is our goal' : $randomHeadline['title']); 
                ?>
            </h1>
            
            <!-- Подзаголовок -->
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php 
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : ($currentLang === 'en' ? 'Digital agency specializing in SEO, web development, and marketing strategies' : 'Цифровое агентство');
                echo htmlspecialchars($randomDescription); 
                ?>
            </p>
            
            <!-- CTA кнопки -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 md:gap-6 reveal px-4 sm:px-0">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="hero-cta-btn w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation hover:scale-105 hover:shadow-xl" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; border: none; text-decoration: none; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);">
                    <?php echo htmlspecialchars(t('common.getStarted')); ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="hero-portfolio-btn w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation hover:scale-105" style="border: 1px solid rgba(99, 102, 241, 0.3); color: var(--color-text); background-color: transparent; text-decoration: none;">
                    <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Индикатор прокрутки -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center backdrop-blur-sm hover:scale-110 transition-transform cursor-pointer" style="border-color: var(--color-border); background-color: rgba(255, 255, 255, 0.05);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text-secondary);">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<!-- Статистика - Apple минимализм -->
<section class="reveal-group py-12 md:py-20 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <div class="absolute top-0 left-0 right-0 h-24 md:h-48 pointer-events-none" style="background: linear-gradient(to bottom, var(--color-bg), var(--color-bg-lighter));"></div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <div class="text-center reveal">
                    <div class="text-8xl sm:text-9xl md:text-[10rem] lg:text-[12rem] xl:text-[14rem] font-semibold mb-4 md:mb-6 leading-none tracking-tighter" style="color: var(--color-text);">
                        <span class="counter-number inline-block" data-target="100" data-suffix="%">0</span>
                    </div>
                    <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-light" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'online projects' : 'онлайн проектов'; ?>
                    </p>
                </div>
                
                <div class="text-center reveal">
                    <div class="text-8xl sm:text-9xl md:text-[10rem] lg:text-[12rem] xl:text-[14rem] font-semibold mb-4 md:mb-6 leading-none tracking-tighter" style="color: var(--color-text);">
                        <span class="counter-number inline-block" data-target="10" data-suffix="+">0</span>
                    </div>
                    <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-light" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' ? 'years in digital' : 'лет в digital сфере'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Услуги - карточки в стиле holymedia.kz -->
<section id="services" class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.services.title')); ?>
                </h2>
            </div>
            
            <!-- Карточки услуг - стиль holymedia.kz -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
                <!-- SEO -->
                <div class="group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 mb-6 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.seo.title')); ?>
                    </h3>
                    <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? htmlspecialchars(t('home.services.seo.description')) 
                            : 'Выводим ваш сайт в топ поисковых систем с использованием новаторских методов продвижения. Комплексная оптимизация, технический аудит и постоянный мониторинг результатов.'; ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 hover:opacity-70 hover:translate-x-1 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 mb-6 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.development.title')); ?>
                    </h3>
                    <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 hover:opacity-70 hover:translate-x-1 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Google Ads -->
                <div class="group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 mb-6 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.ads.title')); ?>
                    </h3>
                    <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? htmlspecialchars(t('home.services.ads.description')) 
                            : 'Контекстная реклама и поисковая интернет реклама под ключ. Настройка, запуск и оптимизация кампаний для максимальной конверсии и ROI.'; ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 hover:opacity-70 hover:translate-x-1 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
                        <span><?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?></span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Секция кейсов/портфолио - интерактивные визуальные блоки -->
<section id="portfolio" class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Our Work' : 'Наши работы'; ?>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl max-w-3xl" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'Real projects with real results' : 'Реальные проекты с измеримыми результатами'; ?>
                </p>
            </div>
            
            <!-- Кейсы - интерактивные блоки -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 lg:gap-16">
                <?php
                // Берем первые 4 проекта из портфолио
                $langFile = __DIR__ . '/lang/' . $currentLang . '.json';
                $projectsData = [];
                if (file_exists($langFile)) {
                    $data = json_decode(file_get_contents($langFile), true);
                    $projectsData = $data['portfolio']['projects'] ?? [];
                }
                
                // Если нет данных в JSON, используем статичные данные
                if (empty($projectsData)) {
                    $projectsData = [
                        [
                            'id' => 'northern-beans',
                            'title' => $currentLang === 'en' ? 'Coffee shop "Northern Beans"' : 'Кофейня "Northern Beans"',
                            'tag' => $currentLang === 'en' ? 'Website' : 'Сайт',
                            'summary' => $currentLang === 'en' ? 'One-page website for a local coffee shop' : 'Одностраничный сайт для локальной кофейни'
                        ],
                        [
                            'id' => 'bodycraft',
                            'title' => $currentLang === 'en' ? 'Personal trainer "BodyCraft"' : 'Персональный тренер "BodyCraft"',
                            'tag' => $currentLang === 'en' ? 'Landing' : 'Лендинг',
                            'summary' => $currentLang === 'en' ? 'Landing page for a personal trainer' : 'Лендинг для персонального тренера'
                        ],
                        [
                            'id' => 'urbanframe',
                            'title' => $currentLang === 'en' ? 'Construction company "UrbanFrame"' : 'Строительная компания "UrbanFrame"',
                            'tag' => $currentLang === 'en' ? 'Landing' : 'Лендинг',
                            'summary' => $currentLang === 'en' ? 'Landing page for a construction company' : 'Лендинг для строительной компании'
                        ],
                        [
                            'id' => 'technest',
                            'title' => $currentLang === 'en' ? 'Online store "TechNest"' : 'Интернет-магазин "TechNest"',
                            'tag' => $currentLang === 'en' ? 'E-commerce' : 'E-commerce',
                            'summary' => $currentLang === 'en' ? 'Online electronics store' : 'Интернет-магазин электроники'
                        ]
                    ];
                }
                
                $displayProjects = array_slice($projectsData, 0, 4);
                foreach ($displayProjects as $index => $project):
                ?>
                <div class="group relative reveal cursor-pointer touch-manipulation overflow-hidden rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg-lighter); border: 1px solid var(--color-border);">
                    <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio#' . ($project['id'] ?? 'project-' . $index)); ?>" class="block p-8 md:p-10">
                        <!-- Тег проекта -->
                        <div class="mb-4">
                            <span class="inline-block px-4 py-2 text-sm font-medium rounded-full" style="background-color: var(--color-bg); color: var(--color-text-secondary); border: 1px solid var(--color-border);">
                                <?php echo htmlspecialchars($project['tag'] ?? 'Project'); ?>
                            </span>
                        </div>
                        
                        <!-- Заголовок -->
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 leading-tight transition-colors duration-200 group-hover:opacity-80" style="color: var(--color-text);">
                            <?php echo htmlspecialchars($project['title'] ?? 'Project Title'); ?>
                        </h3>
                        
                        <!-- Описание -->
                        <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars($project['summary'] ?? 'Project description'); ?>
                        </p>
                        
                        <!-- Ссылка -->
                        <div class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 group-hover:translate-x-1" style="color: var(--color-text);">
                            <span><?php echo $currentLang === 'en' ? 'View case' : 'Смотреть кейс'; ?></span>
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Кнопка "Смотреть все работы" -->
            <div class="mt-12 md:mt-16 text-center reveal">
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="inline-flex items-center gap-2 px-8 py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 hover:scale-105 hover:shadow-xl min-h-[44px] touch-manipulation" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; border: none; text-decoration: none;">
                    <span><?php echo $currentLang === 'en' ? 'View all works' : 'Смотреть все работы'; ?></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Секция преимуществ - технологии, результаты, подход с иконками -->
<section id="advantages" class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-12 md:mb-16 lg:mb-20 reveal">
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'Why Choose Us' : 'Почему мы'; ?>
                </h2>
            </div>
            
            <!-- Преимущества с иконками -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12 lg:gap-16">
                <!-- Технологии -->
                <div class="group relative reveal p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <div class="w-14 h-14 mb-6 flex items-center justify-center rounded-full transition-all duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Modern Technologies' : 'Современные технологии'; ?>
                    </h3>
                    <p class="text-base sm:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? 'We use the latest tools and technologies to create fast, secure, and scalable solutions.' 
                            : 'Используем современные инструменты и технологии для создания быстрых, безопасных и масштабируемых решений.'; ?>
                    </p>
                </div>
                
                <!-- Результаты -->
                <div class="group relative reveal p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <div class="w-14 h-14 mb-6 flex items-center justify-center rounded-full transition-all duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Measurable Results' : 'Измеримые результаты'; ?>
                    </h3>
                    <p class="text-base sm:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? 'We track and analyze all metrics to ensure your business grows with concrete numbers.' 
                            : 'Отслеживаем и анализируем все метрики, чтобы ваш бизнес рос с конкретными цифрами.'; ?>
                    </p>
                </div>
                
                <!-- Подход -->
                <div class="group relative reveal p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl md:col-span-2 lg:col-span-1" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
                    <div class="w-14 h-14 mb-6 flex items-center justify-center rounded-full transition-all duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text); stroke-width: 1.5;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 leading-tight" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Individual Approach' : 'Индивидуальный подход'; ?>
                    </h3>
                    <p class="text-base sm:text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en' 
                            ? 'Each project is unique. We develop strategies tailored specifically to your business.' 
                            : 'Каждый проект уникален. Разрабатываем стратегии, адаптированные именно под ваш бизнес.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - для связи или начала проекта -->
<section class="reveal-group py-16 md:py-24 lg:py-40 relative overflow-hidden" style="background-color: var(--color-bg);">
    <!-- Фоновые элементы с градиентами -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full opacity-10" style="background: linear-gradient(135deg, var(--color-neon-purple), var(--color-neon-blue));"></div>
        <div class="absolute top-1/4 left-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.2" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 md:w-[32rem] md:h-[32rem] rounded-full blur-3xl opacity-20 animate-pulse parallax" data-speed="0.3" style="background: radial-gradient(circle, var(--color-neon-blue), transparent); animation-delay: 1s;"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.9] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="reveal px-4 sm:px-0">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-8 sm:px-10 md:px-12 py-4 sm:py-5 md:py-6 bg-black text-white text-sm sm:text-base md:text-lg lg:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[44px] sm:min-h-[48px] md:min-h-[52px] lg:min-h-[56px] shadow-2xl hover:shadow-3xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden touch-manipulation">
                    <span class="relative z-10"><?php echo htmlspecialchars(t('common.getConsultation')); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
