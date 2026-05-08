<?php
/**
 * Заголовок секции - универсальный компонент
 * 
 * @param string $title - Заголовок H2
 * @param string $subtitle - Подзаголовок (опционально)
 * @param string $align - Выравнивание: left, center (по умолчанию left)
 */
if (!isset($sectionTitle)) {
    return;
}

$sectionSubtitle = $sectionSubtitle ?? '';
$sectionAlign = $sectionAlign ?? 'left';
$alignClass = $sectionAlign === 'center' ? 'text-center' : '';
$subtitleWidthClass = $sectionAlign === 'center' ? 'max-w-2xl mx-auto' : 'max-w-2xl';
?>

<div class="mb-10 reveal md:mb-14 <?php echo $alignClass; ?>">
    <h2 class="mb-3 text-2xl font-semibold tracking-tight md:mb-4 md:text-3xl" style="color: var(--color-text);">
        <?php echo htmlspecialchars($sectionTitle); ?>
    </h2>
    <?php if ($sectionSubtitle): ?>
    <p class="<?php echo $subtitleWidthClass; ?> text-base leading-relaxed md:text-lg" style="color: var(--color-text-secondary);">
        <?php echo htmlspecialchars($sectionSubtitle); ?>
    </p>
    <?php endif; ?>
</div>

