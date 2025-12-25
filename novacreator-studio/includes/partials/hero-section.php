<?php
/**
 * Hero секция - универсальный компонент
 * 
 * @param string $title - Заголовок H1
 * @param string $subtitle - Подзаголовок (опционально)
 * @param array $ctaButtons - Массив CTA кнопок (опционально)
 * @param bool $withParallax - Использовать parallax эффект (по умолчанию true)
 */
if (!isset($heroTitle)) {
    return; // Не показываем, если не передан title
}

$heroSubtitle = $heroSubtitle ?? '';
$heroCtaButtons = $heroCtaButtons ?? [];
$heroWithParallax = $heroWithParallax ?? true;
$heroScrollIndicator = $heroScrollIndicator ?? false;
?>

<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <?php if ($heroWithParallax): ?>
    <!-- Parallax background elements -->
    <div class="parallax-bg absolute inset-0 opacity-10 pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-br from-neon-purple/30 to-neon-blue/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-br from-neon-blue/30 to-neon-purple/30 rounded-full blur-3xl"></div>
    </div>
    <?php endif; ?>
    
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="<?php echo $heroWithParallax ? 'parallax-content' : ''; ?> max-w-7xl mx-auto text-center">
            <!-- Главный заголовок -->
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo htmlspecialchars($heroTitle); ?>
            </h1>
            
            <?php if ($heroSubtitle): ?>
            <!-- Подзаголовок -->
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars($heroSubtitle); ?>
            </p>
            <?php endif; ?>
            
            <?php if (!empty($heroCtaButtons)): ?>
            <!-- CTA кнопки -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 md:gap-6 reveal px-4 sm:px-0">
                <?php foreach ($heroCtaButtons as $button): ?>
                    <a 
                        href="<?php echo htmlspecialchars($button['url'] ?? '#'); ?>" 
                        <?php if (isset($button['onclick'])): ?>onclick="<?php echo htmlspecialchars($button['onclick']); ?>"<?php endif; ?>
                        class="<?php echo htmlspecialchars($button['class'] ?? 'hero-cta-btn w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-medium rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center touch-manipulation hover:scale-105 hover:shadow-xl'); ?>" 
                        style="<?php echo htmlspecialchars($button['style'] ?? 'background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; border: none; text-decoration: none; box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);'); ?>"
                    >
                        <?php echo htmlspecialchars($button['text']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if ($heroScrollIndicator): ?>
    <!-- Индикатор прокрутки -->
    <div class="absolute bottom-8 md:bottom-12 left-1/2 transform -translate-x-1/2 animate-bounce hidden sm:block">
        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center backdrop-blur-sm hover:scale-110 transition-transform cursor-pointer" style="border-color: var(--color-border); background-color: rgba(255, 255, 255, 0.05);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--color-text-secondary);">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
    <?php endif; ?>
</section>

