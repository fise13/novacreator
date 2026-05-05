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
$currentCardLang = function_exists('getCurrentLanguage') ? getCurrentLanguage() : (isset($currentLang) ? $currentLang : 'ru');
$cardSecondaryUrl = $cardSecondaryUrl ?? '';
$cardSecondaryText = $cardSecondaryText ?? ($currentCardLang === 'en' ? 'Get strategy' : 'Получить стратегию');
// Определяем язык для текста ссылки
if (!isset($cardLinkText)) {
    $lang = $currentCardLang;
    $cardLinkText = $lang === 'en' ? 'Learn more' : 'Подробнее';
}
?>

<div class="group relative reveal cursor-pointer touch-manipulation p-8 md:p-10 rounded-2xl transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl h-full flex flex-col" style="background-color: var(--color-bg); border: 1px solid var(--color-border);">
    <?php if ($cardIcon): ?>
    <div class="w-12 h-12 sm:w-14 sm:h-14 mb-6 flex items-center justify-center transition-opacity duration-200 group-hover:opacity-70">
        <?php echo $cardIcon; ?>
    </div>
    <?php endif; ?>
    <h3 class="text-2xl sm:text-3xl md:text-4xl font-semibold mb-4 leading-tight transition-opacity duration-200 group-hover:opacity-80" style="color: var(--color-text);">
        <?php echo htmlspecialchars($cardTitle); ?>
    </h3>
    <p class="text-base sm:text-lg md:text-xl mb-8 leading-relaxed flex-1" style="color: var(--color-text-secondary);">
        <?php echo htmlspecialchars($cardDescription); ?>
    </p>
    <?php if ($cardLinkUrl || $cardSecondaryUrl): ?>
    <div class="mt-auto pt-2">
        <?php if ($cardSecondaryUrl): ?>
        <a href="<?php echo htmlspecialchars($cardSecondaryUrl); ?>" class="inline-flex w-full items-center justify-center gap-2 px-5 py-3 text-sm sm:text-base font-semibold rounded-[14px] transition-all duration-300 min-h-[48px] touch-manipulation hover:scale-[1.03] hover:shadow-[0_10px_28px_rgba(139,92,246,0.45)]" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #ffffff; text-decoration: none; box-shadow: 0 6px 18px rgba(99, 102, 241, 0.28);">
            <span><?php echo htmlspecialchars($cardSecondaryText); ?></span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5l7.5 7.5-7.5 7.5M3 12h17.25"></path>
            </svg>
        </a>
        <?php endif; ?>
        <?php if ($cardLinkUrl): ?>
        <a href="<?php echo htmlspecialchars($cardLinkUrl); ?>" class="inline-flex items-center gap-2 mt-4 text-sm sm:text-base font-medium transition-all duration-200 hover:opacity-80 hover:translate-x-1 min-h-[36px] touch-manipulation" style="color: var(--color-text-secondary);">
            <span><?php echo htmlspecialchars($cardLinkText); ?></span>
            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

