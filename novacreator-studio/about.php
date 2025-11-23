<?php
/**
 * Страница о компании
 * Информация о команде и ценностях агентства
 */
$pageTitle = 'О нас';
$pageMetaTitle = 'О компании NovaCreator Studio | Команда Digital-агентства';
$pageMetaDescription = 'NovaCreator Studio - новое digital-агентство с большим опытом команды. Мишкин Виктор и Амири Искандер. Молодая компания с большим стажем работы. Работаем онлайн, помогаем бизнесу расти в интернете.';
$pageMetaKeywords = 'о компании, digital агентство, команда разработчиков, команда маркетологов, о нас, история компании';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">О нас</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Мы — новая компания, которая только открылась, но у нас за плечами 
                огромный опыт в digital. Команда из двух профессионалов, работаем онлайн по всему миру.
                Работаем с клиентами по всему Казахстану: Алматы, Астана, Шымкент, Караганда, Актобе и другие города.
            </p>
        </div>
    </div>
</section>

<!-- О компании -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Кто мы такие</h2>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    NovaCreator Studio — это новое digital-агентство полного цикла, которое только 
                    открылось, но у нас за плечами огромный опыт в SEO-продвижении, разработке сайтов 
                    и маркетинговых стратегиях. Мы работаем онлайн с бизнесами любого масштаба: 
                    от стартапов до крупных корпораций.
                </p>
                <p class="text-lg text-gray-400 mb-6 leading-relaxed">
                    Мы молодая компания, но каждый из нас имеет большой стаж работы в digital-сфере. 
                    Мы объединили свои многолетние знания и навыки, чтобы создать агентство, которое помогает 
                    компаниям достигать своих целей в интернете через эффективные решения. 
                    Наш опыт позволяет нам подходить к каждому проекту профессионально и достигать отличных результатов.
                </p>
                <p class="text-lg text-gray-400 leading-relaxed">
                    Мы работаем удаленно, что позволяет нам быть гибкими и доступными для клиентов 
                    в любое время. Каждый проект для нас важен, и мы вкладываем максимум усилий 
                    в достижение результата. Наш опыт + свежий взгляд = идеальное сочетание для вашего бизнеса.
                </p>
            </div>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-8">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gradient mb-2">Новая</div>
                            <p class="text-gray-400 text-sm">Компания</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gradient mb-2">10+</div>
                            <p class="text-gray-400 text-sm">Лет опыта команды</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gradient mb-2">2</div>
                            <p class="text-gray-400 text-sm">Профессионала</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gradient mb-2">100%</div>
                            <p class="text-gray-400 text-sm">Онлайн</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ценности -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Наши ценности</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Принципы, которыми мы руководствуемся в работе
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center animate-on-scroll">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient">Качество</h3>
                <p class="text-gray-400">
                    Мы не идем на компромиссы. Каждый проект выполняется на высшем уровне.
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient">Скорость</h3>
                <p class="text-gray-400">
                    Быстро реагируем на изменения и оперативно решаем задачи клиентов.
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient">Прозрачность</h3>
                <p class="text-gray-400">
                    Открытость в коммуникации и честность в отчетности — основа доверия.
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-20 h-20 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-gradient">Результат</h3>
                <p class="text-gray-400">
                    Мы фокусируемся на достижении измеримых результатов для бизнеса.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Команда -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Наша команда</h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Профессионалы с опытом работы в digital-маркетинге и веб-разработке
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="text-center animate-on-scroll">
                <div class="w-32 h-32 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full mx-auto mb-6 flex items-center justify-center text-4xl font-bold">
                    МВ
                </div>
                <h3 class="text-2xl font-bold mb-2 text-gradient">Мишкин Виктор</h3>
                <p class="text-neon-purple mb-4">Сооснователь & Разработчик</p>
                <p class="text-gray-400">
                    Специалист по веб-разработке и digital-решениям с многолетним опытом. 
                    Создает современные и функциональные сайты, которые приносят результат.
                </p>
            </div>
            
            <div class="text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-32 h-32 bg-gradient-to-r from-neon-blue to-neon-purple rounded-full mx-auto mb-6 flex items-center justify-center text-4xl font-bold">
                    АИ
                </div>
                <h3 class="text-2xl font-bold mb-2 text-gradient">Амири Искандер</h3>
                <p class="text-neon-blue mb-4">Сооснователь & Маркетолог</p>
                <p class="text-gray-400">
                    Эксперт по SEO, маркетингу и продвижению в интернете с богатым опытом. 
                    Помогает бизнесу расти через эффективные стратегии и оптимизацию.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Почему мы -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="text-center mb-16 animate-on-scroll">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient">Почему выбирают нас</h2>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Индивидуальный подход</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Каждый проект уникален. Мы изучаем специфику вашего бизнеса и создаем 
                        стратегию, которая работает именно для вас.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Прозрачная отчетность</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Регулярные отчеты с понятными метриками и рекомендациями. Вы всегда 
                        знаете, что происходит с вашим проектом.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Быстрые результаты</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Мы не обещаем мгновенных результатов, но работаем максимально эффективно, 
                        чтобы вы увидели прогресс как можно скорее.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-6 items-start animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-gradient">Честные цены</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Прозрачное ценообразование без скрытых платежей. Вы платите только за 
                        реальную работу и результаты.
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
                Готовы работать с нами?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Свяжитесь с нами и обсудим, как мы можем помочь вашему бизнесу
            </p>
            <a href="/contact" class="btn-neon inline-block">
                Связаться с нами
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

