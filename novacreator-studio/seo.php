<?php
/**
 * Страница SEO-услуг
 * Подробная информация о SEO-оптимизации
 */
$pageTitle = 'SEO-оптимизация';
$pageMetaTitle = 'SEO-оптимизация сайтов | Продвижение в Яндекс и Google - NovaCreator Studio';
$pageMetaDescription = 'Профессиональная SEO-оптимизация сайтов. Выводим в топ Яндекс и Google. Технический SEO, контент-оптимизация, ссылочное продвижение. Результаты: +250% трафика, +180% позиций в топ-10.';
$pageMetaKeywords = 'SEO оптимизация, продвижение сайтов, SEO продвижение, поисковая оптимизация, SEO услуги, продвижение в Яндекс, продвижение в Google, технический SEO';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <div class="w-24 h-24 bg-gradient-to-r from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">SEO-оптимизация</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Выводим ваш сайт в топ поисковых систем. Комплексная оптимизация 
                для роста органического трафика и конверсий.
            </p>
        </div>
    </div>
</section>

<!-- Что включает SEO -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Что включает наша SEO-оптимизация</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Комплексный подход к продвижению вашего сайта в поисковых системах
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Технический SEO -->
            <div class="service-card animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Технический SEO</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Аудит сайта и исправление ошибок</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Оптимизация скорости загрузки</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Настройка robots.txt и sitemap.xml</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Исправление дублей и битых ссылок</span>
                    </li>
                </ul>
            </div>
            
            <!-- Контент-оптимизация -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Контент-оптимизация</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Оптимизация мета-тегов и заголовков</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Написание SEO-текстов</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Работа с ключевыми словами</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Оптимизация изображений</span>
                    </li>
                </ul>
            </div>
            
            <!-- Ссылочное продвижение -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Ссылочное продвижение</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Построение естественной ссылочной массы</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Работа с релевантными ресурсами</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Улучшение доменного авторитета</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Мониторинг ссылочного профиля</span>
                    </li>
                </ul>
            </div>
            
            <!-- Локальное SEO -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Локальное SEO</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Регистрация в Яндекс.Справочнике</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Настройка Google My Business</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Работа с отзывами</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Продвижение в локальной выдаче</span>
                    </li>
                </ul>
            </div>
            
            <!-- Аналитика и отчетность -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.4s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Аналитика и отчетность</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Ежемесячные отчеты о результатах</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Мониторинг позиций в поиске</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Анализ конкурентов</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-purple">•</span>
                        <span>Рекомендации по улучшению</span>
                    </li>
                </ul>
            </div>
            
            <!-- Продвижение в соцсетях -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.5s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gradient">Интеграция с SMM</h3>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Синхронизация контента</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Продвижение через соцсети</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Увеличение социальных сигналов</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <span class="text-neon-blue">•</span>
                        <span>Работа с брендингом</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Результаты -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Результаты наших клиентов</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Реальные цифры роста после работы с нами
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">+250%</div>
                <p class="text-gray-400 text-lg">Рост органического трафика</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">+180%</div>
                <p class="text-gray-400 text-lg">Позиций в топ-10</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">+95%</div>
                <p class="text-gray-400 text-lg">Рост конверсий</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">-40%</div>
                <p class="text-gray-400 text-lg">Снижение стоимости лида</p>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Как мы работаем</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Пошаговый процесс продвижения вашего сайта
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    1
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Аудит и анализ</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Проводим полный технический аудит сайта, анализируем конкурентов, 
                        изучаем целевую аудиторию и определяем ключевые слова для продвижения.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    2
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Разработка стратегии</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Создаем индивидуальную стратегию продвижения с учетом специфики 
                        вашего бизнеса, конкурентной среды и целей проекта.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    3
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Реализация</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Выполняем техническую оптимизацию, работаем с контентом, 
                        строим ссылочную массу и запускаем локальное продвижение.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0 text-2xl font-bold">
                    4
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Мониторинг и оптимизация</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Постоянно отслеживаем результаты, анализируем метрики и оптимизируем 
                        работу для достижения максимальной эффективности.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Готовы вывести сайт в топ?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Получите бесплатную консультацию и аудит вашего сайта
            </p>
            <a href="contact.php" class="btn-neon inline-block">
                Получить консультацию
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

