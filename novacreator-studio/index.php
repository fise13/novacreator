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
<section id="contact-form" class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Заголовок с изогнутой стрелкой -->
            <div class="mb-12 md:mb-16 relative">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extrabold leading-tight tracking-tighter" style="color: var(--color-text); position: relative; display: inline-block;">
                    <?php echo $currentLang === 'en' ? 'So, shall we work?' : 'Ну что, работаем?'; ?>
                    <svg class="absolute -top-4 -right-12 md:-right-20 w-16 h-16 md:w-24 md:h-24" style="color: var(--color-text);" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 50 Q 40 20, 70 30 T 90 50" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round"/>
                        <path d="M85 45 L 90 50 L 85 55" stroke="currentColor" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <!-- Контактная информация слева -->
                <div>
                    <!-- Телефон -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Our phone' : 'Наш телефон'; ?>
                        </h3>
                        <a href="tel:+77772738907" class="text-xl sm:text-2xl md:text-3xl font-bold transition-colors hover:opacity-80" style="color: #f97316;">
                            +7 777 273 89 07
                        </a>
                    </div>

                    <!-- Мессенджеры -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'You can write!' : 'Написать — можно!'; ?>
                        </h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://wa.me/77772738907" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xl sm:text-2xl font-semibold transition-colors hover:opacity-80" style="color: #f97316;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                WhatsApp
                            </a>
                            <a href="https://t.me/novacreatorstudio" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xl sm:text-2xl font-semibold transition-colors hover:opacity-80" style="color: #f97316;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.12l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                                <?php echo $currentLang === 'en' ? 'Telegram' : 'Телеграм'; ?>
                            </a>
                            <a href="https://www.instagram.com/rocket_holymedia" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xl sm:text-2xl font-semibold transition-colors hover:opacity-80" style="color: #f97316;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.246 1.805-.413 2.227-.217.562-.477.96-.896 1.382-.42.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.246-2.236-.413-.569-.224-.96-.479-1.379-.896-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.817.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                                @rocket_holymedia
                            </a>
                        </div>
                    </div>

                    <!-- Адрес -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Address' : 'Адрес'; ?>
                        </h3>
                        <p class="text-lg sm:text-xl" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Almaty, Begalina st., 103' : 'Алматы, ул. Бегалина, 103'; ?>
                        </p>
                    </div>

                    <!-- Кнопка навигации -->
                    <a href="https://2gis.kz/almaty/search/%D0%90%D0%BB%D0%BC%D0%B0%D1%82%D1%8B%2C%20%D1%83%D0%BB.%20%D0%91%D0%B5%D0%B3%D0%B0%D0%BB%D0%B8%D0%BD%D0%B0%2C%20103" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 border-2 rounded-lg transition-all hover:opacity-80" style="border-color: var(--color-text); background: white;">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#00D26A"/>
                            <path d="M2 17L12 22L22 17V12L12 17L2 12V17Z" fill="#00D26A"/>
                        </svg>
                        <span class="font-semibold" style="color: var(--color-text);"><?php echo $currentLang === 'en' ? 'Open in navigator' : 'Открыть в навигаторе'; ?></span>
                    </a>
                </div>

                <!-- Форма справа -->
                <div>
                    <div class="p-6 md:p-8 rounded-2xl" style="background-color: #d1fae5; border: 1px solid rgba(0,0,0,0.1);">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-8" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Leave a request' : 'Оставить заявку'; ?>
                        </h3>

                        <form class="contact-form space-y-4 md:space-y-6" method="POST" action="/backend/send.php">
                            <input type="hidden" name="type" value="contact">
                            <input type="hidden" name="form_name" value="<?php echo $currentLang === 'en' ? 'Contact Form' : 'Форма обратной связи'; ?>">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">

                            <!-- Имя -->
                            <div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="<?php echo $currentLang === 'en' ? 'Ali' : 'Али'; ?>"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors text-base md:text-lg" 
                                    style="background-color: white; border-color: var(--color-text); color: var(--color-text);"
                                    required
                                >
                            </div>

                            <!-- Телефон с флагом -->
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center gap-2 pointer-events-none">
                                    <span class="text-2xl">🇰🇿</span>
                                </div>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    placeholder="+7 (000) 000-00-00"
                                    class="w-full px-4 py-3 pl-14 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors text-base md:text-lg" 
                                    style="background-color: white; border-color: var(--color-text); color: var(--color-text);"
                                    pattern="^(\+7|7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$"
                                    required
                                    autocomplete="tel"
                                    maxlength="18"
                                >
                            </div>

                            <!-- Радио-кнопки -->
                            <div class="flex flex-col gap-3">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="messenger" 
                                        checked
                                        class="w-5 h-5"
                                        style="accent-color: #f97316;"
                                    >
                                    <span class="text-base md:text-lg" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Write in messenger' : 'Написать в мессенджер'; ?>
                                    </span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="call"
                                        class="w-5 h-5"
                                        style="accent-color: #f97316;"
                                    >
                                    <span class="text-base md:text-lg" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Call' : 'Позвонить'; ?>
                                    </span>
                                </label>
                            </div>

                            <!-- Кнопка отправки -->
                            <button 
                                type="submit" 
                                class="w-full px-6 py-4 text-base md:text-lg font-semibold rounded-lg transition-all hover:opacity-90 min-h-[48px] md:min-h-[56px]"
                                style="background-color: #f97316; color: white;"
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
    // Форматирование телефона
    const phoneInput = document.querySelector('#contact-form input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d+]/g, '');
            if (value.startsWith('8')) {
                value = '+7' + value.substring(1);
            } else if (value.startsWith('7') && !value.startsWith('+7')) {
                value = '+7' + value.substring(1);
            } else if (!value.startsWith('+7')) {
                value = '+7' + value;
            }
            value = value.substring(0, 12);
            if (value.length > 2) {
                let formatted = value.substring(0, 2) + ' ';
                if (value.length > 2) {
                    formatted += '(' + value.substring(2, 5);
                }
                if (value.length > 5) {
                    formatted += ') ' + value.substring(5, 8);
                }
                if (value.length > 8) {
                    formatted += '-' + value.substring(8, 10);
                }
                if (value.length > 10) {
                    formatted += '-' + value.substring(10, 12);
                }
                e.target.value = formatted;
            } else {
                e.target.value = value;
            }
        });
    }

    // Обработка отправки формы
    const form = document.querySelector('#contact-form .contact-form');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';

            const formData = new FormData(form);
            
            // Добавляем метод связи в сообщение
            const contactMethod = form.querySelector('input[name="contact_method"]:checked')?.value;
            if (contactMethod) {
                const methodText = contactMethod === 'messenger' 
                    ? '<?php echo $currentLang === 'en' ? 'Preferred contact: messenger' : 'Предпочтительный способ связи: мессенджер'; ?>'
                    : '<?php echo $currentLang === 'en' ? 'Preferred contact: call' : 'Предпочтительный способ связи: звонок'; ?>';
                formData.append('message', methodText);
            }

            try {
                const response = await fetch('/backend/send.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Request sent successfully!' : 'Заявка отправлена успешно!'; ?>');
                    form.reset();
                    // Сбрасываем радио-кнопку на значение по умолчанию
                    const defaultRadio = form.querySelector('input[name="contact_method"][value="messenger"]');
                    if (defaultRadio) defaultRadio.checked = true;
                } else {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Error sending request' : 'Ошибка отправки заявки'; ?>');
                }
            } catch (error) {
                alert('<?php echo $currentLang === 'en' ? 'Error sending request' : 'Ошибка отправки заявки'; ?>');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
