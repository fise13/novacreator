<?php
/**
 * Компоненты CTA (Call to Action) для увеличения конверсий
 * Используется на различных страницах сайта
 */

if (!function_exists('t')) {
    require_once __DIR__ . '/i18n.php';
}

$currentLang = getCurrentLanguage();

/**
 * Генерация плавающего CTA виджета
 */
function generateFloatingCTA($lang = 'ru') {
    ?>
    <!-- Плавающий CTA виджет -->
    <div id="floatingCTA" class="fixed bottom-6 right-6 z-50 hidden md:block animate-on-scroll" style="animation-delay: 1s;">
        <div class="bg-gradient-to-r from-neon-purple to-neon-blue rounded-2xl p-6 shadow-2xl shadow-neon-purple/50 max-w-sm transform transition-all duration-300 hover:scale-105">
            <div class="flex items-start justify-between mb-4">
                <h4 class="text-lg font-bold text-white">
                    <?php echo $lang === 'en' ? 'Need Help?' : 'Нужна помощь?'; ?>
                </h4>
                <button onclick="closeFloatingCTA()" class="text-white/80 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-white/90 text-sm mb-4">
                <?php echo $lang === 'en' ? 'Get a free consultation on your project' : 'Получите бесплатную консультацию по вашему проекту'; ?>
            </p>
            <a href="<?php echo getLocalizedUrl($lang, '/contact'); ?>" class="block w-full bg-white text-neon-purple text-center py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <?php echo $lang === 'en' ? 'Get Consultation' : 'Получить консультацию'; ?>
            </a>
        </div>
    </div>
    
    <script>
    function closeFloatingCTA() {
        const cta = document.getElementById('floatingCTA');
        if (cta) {
            cta.style.display = 'none';
            localStorage.setItem('floatingCTA_closed', 'true');
        }
    }
    
    // Показываем CTA через 30 секунд после загрузки страницы
    document.addEventListener('DOMContentLoaded', function() {
        if (!localStorage.getItem('floatingCTA_closed')) {
            setTimeout(function() {
                const cta = document.getElementById('floatingCTA');
                if (cta) {
                    cta.classList.remove('hidden');
                    cta.style.opacity = '0';
                    cta.style.transform = 'translateY(20px)';
                    setTimeout(function() {
                        cta.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                        cta.style.opacity = '1';
                        cta.style.transform = 'translateY(0)';
                    }, 100);
                }
            }, 30000);
        }
    });
    </script>
    <?php
}

/**
 * Генерация CTA секции с формой быстрого контакта
 */
function generateQuickContactCTA($lang = 'ru') {
    ?>
    <section class="py-16 md:py-20 bg-gradient-to-br from-neon-purple/20 via-dark-surface to-neon-blue/20 border-t border-b border-dark-border">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-gradient">
                    <?php echo $lang === 'en' ? 'Ready to Grow Your Business?' : 'Готовы развивать свой бизнес?'; ?>
                </h2>
                <p class="text-xl text-gray-300 mb-8">
                    <?php echo $lang === 'en' ? 'Get a free consultation and learn how we can help you achieve your goals' : 'Получите бесплатную консультацию и узнайте, как мы можем помочь вам достичь ваших целей'; ?>
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="<?php echo getLocalizedUrl($lang, '/contact'); ?>" class="btn-neon text-center w-full sm:w-auto min-h-[52px] px-8 text-lg flex items-center justify-center">
                        <?php echo $lang === 'en' ? 'Get Free Consultation' : 'Получить бесплатную консультацию'; ?>
                    </a>
                    <a href="<?php echo getLocalizedUrl($lang, '/calculator'); ?>" class="btn-outline text-center w-full sm:w-auto min-h-[52px] px-8 text-lg flex items-center justify-center">
                        <?php echo $lang === 'en' ? 'Calculate Cost' : 'Рассчитать стоимость'; ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Генерация CTA баннера в конце контента
 */
function generateContentEndCTA($lang = 'ru') {
    ?>
    <div class="mt-12 p-6 md:p-8 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 border border-neon-purple/40 rounded-2xl text-center">
        <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gradient">
            <?php echo $lang === 'en' ? 'Want to Learn More?' : 'Хотите узнать больше?'; ?>
        </h3>
        <p class="text-gray-300 mb-6 text-lg">
            <?php echo $lang === 'en' ? 'Contact us for a free consultation on your project' : 'Свяжитесь с нами для бесплатной консультации по вашему проекту'; ?>
        </p>
        <a href="<?php echo getLocalizedUrl($lang, '/contact'); ?>" class="inline-block bg-gradient-to-r from-neon-purple to-neon-blue text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg hover:scale-105 transition-all">
            <?php echo $lang === 'en' ? 'Contact Us' : 'Связаться с нами'; ?>
        </a>
    </div>
    <?php
}

