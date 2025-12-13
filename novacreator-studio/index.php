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
                <a href="#contact-form" onclick="const el = document.getElementById('contact-form'); if(el) { el.scrollIntoView({behavior: 'smooth'}); return false; }" class="hero-cta-btn w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation hover:scale-105 hover:shadow-xl" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; border: none; text-decoration: none; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);">
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

<!-- Форма в стиле holymedia.kz -->
<section id="contact-form" class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Заголовок -->
            <div class="mb-12 md:mb-16 reveal">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-black leading-[0.85] tracking-tighter" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'So, shall we work?' : 'Ну что, работаем?'; ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <!-- Контактная информация слева -->
                <div class="reveal">
                    <!-- Телефон -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Our phone' : 'Наш телефон'; ?>
                        </h3>
                        <a href="tel:+77066063921" class="text-xl sm:text-2xl md:text-3xl font-bold transition-colors hover:opacity-80" style="color: var(--color-text);">
                            +7 706 606 39 21
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Email' : 'Email'; ?>
                        </h3>
                        <a href="mailto:contact@novacreatorstudio.com" class="text-xl sm:text-2xl md:text-3xl font-bold transition-colors hover:opacity-80 break-all" style="color: var(--color-text);">
                            contact@novacreatorstudio.com
                        </a>
                    </div>

                    <!-- Мессенджеры -->
                    <div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'You can write!' : 'Написать — можно!'; ?>
                        </h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://wa.me/77066063921" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-lg sm:text-xl font-semibold transition-colors hover:opacity-80" style="color: var(--color-text);">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                WhatsApp
                            </a>
                            <a href="https://t.me/novacreatorstudio" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-lg sm:text-xl font-semibold transition-colors hover:opacity-80" style="color: var(--color-text);">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.12l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                                <?php echo $currentLang === 'en' ? 'Telegram' : 'Телеграм'; ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Форма справа -->
                <div class="reveal">
                    <div class="p-6 md:p-8 lg:p-10 rounded-2xl transition-all duration-300 hover:shadow-xl" style="background-color: var(--color-bg); border: 2px solid var(--color-border); box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-8" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Leave a request' : 'Оставить заявку'; ?>
                        </h3>

                        <form class="contact-form space-y-4 md:space-y-6" method="POST" action="/backend/send.php" id="contactFormMain">
                            <input type="hidden" name="type" value="contact">
                            <input type="hidden" name="form_name" value="<?php echo $currentLang === 'en' ? 'Contact Form' : 'Форма обратной связи'; ?>">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">

                            <!-- Имя -->
                            <div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="contact-name"
                                    placeholder="<?php echo $currentLang === 'en' ? 'Ali' : 'Али'; ?>"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-1 focus:ring-black text-base md:text-lg" 
                                    style="background-color: white; border-color: #000000; border-width: 1px; color: #000000;"
                                    required
                                    autocomplete="name"
                                >
                                <p class="text-sm mt-1 hidden text-red-500" id="name-error"></p>
                            </div>

                            <!-- Телефон с выбором страны -->
                            <div>
                                <div class="flex gap-2">
                                    <select 
                                        id="phone-country-code"
                                        name="country_code"
                                        class="px-3 py-3 pr-10 border rounded-lg focus:outline-none focus:ring-1 focus:ring-black text-base md:text-lg cursor-pointer appearance-none" 
                                        style="background-color: white; border-color: #000000; border-width: 1px; color: #000000; min-width: 100px; background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22%3E%3Cpath fill=%22%23000%22 d=%22M6 9L1 4h10z%22/%3E%3C/svg%3E'); background-position: right 0.75rem center; background-repeat: no-repeat; background-size: 12px 12px;"
                                    >
                                        <option value="+7" data-flag="🇰🇿">🇰🇿 +7</option>
                                        <option value="+7" data-flag="🇷🇺">🇷🇺 +7</option>
                                        <option value="+1" data-flag="🇺🇸">🇺🇸 +1</option>
                                        <option value="+380" data-flag="🇺🇦">🇺🇦 +380</option>
                                        <option value="+375" data-flag="🇧🇾">🇧🇾 +375</option>
                                        <option value="+998" data-flag="🇺🇿">🇺🇿 +998</option>
                                        <option value="+996" data-flag="🇰🇬">🇰🇬 +996</option>
                                        <option value="+44" data-flag="🇬🇧">🇬🇧 +44</option>
                                        <option value="+49" data-flag="🇩🇪">🇩🇪 +49</option>
                                        <option value="+33" data-flag="🇫🇷">🇫🇷 +33</option>
                                        <option value="+86" data-flag="🇨🇳">🇨🇳 +86</option>
                                        <option value="+90" data-flag="🇹🇷">🇹🇷 +90</option>
                                        <option value="+971" data-flag="🇦🇪">🇦🇪 +971</option>
                                        <option value="+81" data-flag="🇯🇵">🇯🇵 +81</option>
                                        <option value="+82" data-flag="🇰🇷">🇰🇷 +82</option>
                                        <option value="+91" data-flag="🇮🇳">🇮🇳 +91</option>
                                    </select>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        id="contact-phone"
                                        placeholder="(000) 000-00-00"
                                    class="flex-1 px-4 py-3 border rounded-lg focus:outline-none focus:ring-1 focus:ring-black text-base md:text-lg" 
                                    style="background-color: white; border-color: #000000; border-width: 1px; color: #000000;"
                                        required
                                        autocomplete="tel"
                                        inputmode="tel"
                                    >
                                </div>
                                <input type="hidden" name="phone_full" id="phone-full-value">
                                <p class="text-sm mt-1 hidden text-red-500" id="phone-error-main"></p>
                            </div>

                            <!-- Радио-кнопки -->
                            <div class="flex flex-col gap-3 py-2">
                                <label class="contact-method-option flex items-center gap-3 cursor-pointer" 
                                       data-value="messenger" 
                                       id="label-messenger">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="messenger" 
                                        id="contact-messenger"
                                        checked
                                        class="w-5 h-5 cursor-pointer"
                                        style="accent-color: #000000;"
                                    >
                                    <span class="text-base md:text-lg font-medium" style="color: #000000;">
                                        <?php echo $currentLang === 'en' ? 'Write in messenger' : 'Написать в мессенджер'; ?>
                                    </span>
                                </label>
                                <label class="contact-method-option flex items-center gap-3 cursor-pointer" 
                                       data-value="call"
                                       id="label-call">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="call"
                                        id="contact-call"
                                        class="w-5 h-5 cursor-pointer"
                                        style="accent-color: #000000;"
                                    >
                                    <span class="text-base md:text-lg font-medium" style="color: #000000;">
                                        <?php echo $currentLang === 'en' ? 'Call' : 'Позвонить'; ?>
                                    </span>
                                </label>
                            </div>

                            <!-- Кнопка отправки -->
                            <button 
                                type="submit" 
                                class="w-full px-6 py-4 text-base md:text-lg font-semibold rounded-lg transition-all duration-200 hover:opacity-90 min-h-[48px] md:min-h-[56px]"
                                style="background-color: #FF6B6B; color: white; border: none;"
                            >
                                <?php echo $currentLang === 'en' ? 'Send' : 'Отправить'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('contact-name');
    const phoneInput = document.getElementById('contact-phone');
    const nameError = document.getElementById('name-error');
    const phoneError = document.getElementById('phone-error-main');
    const form = document.getElementById('contactFormMain');
    const countryCodeSelect = document.getElementById('phone-country-code');
    const phoneFullValue = document.getElementById('phone-full-value');
    
    // Обработчики изменения способа связи (упрощенная версия без визуальных изменений)
    const methodInputs = form.querySelectorAll('input[name="contact_method"]');
    methodInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Просто логируем выбор, стили применяются через CSS accent-color
        });
    });
    
    function validatePhone(phone, countryCode) {
        // Удаляем все нецифровые символы кроме плюса
        const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');
        // Убираем код страны для проверки только номера
        const codeWithoutPlus = countryCode.replace('+', '');
        const numberOnly = cleanPhone.startsWith(codeWithoutPlus) 
            ? cleanPhone.substring(codeWithoutPlus.length) 
            : cleanPhone;
        
        // Минимум 7 цифр для международного номера, максимум 15
        return /^\d{7,15}$/.test(numberOnly);
    }
    
    function formatPhoneByCountry(value, countryCode) {
        // Удаляем все нецифровые символы
        let cleaned = value.replace(/[^\d]/g, '');
        
        // Убираем код страны если он уже есть, но только если после него есть еще цифры
        // Это предотвращает удаление первой цифры "7" при вводе номера для +7
        const codeDigits = countryCode.replace('+', '');
        if (cleaned.startsWith(codeDigits) && cleaned.length > codeDigits.length) {
            cleaned = cleaned.substring(codeDigits.length);
        }
        
        // Форматирование зависит от кода страны
        if (countryCode === '+7' || countryCode === '+1') {
            // Для +7 и +1: форматируем как (XXX) XXX-XXXX
            if (cleaned.length > 0) {
                let formatted = '(' + cleaned.substring(0, 3);
                if (cleaned.length > 3) {
                    formatted += ') ' + cleaned.substring(3, 6);
                }
                if (cleaned.length > 6) {
                    formatted += '-' + cleaned.substring(6, 10);
                }
                return formatted;
            }
        } else if (countryCode === '+380' || countryCode === '+375') {
            // Для Украины и Беларуси: XXX XX XX
            if (cleaned.length > 0) {
                let formatted = cleaned.substring(0, 3);
                if (cleaned.length > 3) {
                    formatted += ' ' + cleaned.substring(3, 5);
                }
                if (cleaned.length > 5) {
                    formatted += ' ' + cleaned.substring(5, 7);
                }
                if (cleaned.length > 7) {
                    formatted += ' ' + cleaned.substring(7, 9);
                }
                return formatted;
            }
        }
        
        // Для остальных стран: просто цифры с пробелами каждые 3
        return cleaned.replace(/(\d{3})(?=\d)/g, '$1 ');
    }
    
    // Валидация имени
    if (nameInput) {
        nameInput.addEventListener('blur', function() {
            const name = nameInput.value.trim();
            if (!name || name.length < 2) {
                nameInput.style.borderColor = '#ef4444';
                if (nameError) {
                    nameError.textContent = '<?php echo $currentLang === 'en' ? 'Enter your name' : 'Введите имя'; ?>';
                    nameError.classList.remove('hidden');
                }
            } else {
                nameInput.style.borderColor = '';
                if (nameError) {
                    nameError.classList.add('hidden');
                }
            }
        });
    }
    
    // Функция обновления полного значения телефона
    function updatePhoneValue() {
        if (countryCodeSelect && phoneInput && phoneFullValue) {
            const countryCode = countryCodeSelect.value;
            const phoneNumber = phoneInput.value.trim().replace(/[\s\-\(\)]/g, '');
            if (phoneNumber) {
                phoneFullValue.value = countryCode + phoneNumber;
            } else {
                phoneFullValue.value = '';
            }
        }
    }
    
    if (countryCodeSelect) {
        countryCodeSelect.addEventListener('change', function() {
            const countryCode = this.value;
            const currentValue = phoneInput.value.replace(/[\s\-\(\)]/g, '');
            phoneInput.value = formatPhoneByCountry(currentValue, countryCode);
            updatePhoneValue();
            // Валидация при смене страны
            if (phoneInput.value) {
                phoneInput.dispatchEvent(new Event('input'));
            }
        });
    }
    
    // Форматирование и валидация телефона
    if (phoneInput && countryCodeSelect) {
        phoneInput.addEventListener('input', function(e) {
            const countryCode = countryCodeSelect.value;
            const currentValue = e.target.value.replace(/[\s\-\(\)]/g, '');
            e.target.value = formatPhoneByCountry(currentValue, countryCode);
            updatePhoneValue();
            
            const phone = e.target.value.trim();
            if (phone && !validatePhone(phone, countryCode)) {
                phoneInput.style.borderColor = '#ef4444';
                if (phoneError) {
                    phoneError.textContent = '<?php echo $currentLang === 'en' ? 'Enter a valid phone number' : 'Введите корректный номер телефона'; ?>';
                    phoneError.classList.remove('hidden');
                }
            } else {
                phoneInput.style.borderColor = '';
                if (phoneError) {
                    phoneError.classList.add('hidden');
                }
            }
        });
        
        phoneInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const countryCode = countryCodeSelect.value;
            const cleaned = pastedText.replace(/[^\d+]/g, '');
            // Если вставляется номер с кодом страны, пытаемся его определить
            if (cleaned.startsWith('+')) {
                // Убираем + и код страны
                const codeDigits = countryCode.replace('+', '');
                if (cleaned.startsWith('+' + codeDigits)) {
                    const numberOnly = cleaned.substring(1 + codeDigits.length);
                    phoneInput.value = formatPhoneByCountry(numberOnly, countryCode);
                } else {
                    phoneInput.value = formatPhoneByCountry(cleaned.substring(1), countryCode);
                }
            } else {
                phoneInput.value = formatPhoneByCountry(cleaned, countryCode);
            }
            updatePhoneValue();
            phoneInput.dispatchEvent(new Event('input'));
        });
    }

    // Обработка отправки формы
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const name = nameInput ? nameInput.value.trim() : '';
            const phone = phoneInput ? phoneInput.value.trim() : '';
            let isValid = true;
            
            // Валидация имени
            if (!name || name.length < 2) {
                isValid = false;
                if (nameInput) {
                    nameInput.style.borderColor = '#ef4444';
                    nameInput.focus();
                }
                if (nameError) {
                    nameError.textContent = '<?php echo $currentLang === 'en' ? 'Enter your name' : 'Введите имя'; ?>';
                    nameError.classList.remove('hidden');
                }
            }
            
            // Валидация телефона
            const countryCode = countryCodeSelect ? countryCodeSelect.value : '+7';
            updatePhoneValue();
            const phoneFull = phoneFullValue ? phoneFullValue.value : '';
            
            if (!phone || !validatePhone(phone, countryCode)) {
                isValid = false;
                if (phoneInput) {
                    phoneInput.style.borderColor = '#ef4444';
                    if (!name || name.length >= 2) {
                        phoneInput.focus();
                    }
                }
                if (phoneError) {
                    phoneError.textContent = '<?php echo $currentLang === 'en' ? 'Enter a valid phone number' : 'Введите корректный номер телефона'; ?>';
                    phoneError.classList.remove('hidden');
                }
            }
            
            if (!isValid) {
                return false;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';

            // Формируем данные формы с полным номером телефона
            const formData = new FormData();
            formData.append('type', form.querySelector('input[name="type"]').value);
            formData.append('form_name', form.querySelector('input[name="form_name"]').value);
            formData.append('name', nameInput.value.trim());
            formData.append('phone', phoneFull || (countryCode + phone.replace(/[\s\-\(\)]/g, '')));
            formData.append('website', form.querySelector('input[name="website"]').value);
            
            // Добавляем метод связи в сообщение - показываем явно выбранный способ
            const contactMethod = form.querySelector('input[name="contact_method"]:checked')?.value;
            let methodText = '';
            if (contactMethod === 'messenger') {
                methodText = '<?php echo $currentLang === 'en' ? 'Preferred contact method: Write in messenger' : 'Предпочтительный способ связи: Написать в мессенджер'; ?>';
            } else if (contactMethod === 'call') {
                methodText = '<?php echo $currentLang === 'en' ? 'Preferred contact method: Call' : 'Предпочтительный способ связи: Позвонить'; ?>';
            }
            formData.append('message', methodText);

            try {
                const response = await fetch('/backend/send.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    // Улучшенное сообщение об успехе
                    const successMsg = data.message || '<?php echo $currentLang === 'en' ? 'Request sent successfully! We will contact you soon.' : 'Заявка отправлена успешно! Мы свяжемся с вами в ближайшее время.'; ?>';
                    alert(successMsg);
                    form.reset();
                    // Сбрасываем радио-кнопку на значение по умолчанию
                    const defaultRadio = form.querySelector('input[name="contact_method"][value="messenger"]');
                    if (defaultRadio) defaultRadio.checked = true;
                    // Обновляем отображение выбранного способа
                    // Очищаем ошибки
                    if (nameError) nameError.classList.add('hidden');
                    if (phoneError) phoneError.classList.add('hidden');
                    nameInput.style.borderColor = '';
                    phoneInput.style.borderColor = '';
                } else {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Error sending request. Please try again.' : 'Ошибка отправки заявки. Попробуйте еще раз.'; ?>');
                }
            } catch (error) {
                console.error('Form submission error:', error);
                alert('<?php echo $currentLang === 'en' ? 'Error sending request. Please try again later.' : 'Ошибка отправки заявки. Попробуйте позже.'; ?>');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
