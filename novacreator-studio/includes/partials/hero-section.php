<?php
/**
 * Hero — minimal template style (calm typography, optional soft background)
 *
 * @param string $heroTitle
 * @param string $heroSubtitle
 * @param array $heroCtaButtons
 * @param bool|string $heroTrustLine
 * @param bool $heroWithParallax
 * @param bool $heroScrollIndicator
 */
if (!isset($heroTitle)) {
    return;
}

$heroSubtitle = $heroSubtitle ?? '';
$heroCtaButtons = $heroCtaButtons ?? [];
$heroTrustLine = $heroTrustLine ?? false;
$heroWithParallax = $heroWithParallax ?? false;
$heroScrollIndicator = $heroScrollIndicator ?? false;
?>

<section class="hero-premium reveal-group relative overflow-hidden border-b pt-24 pb-16 md:pt-32 md:pb-24" style="border-color: var(--color-border);">
    <?php if ($heroWithParallax): ?>
    <div class="pointer-events-none absolute inset-0 opacity-[0.04] dark:opacity-[0.07]" aria-hidden="true">
        <div class="absolute -left-1/4 top-1/4 h-64 w-64 rounded-full blur-3xl" style="background: var(--color-text);"></div>
        <div class="absolute -right-1/4 bottom-1/4 h-64 w-64 rounded-full blur-3xl" style="background: var(--color-text-secondary);"></div>
    </div>
    <?php endif; ?>

    <div class="container relative z-10 mx-auto px-4 md:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <h1 class="hero-title-premium reveal mb-5 md:mb-6">
                <?php echo htmlspecialchars($heroTitle); ?>
            </h1>

            <?php if ($heroSubtitle): ?>
            <p class="hero-subtitle-premium reveal mx-auto mb-8 text-balance md:mb-10">
                <?php echo htmlspecialchars($heroSubtitle); ?>
            </p>
            <?php endif; ?>

            <?php if (!empty($heroCtaButtons)): ?>
            <div class="reveal flex flex-col items-stretch justify-center gap-3 sm:flex-row sm:items-center sm:gap-4">
                <?php foreach ($heroCtaButtons as $button): ?>
                    <a
                        href="<?php echo htmlspecialchars($button['url'] ?? '#'); ?>"
                        <?php if (isset($button['onclick'])): ?>onclick="<?php echo htmlspecialchars($button['onclick']); ?>"<?php endif; ?>
                        class="<?php echo htmlspecialchars($button['class'] ?? 'btn-premium-primary inline-flex min-h-[48px] w-full items-center justify-center rounded-xl px-8 py-3.5 text-base font-semibold transition-colors duration-200 sm:w-auto'); ?>"
                        <?php if (isset($button['style']) && $button['style'] !== ''): ?>style="<?php echo htmlspecialchars($button['style']); ?>"<?php endif; ?>
                    >
                        <?php echo htmlspecialchars($button['text']); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($heroTrustLine && is_string($heroTrustLine) && $heroTrustLine !== ''): ?>
            <p class="reveal mt-8 text-sm font-medium md:text-base" style="color: var(--color-text-secondary);">
                <?php echo htmlspecialchars($heroTrustLine); ?>
            </p>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($heroScrollIndicator): ?>
    <div class="absolute bottom-6 left-1/2 hidden -translate-x-1/2 sm:block" aria-hidden="true">
        <div class="flex h-9 w-9 items-center justify-center rounded-full border transition-opacity hover:opacity-80" style="border-color: var(--color-border); color: var(--color-text-secondary);">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
    <?php endif; ?>
</section>
