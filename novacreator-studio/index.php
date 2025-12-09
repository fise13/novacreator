<?php
/**
 * Главная страница NovaCreator Studio
 * Полностью переделан в стиле holymedia.kz
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

<!-- Hero секция - стиль holymedia.kz -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-24 md:pt-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-6xl mx-auto text-center">
            <!-- Главный заголовок - ОГРОМНЫЙ как на holymedia.kz -->
            <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl xl:text-[12rem] font-bold mb-8 md:mb-12 leading-[0.9] tracking-tight animate-on-scroll" style="color: var(--color-text);">
                <?php 
                $headlinesData = json_decode(file_get_contents(__DIR__ . '/lang/' . $currentLang . '.json'), true);
                $headlines = $headlinesData['home']['hero']['headlines'] ?? [];
                $randomHeadline = !empty($headlines) ? $headlines[array_rand($headlines)] : ['title' => 'NovaCreator Studio', 'subtitle' => ''];
                echo htmlspecialchars($randomHeadline['title']); 
                ?>
            </h1>
            
            <!-- Подзаголовок - простой и читаемый -->
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl mb-12 md:mb-16 max-w-4xl mx-auto leading-relaxed font-light animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php 
                $descriptions = $headlinesData['home']['hero']['descriptions'] ?? [];
                $randomDescription = !empty($descriptions) ? $descriptions[array_rand($descriptions)] : 'Цифровое агентство';
                echo htmlspecialchars($randomDescription); 
                ?>
            </p>
            
            <!-- CTA кнопки - большие и простые -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6 animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="px-8 py-4 md:px-12 md:py-5 bg-black text-white text-lg md:text-xl font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px] flex items-center justify-center">
                    <?php echo htmlspecialchars(t('common.getStarted')); ?>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="px-8 py-4 md:px-12 md:py-5 border-2 border-gray-900 text-gray-900 text-lg md:text-xl font-semibold rounded-lg hover:bg-gray-50 transition-colors duration-200 min-h-[56px] flex items-center justify-center" style="border-color: var(--color-text); color: var(--color-text);">
                    <?php echo htmlspecialchars(t('common.viewPortfolio')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Статистика - простой блок как на holymedia.kz -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12 md:mb-16">
                <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl font-bold mb-4" style="color: var(--color-text);">
                    <span class="counter-number" data-target="120" data-suffix="+">0</span>
                </div>
                <p class="text-xl md:text-2xl" style="color: var(--color-text-secondary);">
                    <?php echo $currentLang === 'en' ? 'projects' : 'проектов'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Услуги - простые карточки как на holymedia.kz -->
<section id="services" class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Заголовок секции -->
            <div class="mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.services.title')); ?>
                </h2>
            </div>
            
            <!-- Карточки услуг - простые и минималистичные -->
            <div class="space-y-12 md:space-y-16">
                <!-- SEO -->
                <div class="animate-on-scroll">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.seo.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.services.seo.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/seo'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.development.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.services.development.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#development'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Google Ads -->
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.ads.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.services.ads.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/ads'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Маркетинг -->
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.marketing.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.services.marketing.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#marketing'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Аналитика -->
                <div class="animate-on-scroll" style="animation-delay: 0.4s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.services.analytics.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.services.analytics.description')); ?>
                    </p>
                    <a href="<?php echo getLocalizedUrl($currentLang, '/services#analytics'); ?>" class="inline-flex items-center gap-2 text-lg font-semibold hover:underline" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Learn more' : 'Подробнее'; ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Процесс работы - простые шаги -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.process.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="animate-on-scroll">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">1</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step1.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.process.step1.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">2</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step2.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.process.step2.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">3</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step3.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.process.step3.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4" style="color: var(--color-text);">4</div>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.process.step4.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.process.step4.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Гарантии - простой блок -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-16 md:mb-20 animate-on-scroll">
                <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo htmlspecialchars(t('home.guarantees.title')); ?>
                </h2>
            </div>
            
            <div class="space-y-12 md:space-y-16">
                <div class="animate-on-scroll">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.guarantees.lifetime.description')); ?>
                    </p>
                </div>
                
                <div class="animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('home.guarantees.support.title')); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars(t('home.guarantees.support.description')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция - простая и большая -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('home.cta.title')); ?>
            </h2>
            <p class="text-xl md:text-2xl mb-10 md:mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('home.cta.description')); ?>
            </p>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px]">
                    <?php echo htmlspecialchars(t('common.getConsultation')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Скрипт для анимации счетчиков -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('[data-target]');
    
    const animateCounter = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const prefix = element.getAttribute('data-prefix') || '';
        const suffix = element.getAttribute('data-suffix') || '';
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = prefix + target + suffix;
                clearInterval(timer);
            } else {
                element.textContent = prefix + Math.floor(current) + suffix;
            }
        }, 16);
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const currentText = entry.target.textContent.trim();
                if (currentText === '0' || currentText === '' || /^[+\-]?0[%]?$/.test(currentText)) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
    
    // Анимация появления элементов
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        scrollObserver.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
