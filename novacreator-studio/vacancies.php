<?php
/**
 * Страница вакансий
 * Информация о вакансиях и возможностях работы в NovaCreator Studio
 */
$pageTitle = 'Вакансии';
$pageMetaTitle = 'Вакансии в NovaCreator Studio | Работа в Digital-агентстве';
$pageMetaDescription = 'Открытые вакансии в NovaCreator Studio. Ищем SEO-специалистов, веб-разработчиков, специалистов по контекстной рекламе. Удаленная работа, гибкий график, интересные проекты.';
$pageMetaKeywords = 'вакансии, работа в digital агентстве, удаленная работа, вакансии SEO, вакансии разработчика, работа маркетологом';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">Вакансии</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Присоединяйтесь к нашей команде! Мы ищем талантливых профессионалов, 
                готовых развиваться вместе с нами в digital-сфере.
            </p>
        </div>
    </div>
</section>

<!-- О работе в компании -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Почему мы?</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    NovaCreator Studio — это новая компания с большим опытом команды. 
                    Мы работаем удаленно, что дает свободу и гибкость. У нас интересные проекты, 
                    профессиональный рост и дружная команда.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Полностью удаленная работа</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Гибкий график работы</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Интересные проекты и задачи</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Профессиональное развитие</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-neon-purple mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-300">Дружная команда профессионалов</span>
                    </li>
                </ul>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <h3 class="text-2xl font-bold mb-6 text-gradient">Что мы предлагаем</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300">Конкурентная зарплата</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300">Официальное оформление</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300">Обучение и развитие</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-blue rounded-full"></div>
                            <span class="text-gray-300">Работа над реальными проектами</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-neon-purple rounded-full"></div>
                            <span class="text-gray-300">Возможность карьерного роста</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Открытые вакансии -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Открытые вакансии</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Мы постоянно растем и ищем талантливых людей. Если вы не нашли подходящую вакансию, 
                отправьте резюме на общих основаниях.
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Вакансия 1 -->
            <div class="service-card animate-on-scroll">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient">SEO-специалист</h3>
                        <p class="text-gray-400 mb-4">
                            Ищем опытного SEO-специалиста для работы над проектами клиентов. 
                            Требуется знание технического SEO, работы с контентом и аналитикой.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Удаленно</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Полная занятость</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Опыт от 2 лет</span>
                        </div>
                    </div>
                    <a href="contact.php?type=vacancy&vacancy=SEO-специалист" class="btn-neon whitespace-nowrap">
                        Откликнуться
                    </a>
                </div>
            </div>
            
            <!-- Вакансия 2 -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient">Веб-разработчик</h3>
                        <p class="text-gray-400 mb-4">
                            Нужен разработчик для создания современных сайтов и веб-приложений. 
                            Работа с PHP, JavaScript, HTML/CSS. Знание фреймворков приветствуется.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Удаленно</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Полная/Частичная</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Опыт от 1 года</span>
                        </div>
                    </div>
                    <a href="contact.php?type=vacancy&vacancy=Веб-разработчик" class="btn-neon whitespace-nowrap">
                        Откликнуться
                    </a>
                </div>
            </div>
            
            <!-- Вакансия 3 -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient">Специалист по контекстной рекламе</h3>
                        <p class="text-gray-400 mb-4">
                            Ищем специалиста по настройке и ведению рекламных кампаний в Google Ads 
                            и Яндекс.Директ. Опыт работы с аналитикой обязателен.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Удаленно</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Полная занятость</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Опыт от 1 года</span>
                        </div>
                    </div>
                    <a href="contact.php?type=vacancy&vacancy=Специалист по контекстной рекламе" class="btn-neon whitespace-nowrap">
                        Откликнуться
                    </a>
                </div>
            </div>
            
            <!-- Вакансия 4 -->
            <div class="service-card animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-2 text-gradient">Контент-менеджер</h3>
                        <p class="text-gray-400 mb-4">
                            Нужен специалист для создания и редактирования контента, работы с текстами 
                            для сайтов и социальных сетей. Копирайтинг и SEO-тексты.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Удаленно</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Частичная занятость</span>
                            <span class="px-3 py-1 bg-dark-bg border border-dark-border rounded-full text-xs text-gray-400">Опыт приветствуется</span>
                        </div>
                    </div>
                    <a href="contact.php?type=vacancy&vacancy=Контент-менеджер" class="btn-neon whitespace-nowrap">
                        Откликнуться
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Как откликнуться -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Как откликнуться на вакансию?</h2>
            <p class="text-xl text-gray-400 mb-12">
                Процесс отклика простой и быстрый
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6 text-2xl font-bold">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">Заполните форму</h3>
                    <p class="text-gray-400">
                        Перейдите на страницу контактов и заполните форму, указав в сообщении, 
                        на какую вакансию вы откликаетесь.
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mb-6 text-2xl font-bold">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">Приложите резюме</h3>
                    <p class="text-gray-400">
                        В сообщении укажите ссылку на ваше резюме или опишите свой опыт работы 
                        и навыки.
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mb-6 text-2xl font-bold">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gradient">Ждите ответа</h3>
                    <p class="text-gray-400">
                        Мы рассмотрим вашу заявку и свяжемся с вами в течение 1-2 рабочих дней 
                        для обсуждения деталей.
                    </p>
                </div>
            </div>
            
            <div class="mt-12">
                <a href="contact.php?type=vacancy" class="btn-neon inline-block">
                    Отправить резюме
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Не нашли подходящую вакансию?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Отправьте резюме на общих основаниях. Мы всегда рады талантливым людям 
                и можем найти место для вас в нашей команде.
            </p>
            <a href="contact.php?type=vacancy" class="btn-neon inline-block">
                Отправить резюме
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

