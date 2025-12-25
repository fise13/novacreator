<?php
/**
 * Карточка услуги - универсальный компонент
 * 
 * @param string $icon - SVG иконка (опционально)
 * @param string $title - Заголовок карточки
 * @param string $description - Описание
 * @param string $linkUrl - URL ссылки "Подробнее" (опционально)
 * @param string $linkText - Текст ссылки (по умолчанию "Подробнее")
 */
if (!isset($cardTitle) || !isset($cardDescription)) {
    return;
}

$cardIcon = $cardIcon ?? '';
$cardLinkUrl = $cardLinkUrl ?? '';
// Определяем язык для текста ссылки
if (!isset($cardLinkText)) {
    if (function_exists('getCurrentLanguage')) {
        $lang = getCurrentLanguage();
    } else {
        $lang = isset($currentLang) ? $currentLang : 'ru';
    }
    $cardLinkText = $lang === 'en' ? 'Learn more' : 'Подробнее';
}
?>

<div class="group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
    <?php if ($cardIcon): ?>
    <div class="w-12 h-12 sm:w-14 sm:h-14 mb-6 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
        <?php echo $cardIcon; ?>
    </div>
    <?php endif; ?>
    <h3 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
        <?php echo htmlspecialchars($cardTitle); ?>
    </h3>
    <p class="text-base sm:text-lg md:text-xl mb-6 leading-relaxed" style="color: var(--color-text-secondary);">
        <?php echo htmlspecialchars($cardDescription); ?>
    </p>
    <?php if ($cardLinkUrl): ?>
    <a href="<?php echo htmlspecialchars($cardLinkUrl); ?>" class="inline-flex items-center gap-2 text-base sm:text-lg font-medium transition-all duration-200 hover:opacity-70 hover:translate-x-1 min-h-[44px] touch-manipulation" style="color: var(--color-text);">
        <span><?php echo htmlspecialchars($cardLinkText); ?></span>
        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </a>
    <?php endif; ?>
</div>

