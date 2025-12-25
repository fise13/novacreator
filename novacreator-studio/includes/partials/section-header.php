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
$maxWidthClass = $sectionAlign === 'center' ? 'max-w-5xl mx-auto' : '';
?>

<div class="mb-12 md:mb-16 lg:mb-20 reveal <?php echo $alignClass; ?>">
    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl font-extrabold mb-4 md:mb-6 leading-[0.9] tracking-tighter" style="color: var(--color-text);">
        <?php echo htmlspecialchars($sectionTitle); ?>
    </h2>
    <?php if ($sectionSubtitle): ?>
    <p class="text-lg sm:text-xl md:text-2xl <?php echo $maxWidthClass; ?>" style="color: var(--color-text-secondary);">
        <?php echo htmlspecialchars($sectionSubtitle); ?>
    </p>
    <?php endif; ?>
</div>

