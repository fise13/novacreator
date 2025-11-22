<?php
/**
 * Страница портфолио
 * Примеры работ агентства
 */
$pageTitle = 'Портфолио';
$pageMetaTitle = 'Портфолио проектов | Примеры работ Digital-агентства - NovaCreator Studio';
$pageMetaDescription = 'Портфолио успешных проектов NovaCreator Studio. Реальные кейсы: motorland.kz и другие. Результаты: рост трафика до 400%, увеличение конверсий, продвижение в топ поисковых систем.';
$pageMetaKeywords = 'портфолио digital агентства, примеры работ, кейсы продвижения, успешные проекты SEO, кейсы разработки сайтов';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">Наши работы</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Реальные проекты, реальные результаты. Посмотрите, как мы помогли 
                бизнесам расти в цифровом пространстве.
            </p>
        </div>
    </div>
</section>

<!-- Портфолио проекты -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Проект 1 -->
            <div class="service-card animate-on-scroll group cursor-pointer">
                <div class="w-full h-48 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 rounded-lg mb-6 flex items-center justify-center">
                    <div class="text-3xl font-bold text-gradient opacity-70">motorland.kz</div>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gradient">Motorland.kz</h3>
                <p class="text-gray-400 mb-6">
                    Комплексное продвижение и развитие интернет-магазина автозапчастей. 
                    Работа над SEO, контекстной рекламой и улучшением конверсий.
                </p>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Рост трафика</span>
                        <span class="text-neon-purple font-bold">Значительный</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Улучшение позиций</span>
                        <span class="text-neon-blue font-bold">В топ-10</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Статус</span>
                        <span class="text-gray-300">Успешно завершен</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">SEO</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Google Ads</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Аналитика</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Оптимизация</span>
                </div>
            </div>
            
            <!-- Проект 2 -->
            <div class="service-card animate-on-scroll group cursor-pointer" style="animation-delay: 0.1s;">
                <div class="w-full h-48 bg-gradient-to-r from-neon-blue/20 to-neon-purple/20 rounded-lg mb-6 flex items-center justify-center">
                    <div class="text-6xl font-bold text-gradient opacity-50">2</div>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gradient">Корпоративный сайт B2B</h3>
                <p class="text-gray-400 mb-6">
                    Разработка и продвижение корпоративного сайта для IT-компании.
                </p>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Рост трафика</span>
                        <span class="text-neon-purple font-bold">+280%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Лиды</span>
                        <span class="text-neon-blue font-bold">+200%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Срок проекта</span>
                        <span class="text-gray-300">8 месяцев</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Разработка</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">SEO</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Контент</span>
                </div>
            </div>
            
            <!-- Проект 3 -->
            <div class="service-card animate-on-scroll group cursor-pointer" style="animation-delay: 0.2s;">
                <div class="w-full h-48 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 rounded-lg mb-6 flex items-center justify-center">
                    <div class="text-6xl font-bold text-gradient opacity-50">3</div>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gradient">Лендинг для стартапа</h3>
                <p class="text-gray-400 mb-6">
                    Создание продающего лендинга и запуск рекламной кампании для привлечения инвесторов.
                </p>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Конверсия</span>
                        <span class="text-neon-purple font-bold">+450%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Стоимость лида</span>
                        <span class="text-neon-blue font-bold">-60%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Срок проекта</span>
                        <span class="text-gray-300">3 месяца</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Разработка</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Google Ads</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">UX/UI</span>
                </div>
            </div>
            
            <!-- Проект 4 -->
            <div class="service-card animate-on-scroll group cursor-pointer" style="animation-delay: 0.3s;">
                <div class="w-full h-48 bg-gradient-to-r from-neon-blue/20 to-neon-purple/20 rounded-lg mb-6 flex items-center justify-center">
                    <div class="text-6xl font-bold text-gradient opacity-50">4</div>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gradient">E-commerce платформа</h3>
                <p class="text-gray-400 mb-6">
                    Разработка и продвижение крупной e-commerce платформы с интеграцией аналитики.
                </p>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Продажи</span>
                        <span class="text-neon-purple font-bold">+380%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Трафик</span>
                        <span class="text-neon-blue font-bold">+250%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Срок проекта</span>
                        <span class="text-gray-300">18 месяцев</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Разработка</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">SEO</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Интеграции</span>
                </div>
            </div>
            
            <!-- Проект 5 -->
            <div class="service-card animate-on-scroll group cursor-pointer" style="animation-delay: 0.4s;">
                <div class="w-full h-48 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 rounded-lg mb-6 flex items-center justify-center">
                    <div class="text-6xl font-bold text-gradient opacity-50">5</div>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gradient">Медицинский центр</h3>
                <p class="text-gray-400 mb-6">
                    Продвижение сайта медицинского центра с упором на локальное SEO.
                </p>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Заявки</span>
                        <span class="text-neon-purple font-bold">+220%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Позиции в топ</span>
                        <span class="text-neon-blue font-bold">+180%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Срок проекта</span>
                        <span class="text-gray-300">10 месяцев</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">SEO</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Локальное SEO</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Контент</span>
                </div>
            </div>
            
            <!-- Проект 6 -->
            <div class="service-card animate-on-scroll group cursor-pointer" style="animation-delay: 0.5s;">
                <div class="w-full h-48 bg-gradient-to-r from-neon-blue/20 to-neon-purple/20 rounded-lg mb-6 flex items-center justify-center">
                    <div class="text-6xl font-bold text-gradient opacity-50">6</div>
                </div>
                <h3 class="text-2xl font-bold mb-3 text-gradient">Образовательная платформа</h3>
                <p class="text-gray-400 mb-6">
                    Разработка и продвижение онлайн-платформы для обучения.
                </p>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Регистрации</span>
                        <span class="text-neon-purple font-bold">+400%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Трафик</span>
                        <span class="text-neon-blue font-bold">+300%</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Срок проекта</span>
                        <span class="text-gray-300">14 месяцев</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Разработка</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">SEO</span>
                    <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Маркетинг</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Статистика -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Цифры говорят сами за себя</h2>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">150+</div>
                <p class="text-gray-400 text-lg">Успешных проектов</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">98%</div>
                <p class="text-gray-400 text-lg">Довольных клиентов</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">250%</div>
                <p class="text-gray-400 text-lg">Средний рост трафика</p>
            </div>
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="text-5xl md:text-6xl font-bold text-gradient mb-4">5</div>
                <p class="text-gray-400 text-lg">Лет опыта</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Хотите такой же результат?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Свяжитесь с нами и обсудим, как мы можем помочь вашему бизнесу
            </p>
            <a href="contact.php" class="btn-neon inline-block">
                Обсудить проект
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

