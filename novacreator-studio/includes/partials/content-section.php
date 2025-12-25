<?php
/**
 * Контентная секция - универсальный компонент для текстовых блоков
 * 
 * @param string $bgColor - Цвет фона: bg, bg-lighter (по умолчанию bg)
 * @param array $content - Массив контента (заголовки, параграфы)
 */
if (!isset($sectionBgColor)) {
    $sectionBgColor = 'bg';
}

$bgColorClass = $sectionBgColor === 'bg-lighter' ? 'var(--color-bg-lighter)' : 'var(--color-bg)';
?>

<section class="reveal-group py-16 md:py-20 lg:py-32" style="background-color: <?php echo $bgColorClass; ?>;">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <?php echo $sectionContent ?? ''; ?>
        </div>
    </div>
</section>

