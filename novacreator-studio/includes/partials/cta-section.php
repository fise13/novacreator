<?php
/**
 * CTA секция - универсальный компонент
 * 
 * @param string $title - Заголовок
 * @param string $subtitle - Подзаголовок (опционально)
 * @param string $buttonText - Текст кнопки
 * @param string $buttonUrl - URL кнопки
 * @param string $bgColor - Цвет фона: bg, bg-lighter (по умолчанию bg-lighter)
 */
if (!isset($ctaTitle) || !isset($ctaButtonText) || !isset($ctaButtonUrl)) {
    return;
}

$ctaSubtitle = $ctaSubtitle ?? '';
$ctaBgColor = $ctaBgColor ?? 'bg-lighter';
$bgColorClass = $ctaBgColor === 'bg' ? 'var(--color-bg)' : 'var(--color-bg-lighter)';
?>

<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: <?php echo $bgColorClass; ?>;">
    <!-- Фоновые элементы -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 md:w-96 md:h-96 rounded-full blur-3xl opacity-10 animate-pulse" style="background: radial-gradient(circle, var(--color-neon-purple), transparent);"></div>
    </div>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-12 leading-tight reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars($ctaTitle); ?>
            </h2>
            <?php if ($ctaSubtitle): ?>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars($ctaSubtitle); ?>
            </p>
            <?php endif; ?>
            <div class="reveal">
                <a href="<?php echo htmlspecialchars($ctaButtonUrl); ?>" class="group relative inline-block w-full sm:w-auto px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10"><?php echo htmlspecialchars($ctaButtonText); ?></span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

