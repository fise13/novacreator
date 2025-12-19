<?php
/**
 * Страница 404 - Страница не найдена
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

http_response_code(404);
$pageTitle = $currentLang === 'en' ? '404 - Page Not Found' : '404 - Страница не найдена';
$pageMetaTitle = $currentLang === 'en' ? '404 - Page Not Found' : '404 - Страница не найдена';
$pageMetaDescription = $currentLang === 'en' ? 'The page you are looking for does not exist.' : 'Запрашиваемая страница не существует.';
include 'includes/header.php';
?>

<!-- Hero секция - Apple минималистичный дизайн на весь экран -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-96 md:h-96 rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-8xl sm:text-9xl md:text-[12rem] lg:text-[14rem] xl:text-[16rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                404
            </h1>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Page Not Found' : 'Страница не найдена'; ?>
            </h2>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' 
                    ? 'Unfortunately, the page you are looking for does not exist or has been moved.' 
                    : 'К сожалению, запрашиваемая страница не существует или была перемещена.'; ?>
            </p>
            
            <!-- CTA кнопки -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 md:gap-6 reveal px-4 sm:px-0">
                <a href="<?php echo getLocalizedUrl($currentLang, '/'); ?>" class="group relative inline-block w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation hover:scale-105 hover:shadow-xl" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; border: none; text-decoration: none; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);">
                    <span class="relative z-10"><?php echo $currentLang === 'en' ? 'Go to Home' : 'На главную'; ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"></div>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation hover:scale-105" style="border: 1px solid rgba(99, 102, 241, 0.3); color: var(--color-text); background-color: transparent; text-decoration: none;">
                    <?php echo $currentLang === 'en' ? 'Contact Us' : 'Связаться с нами'; ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

