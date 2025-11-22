<?php
/**
 * Страница услуг
 * Подробное описание всех услуг агентства
 */
$pageTitle = 'Услуги';
$pageMetaTitle = 'Услуги Digital-агентства | SEO, разработка, маркетинг - NovaCreator Studio';
$pageMetaDescription = 'Комплексные digital-услуги: SEO-оптимизация, разработка сайтов, Google Ads, маркетинг и аналитика. Полный цикл услуг для роста вашего бизнеса в интернете.';
$pageMetaKeywords = 'услуги digital агентства, SEO услуги, разработка сайтов, контекстная реклама, маркетинговые услуги, веб-разработка, digital услуги';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">Наши услуги</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Комплексные решения для digital-продвижения вашего бизнеса. 
                От разработки до продвижения — всё в одном месте.
            </p>
        </div>
    </div>
</section>

<!-- SEO-оптимизация -->
<section id="seo" class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">SEO-оптимизация</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    Выводим ваш сайт в топ поисковых систем Яндекс и Google. 
                    Комплексная оптимизация включает технический аудит, работу с контентом, 
                    построение ссылочной массы и постоянный мониторинг позиций.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Технический аудит и исправление ошибок</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Оптимизация контента и мета-тегов</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Построение ссылочной массы</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Ежемесячная отчетность и аналитика</span>
                    </li>
                </ul>
                <a href="seo.php" class="btn-neon inline-block">
                    Подробнее о SEO
                </a>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8 h-full">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-400">Органический трафик</span>
                            <span class="text-2xl font-bold text-neon-purple">+250%</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-400">Позиции в топ-10</span>
                            <span class="text-2xl font-bold text-neon-blue">+180%</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-400">Конверсии</span>
                            <span class="text-2xl font-bold text-neon-purple">+95%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Разработка сайтов -->
<section id="development" class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-bg border border-dark-border rounded-2xl p-8">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300">Адаптивный дизайн</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300">Высокая скорость загрузки</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300">SEO-оптимизация из коробки</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300">Интеграции и API</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Разработка сайтов</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    Создаем современные, быстрые и функциональные сайты. От простых 
                    лендингов до сложных веб-приложений. Используем актуальные технологии 
                    и лучшие практики разработки.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Лендинги и корпоративные сайты</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Интернет-магазины и каталоги</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Веб-приложения и порталы</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Поддержка и обновления</span>
                    </li>
                </ul>
                <a href="contact.php" class="btn-neon inline-block">
                    Обсудить проект
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Google Ads -->
<section id="ads" class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Google Ads</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    Настройка и ведение контекстной рекламы в Google. Создаем эффективные 
                    кампании, которые приносят целевой трафик и конверсии. Постоянная 
                    оптимизация для максимального ROI.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Настройка кампаний с нуля</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Создание рекламных объявлений</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Работа с ключевыми словами и аудиториями</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Ежедневный мониторинг и оптимизация</span>
                    </li>
                </ul>
                <a href="ads.php" class="btn-neon inline-block">
                    Подробнее о Google Ads
                </a>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gradient">Результаты наших клиентов</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400">CTR</span>
                                <span class="text-neon-purple font-bold">+45%</span>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-2">
                                <div class="bg-gradient-to-r from-neon-purple to-neon-blue h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400">Конверсии</span>
                                <span class="text-neon-blue font-bold">+120%</span>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-2">
                                <div class="bg-gradient-to-r from-neon-blue to-neon-purple h-2 rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-400">Снижение стоимости клика</span>
                                <span class="text-neon-purple font-bold">-35%</span>
                            </div>
                            <div class="w-full bg-dark-bg rounded-full h-2">
                                <div class="bg-gradient-to-r from-neon-purple to-neon-blue h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Маркетинг -->
<section id="marketing" class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1 animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-purple mb-2">SMM</div>
                        <p class="text-sm text-gray-400">Социальные сети</p>
                    </div>
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-blue mb-2">Email</div>
                        <p class="text-sm text-gray-400">Рассылки</p>
                    </div>
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-purple mb-2">Контент</div>
                        <p class="text-sm text-gray-400">Маркетинг</p>
                    </div>
                    <div class="bg-dark-bg border border-dark-border rounded-xl p-6 text-center">
                        <div class="text-3xl font-bold text-neon-blue mb-2">Бренд</div>
                        <p class="text-sm text-gray-400">Позиционирование</p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Маркетинг</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    Разработка и внедрение комплексных маркетинговых стратегий. 
                    От SMM до контент-маркетинга — помогаем вашему бренду занять 
                    лидирующие позиции на рынке.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">SMM и продвижение в соцсетях</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Контент-маркетинг и блогинг</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Email-маркетинг и рассылки</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-blue mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Брендинг и позиционирование</span>
                    </li>
                </ul>
                <a href="contact.php" class="btn-neon inline-block">
                    Обсудить стратегию
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Аналитика и конверсии -->
<section id="analytics" class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Аналитика и конверсии</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    Глубокий анализ данных и метрик для принятия обоснованных решений. 
                    Настраиваем системы аналитики, отслеживаем конверсии и оптимизируем 
                    воронки продаж для максимальной эффективности.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Настройка Google Analytics и Яндекс.Метрики</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Отслеживание конверсий и целей</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">A/B тестирование и оптимизация</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Ежемесячные отчеты и рекомендации</span>
                    </li>
                </ul>
                <a href="contact.php" class="btn-neon inline-block">
                    Настроить аналитику
                </a>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gradient">Что мы отслеживаем</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300">Посетители и сессии</span>
                            <span class="text-neon-purple">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300">Конверсии и цели</span>
                            <span class="text-neon-blue">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300">Поведение пользователей</span>
                            <span class="text-neon-purple">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300">Источники трафика</span>
                            <span class="text-neon-blue">✓</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-dark-bg rounded-lg">
                            <span class="text-gray-300">ROI и эффективность</span>
                            <span class="text-neon-purple">✓</span>
                        </div>
                    </div>
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
                Готовы начать?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Свяжитесь с нами и получите бесплатную консультацию по вашему проекту
            </p>
            <a href="contact.php" class="btn-neon inline-block">
                Связаться с нами
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

