<?php
/**
 * Страница FAQ - Часто задаваемые вопросы
 */
$pageTitle = 'FAQ';
$pageMetaTitle = 'Часто задаваемые вопросы | FAQ - NovaCreator Studio';
$pageMetaDescription = 'Ответы на популярные вопросы о SEO, разработке сайтов, Google Ads и маркетинге. Узнайте больше о наших услугах и процессе работы.';
$pageMetaKeywords = 'FAQ, часто задаваемые вопросы, вопросы и ответы, помощь, поддержка';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <div class="w-24 h-24 bg-gradient-to-r from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">Часто задаваемые вопросы</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Ответы на популярные вопросы о наших услугах и процессе работы
            </p>
        </div>
    </div>
</section>

<!-- FAQ секция с Schema.org разметкой -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div itemscope itemtype="https://schema.org/FAQPage" class="space-y-6">
                
                <!-- SEO вопросы -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        SEO-оптимизация
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Сколько времени нужно для выхода сайта в топ поисковых систем?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Первые результаты SEO-оптимизации обычно видны через 3-6 месяцев после начала работы. 
                                    Выход в топ-10 по высокочастотным запросам может занять 6-12 месяцев. 
                                    Скорость зависит от конкуренции в вашей нише, текущего состояния сайта и объема работ. 
                                    Мы предоставляем ежемесячные отчеты о прогрессе.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Что входит в стоимость SEO-продвижения?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Стоимость зависит от объема работ и сложности проекта. В базовый пакет входит: 
                                    технический аудит, оптимизация контента, работа с мета-тегами, внутренняя перелинковка, 
                                    создание карты сайта, настройка аналитики. Расширенные пакеты включают ссылочное продвижение, 
                                    контент-маркетинг и регулярные отчеты. Свяжитесь с нами для расчета стоимости вашего проекта.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 3 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Гарантируете ли вы попадание в топ-10?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Мы гарантируем профессиональную работу и постоянное улучшение позиций сайта. 
                                    Однако честные SEO-специалисты не могут гарантировать конкретные позиции, 
                                    так как алгоритмы поисковых систем постоянно меняются. Мы гарантируем: 
                                    регулярную работу над сайтом, прозрачную отчетность, рост органического трафика 
                                    и улучшение позиций по целевым запросам. <strong class="text-white">Кроме того, мы даем пожизненную гарантию</strong> 
                                    на все выполненные работы — если возникнут проблемы, мы исправим их бесплатно.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        Разработка сайтов
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Сколько времени занимает разработка сайта?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Срок разработки зависит от сложности проекта. Лендинг можно создать за 1-2 недели, 
                                    корпоративный сайт — за 3-6 недель, интернет-магазин — за 6-12 недель. 
                                    Мы всегда согласовываем сроки на этапе планирования и соблюдаем дедлайны.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Можно ли вносить изменения после запуска сайта?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Да, конечно! Мы предоставляем пожизненную гарантию на все наши работы. 
                                    Если возникнут проблемы или потребуются доработки, мы исправим их бесплатно. 
                                    Также мы предлагаем услуги поддержки и обновления контента.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Google Ads -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                        Google Ads
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Сколько стоит настройка рекламной кампании?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Стоимость настройки зависит от сложности кампании и количества ключевых слов. 
                                    Базовая настройка стоит от 15 000 тенге, комплексная кампания — от 50 000 тенге. 
                                    Также мы берем процент от бюджета на рекламу за управление кампанией. 
                                    Используйте наш калькулятор для предварительного расчета.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Когда появятся первые результаты?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Реклама начинает работать сразу после запуска кампании. Первые клики и заявки 
                                    обычно появляются в течение первых дней. Мы постоянно оптимизируем кампанию для 
                                    улучшения результатов и снижения стоимости клика.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Общие вопросы -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Общие вопросы
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Работаете ли вы с клиентами из других городов?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Да, мы работаем онлайн по всему миру. Все коммуникации проходят через интернет: 
                                    видеозвонки, мессенджеры, email. Мы успешно работаем с клиентами из разных городов 
                                    Казахстана и других стран.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Как происходит оплата?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Мы принимаем оплату банковским переводом, картой или через платежные системы. 
                                    Для крупных проектов возможна оплата поэтапно: предоплата 50%, остальное после завершения. 
                                    Все детали обсуждаются индивидуально.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 3 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 hover:border-neon-purple transition-all duration-300">
                            <h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 text-gradient cursor-pointer flex items-center justify-between" onclick="toggleFAQ(this)">
                                Предоставляете ли вы гарантии?
                                <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer hidden">
                                <p itemprop="text" class="text-gray-400 leading-relaxed">
                                    Да, мы предоставляем <strong class="text-white">пожизненную гарантию</strong> на все наши работы. 
                                    Если возникнут проблемы с сайтом или продвижением, мы исправим их бесплатно. 
                                    Первым клиентам мы также предоставляем 6 месяцев бесплатной поддержки.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA -->
            <div class="mt-16 text-center">
                <p class="text-xl text-gray-400 mb-8">
                    Не нашли ответ на свой вопрос?
                </p>
                <a href="/contact" class="btn-neon inline-block">
                    Связаться с нами
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('svg');
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        answer.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>

<?php include 'includes/footer.php'; ?>

