<?php
/**
 * Демо-страницы портфолио: улучшенные интерактивные макеты
 * Доступ: /demo.php?project={slug}
 * 
 * @version 2.0
 * @author NovaCreator Studio
 */
require_once __DIR__ . '/includes/i18n.php';

$currentLang = getCurrentLanguage();

// Расширенные данные для демо-проектов
$demos = [
    'northern-beans' => [
        'title' => [
            'ru' => 'Кофейня "Northern Beans" — демо',
            'en' => 'Coffee Shop "Northern Beans" — Demo',
        ],
        'description' => [
            'ru' => 'Тёплый лендинг кофейни с сезонным меню и уютной атмосферой. Все интерактивные элементы отключены — это визуальный макет.',
            'en' => 'Warm coffee shop landing with seasonal menu and cozy atmosphere. All interactive elements disabled — visual mockup only.',
        ],
        'theme' => 'beans',
        'icon' => '☕',
        'color' => '#f59e0b',
    ],
    'bodycraft' => [
        'title' => [
            'ru' => 'Персональный тренер "BodyCraft" — демо',
            'en' => 'Personal Trainer "BodyCraft" — Demo',
        ],
        'description' => [
            'ru' => 'Неоновый лендинг фитнес-тренера с прогресс-трекерами и квиз-формами. Логика отключена.',
            'en' => 'Neon fitness trainer landing with progress trackers and quiz forms. Logic disabled.',
        ],
        'theme' => 'bodycraft',
        'icon' => '🏋️',
        'color' => '#22c55e',
    ],
    'urbanframe' => [
        'title' => [
            'ru' => 'Застройщик "UrbanFrame" — демо',
            'en' => 'Developer "UrbanFrame" — Demo',
        ],
        'description' => [
            'ru' => 'Структурированный лендинг строительной компании с дорожной картой и калькулятором стоимости. CTA неактивны.',
            'en' => 'Structured construction company landing with roadmap and cost calculator. CTAs disabled.',
        ],
        'theme' => 'urbanframe',
        'icon' => '🏗️',
        'color' => '#f97316',
    ],
    'technest' => [
        'title' => [
            'ru' => 'Интернет-магазин "TechNest" — демо',
            'en' => 'E-commerce "TechNest" — Demo',
        ],
        'description' => [
            'ru' => 'Современный интернет-магазин техники: каталог, карточки товаров и корзина. Оплата и формы отключены.',
            'en' => 'Modern tech e-commerce: catalog, product pages and cart. Payment and forms disabled.',
        ],
        'theme' => 'technest',
        'icon' => '🛒',
        'color' => '#0ea5e9',
    ],
    'lakeview-hotel' => [
        'title' => [
            'ru' => 'Бутик-отель "Lakeview" — демо',
            'en' => 'Boutique Hotel "Lakeview" — Demo',
        ],
        'description' => [
            'ru' => 'Элегантный макет отеля с подбором номеров, фильтрами и картой. Бронирование не работает.',
            'en' => 'Elegant hotel mockup with room selection, filters and map. Booking disabled.',
        ],
        'theme' => 'lakeview',
        'icon' => '🏨',
        'color' => '#14b8a6',
    ],
];

// Получаем ID проекта
$projectId = $_GET['project'] ?? 'northern-beans';
$projectId = is_string($projectId) ? trim($projectId) : 'northern-beans';
$notFound = false;

// Проверяем существование проекта
if (!isset($demos[$projectId])) {
    http_response_code(404);
    $projectId = 'northern-beans';
    $notFound = true;
}

$demo = $demos[$projectId];

// Мета-данные страницы
$pageTitle = ($currentLang === 'en' ? 'Demo: ' : 'Демо: ') . ($demo['title'][$currentLang] ?? $projectId);
$pageMetaTitle = $pageTitle;
$pageMetaDescription = $demo['description'][$currentLang] ?? '';

// Локализованные тексты
$texts = [
    'backToPortfolio' => $currentLang === 'en' ? 'Back to Portfolio' : 'Назад к портфолио',
    'demoBadge' => $currentLang === 'en' ? 'Demo Layout' : 'Демо-макет',
    'logicOff' => $currentLang === 'en' ? 'Logic Disabled' : 'Логика отключена',
    'noteStatic' => $currentLang === 'en'
        ? 'All buttons, forms and interactive elements are intentionally disabled. This is a visual mockup for demonstration purposes only.'
        : 'Все кнопки, формы и интерактивные элементы намеренно отключены. Это визуальный макет только для демонстрации.',
    'ctaDemo' => $currentLang === 'en' ? 'demo' : 'демо',
    'notFoundText' => $currentLang === 'en'
        ? 'Demo project not found. Showing default coffee shop demo.'
        : 'Демо-проект не найден. Показываем демо кофейни по умолчанию.',
];

include __DIR__ . '/includes/header.php';

/**
 * Вспомогательная функция для корректировки яркости цвета
 */
function adjustBrightness(string $hex, int $steps): string {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));
    
    return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) .
               str_pad(dechex($g), 2, '0', STR_PAD_LEFT) .
               str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
}

/**
 * Генерирует отключенную кнопку
 */
function buttonDisabled(string $label, string $theme = 'default'): string {
    $classes = [
        'beans' => 'beans-btn-disabled',
        'bodycraft' => 'body-btn-disabled',
        'urbanframe' => 'urban-btn-disabled',
        'technest' => 'tech-btn-disabled',
        'lakeview' => 'lake-btn-disabled',
    ];
    $class = $classes[$theme] ?? 'btn-disabled';
    return '<button type="button" class="' . htmlspecialchars($class) . '" disabled aria-disabled="true" aria-label="' . htmlspecialchars($label) . ' (disabled)">' . htmlspecialchars($label) . '</button>';
}
?>

<style>
    /* ============================================
       Базовые стили и переменные
       ============================================ */
    :root {
        --shadow-soft: 0 20px 60px rgba(0, 0, 0, 0.15);
        --shadow-medium: 0 12px 40px rgba(0, 0, 0, 0.12);
        --shadow-light: 0 8px 24px rgba(0, 0, 0, 0.08);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    /* Скрываем основной header */
    #mainNavbar { display: none !important; }

    .demo-layout {
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* ============================================
       Навигация демо
       ============================================ */
    .demo-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-radius: 16px;
        margin-bottom: 32px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        box-shadow: var(--shadow-medium);
        transition: var(--transition-smooth);
    }

    .demo-nav:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .demo-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 800;
        font-size: 18px;
        letter-spacing: -0.02em;
    }

    .demo-brand-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: var(--shadow-light);
    }

    .demo-links {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        align-items: center;
    }

    .demo-links a {
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        padding: 8px 12px;
        border-radius: 8px;
        transition: var(--transition-smooth);
        position: relative;
    }

    .demo-links a:not(.active-link):hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-1px);
    }

    .demo-links a.disabled-link {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }

    .active-link {
        font-weight: 700;
        background: rgba(255, 255, 255, 0.15);
    }

    /* ============================================
       Бейджи и пилюли
       ============================================ */
    .pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 999px;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.02em;
        box-shadow: var(--shadow-light);
        transition: var(--transition-smooth);
    }

    .pill:hover {
        transform: scale(1.05);
    }

    /* ============================================
       Кнопки (отключенные)
       ============================================ */
    .btn-disabled,
    .beans-btn-disabled,
    .body-btn-disabled,
    .urban-btn-disabled,
    .tech-btn-disabled,
    .lake-btn-disabled {
        padding: 14px 24px;
        border-radius: 12px;
        border: none;
        cursor: not-allowed;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 0.01em;
        opacity: 0.7;
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
    }

    .btn-disabled::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: translateX(-100%);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* ============================================
       Секции и карточки
       ============================================ */
    .section {
        border-radius: 20px;
        padding: 28px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.04);
        box-shadow: var(--shadow-medium);
        transition: var(--transition-smooth);
    }

    .section:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-soft);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .section h3 {
        margin: 0 0 12px;
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .section p {
        margin: 0 0 16px;
        line-height: 1.7;
        font-size: 15px;
    }

    .note {
        margin-top: 20px;
        padding: 16px 20px;
        border-radius: 14px;
        font-size: 14px;
        line-height: 1.6;
        border: 2px dashed;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
    }

    /* ============================================
       Сетки
       ============================================ */
    .grid-auto {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    /* ============================================
       Анимации
       ============================================ */
    @keyframes floaty {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(1deg); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.6; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .floaty {
        animation: floaty 6s ease-in-out infinite;
    }

    .pulse {
        animation: pulse 3s ease-in-out infinite;
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* ============================================
       Тема: Northern Beans (кофейня)
       ============================================ */
    .shell-beans {
        background: radial-gradient(circle at 10% 20%, rgba(255, 214, 170, 0.4), transparent 45%),
                    radial-gradient(circle at 90% 80%, rgba(251, 191, 36, 0.2), transparent 40%),
                    linear-gradient(135deg, #f7f4ef 0%, #fff8f0 100%);
        color: #0f0f10;
        position: relative;
    }

    .shell-beans::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 20% 30%, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(251, 191, 36, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    .beans-nav {
        background: rgba(255, 247, 237, 0.95);
        border-color: rgba(251, 214, 160, 0.6);
        box-shadow: 0 20px 60px rgba(108, 68, 28, 0.12);
    }

    .beans-nav .demo-brand { color: #1f1307; }
    .beans-nav .demo-links a { color: #9a4b12; }
    .beans-nav .demo-links a.active-link { background: rgba(251, 191, 36, 0.2); color: #7c3b0c; }

    .beans-btn-disabled {
        background: linear-gradient(120deg, #fbbf24, #f97316);
        color: #2c1400;
    }

    .beans-btn-ghost {
        background: #fff;
        color: #9a4b12;
        border: 2px solid #fbbf24;
    }

    .beans-tag {
        background: rgba(255, 247, 237, 0.9);
        color: #9a4b12;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .beans-card {
        background: #fff;
        border: 1px solid rgba(241, 227, 210, 0.8);
        box-shadow: 0 20px 60px rgba(108, 68, 28, 0.1);
    }

    /* ============================================
       Тема: BodyCraft (фитнес)
       ============================================ */
    .shell-body {
        background: radial-gradient(circle at 20% 30%, rgba(34, 197, 94, 0.2), transparent 45%),
                    radial-gradient(circle at 80% 70%, rgba(59, 130, 246, 0.15), transparent 40%),
                    linear-gradient(135deg, #0b0f13 0%, #0f172a 100%);
        color: #e5e7eb;
    }

    .body-nav {
        background: rgba(12, 18, 22, 0.95);
        border-color: rgba(34, 197, 94, 0.4);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .body-nav .demo-brand { color: #e7ffee; }
    .body-nav .demo-links a { color: #9be6b8; }
    .body-nav .demo-links a.active-link { background: rgba(34, 197, 94, 0.2); color: #bbf7d0; }

    .body-btn-disabled {
        background: linear-gradient(120deg, #22c55e, #16a34a);
        color: #041007;
    }

    .body-btn-ghost {
        background: transparent;
        color: #9be6b8;
        border: 2px solid rgba(34, 197, 94, 0.6);
    }

    .body-progress {
        height: 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.1);
        overflow: hidden;
        position: relative;
    }

    .body-progress span {
        display: block;
        height: 100%;
        background: linear-gradient(90deg, #22c55e, #4ade80, #86efac);
        width: 72%;
        border-radius: 999px;
        animation: progressPulse 2s ease-in-out infinite;
    }

    @keyframes progressPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    /* ============================================
       Тема: UrbanFrame (строительство)
       ============================================ */
    .shell-urban {
        background: radial-gradient(circle at 70% 20%, rgba(249, 115, 22, 0.25), transparent 45%),
                    radial-gradient(circle at 30% 80%, rgba(248, 180, 56, 0.15), transparent 40%),
                    linear-gradient(135deg, #0f1115 0%, #1a1d24 100%);
        color: #f3f4f6;
    }

    .urban-nav {
        background: rgba(26, 29, 36, 0.95);
        border-color: rgba(249, 115, 22, 0.4);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .urban-nav .demo-brand { color: #fef3c7; }
    .urban-nav .demo-links a { color: #fbbf24; }
    .urban-nav .demo-links a.active-link { background: rgba(249, 115, 22, 0.2); color: #fde68a; }

    .urban-btn-disabled {
        background: linear-gradient(120deg, #f97316, #f59e0b);
        color: #0f0f10;
    }

    .urban-btn-ghost {
        background: transparent;
        color: #fbbf24;
        border: 2px solid rgba(249, 115, 22, 0.6);
    }

    .urban-road {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .urban-step {
        background: rgba(20, 24, 33, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 20px;
        position: relative;
        transition: var(--transition-smooth);
    }

    .urban-step:hover {
        transform: translateY(-4px);
        border-color: rgba(249, 115, 22, 0.4);
        box-shadow: 0 12px 40px rgba(249, 115, 22, 0.2);
    }

    .urban-step::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 16px;
        border: 2px dashed rgba(249, 115, 22, 0.4);
        pointer-events: none;
        opacity: 0;
        transition: var(--transition-smooth);
    }

    .urban-step:hover::after {
        opacity: 1;
    }

    /* ============================================
       Тема: TechNest (магазин)
       ============================================ */
    .shell-tech {
        background: radial-gradient(circle at 25% 10%, rgba(99, 102, 241, 0.2), transparent 40%),
                    radial-gradient(circle at 75% 90%, rgba(14, 165, 233, 0.15), transparent 40%),
                    linear-gradient(135deg, #f2f7fb 0%, #ffffff 100%);
        color: #0b1624;
    }

    .tech-nav {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 20px 60px rgba(14, 165, 233, 0.1);
    }

    .tech-nav .demo-brand { color: #0b1624; }
    .tech-nav .demo-links a { color: #0ea5e9; }
    .tech-nav .demo-links a.active-link { background: rgba(14, 165, 233, 0.1); color: #0284c7; }

    .tech-btn-disabled {
        background: linear-gradient(120deg, #0ea5e9, #6366f1);
        color: white;
    }

    .tech-btn-ghost {
        background: #fff;
        border: 2px solid #0ea5e9;
        color: #0ea5e9;
    }

    .tech-card {
        background: #fff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 12px 40px rgba(14, 165, 233, 0.08);
        transition: var(--transition-smooth);
    }

    .tech-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(14, 165, 233, 0.15);
        border-color: rgba(14, 165, 233, 0.3);
    }

    .tech-badge {
        background: rgba(224, 242, 254, 0.9);
        color: #0ea5e9;
        border: 1px solid rgba(14, 165, 233, 0.2);
    }

    /* ============================================
       Тема: Lakeview (отель)
       ============================================ */
    .shell-lake {
        background: radial-gradient(circle at 80% 10%, rgba(20, 184, 166, 0.25), transparent 45%),
                    radial-gradient(circle at 20% 90%, rgba(6, 182, 212, 0.15), transparent 40%),
                    linear-gradient(135deg, #f1fbf8 0%, #ffffff 100%);
        color: #07312b;
    }

    .lake-nav {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(208, 242, 235, 0.8);
        box-shadow: 0 20px 60px rgba(20, 184, 166, 0.12);
    }

    .lake-nav .demo-brand { color: #065f46; }
    .lake-nav .demo-links a { color: #0f766e; }
    .lake-nav .demo-links a.active-link { background: rgba(20, 184, 166, 0.1); color: #0d9488; }

    .lake-btn-disabled {
        background: linear-gradient(120deg, #14b8a6, #06b6d4);
        color: white;
    }

    .lake-btn-ghost {
        background: #fff;
        border: 2px solid #14b8a6;
        color: #0f766e;
    }

    .lake-room {
        background: linear-gradient(135deg, rgba(20, 184, 166, 0.15), rgba(6, 182, 212, 0.15));
        border: 2px solid rgba(20, 184, 166, 0.3);
        border-radius: 18px;
        padding: 24px;
        transition: var(--transition-smooth);
    }

    .lake-room:hover {
        transform: translateY(-6px);
        border-color: rgba(20, 184, 166, 0.5);
        box-shadow: 0 16px 48px rgba(20, 184, 166, 0.2);
    }

    /* ============================================
       Адаптивность
       ============================================ */
    @media (max-width: 768px) {
        .demo-nav {
            flex-direction: column;
            gap: 16px;
            padding: 16px;
        }

        .demo-links {
            width: 100%;
            justify-content: center;
        }

        .grid-auto,
        .grid-2 {
            grid-template-columns: 1fr;
        }

        .section {
            padding: 20px;
        }
    }

    /* ============================================
       Улучшенные визуальные эффекты
       ============================================ */
    .visual-preview {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }

    .visual-preview::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
        pointer-events: none;
        z-index: 1;
    }

    /* Индикатор загрузки для демо */
    .demo-loading {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<main class="demo-layout shell-<?php echo htmlspecialchars($demo['theme']); ?>" style="padding: 48px 20px 64px;">
    <div class="container mx-auto" style="max-width: 1200px;">
        <!-- Навигация -->
        <nav class="demo-nav <?php echo htmlspecialchars($demo['theme']); ?>-nav fade-in-up">
            <div class="demo-brand">
                <div class="demo-brand-icon" style="background: linear-gradient(135deg, <?php echo htmlspecialchars($demo['color']); ?>, <?php echo htmlspecialchars(adjustBrightness($demo['color'], -20)); ?>);">
                    <?php echo htmlspecialchars($demo['icon']); ?>
                </div>
                <span><?php echo htmlspecialchars(explode(' —', $demo['title'][$currentLang])[0]); ?></span>
            </div>
            <div class="demo-links">
                <a href="#" class="disabled-link"><?php echo $currentLang === 'en' ? 'Home' : 'Главная'; ?></a>
                <a href="#" class="disabled-link"><?php echo $currentLang === 'en' ? 'Features' : 'Возможности'; ?></a>
                <a href="#" class="disabled-link"><?php echo $currentLang === 'en' ? 'About' : 'О нас'; ?></a>
                <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" class="active-link">
                    <?php echo $texts['backToPortfolio']; ?>
                </a>
            </div>
        </nav>

        <?php if ($notFound): ?>
            <div class="note fade-in-up" style="margin-bottom: 24px; border-color: rgba(255, 255, 255, 0.3);">
                <?php echo $texts['notFoundText']; ?>
            </div>
        <?php endif; ?>

        <!-- Контент демо -->
        <?php if ($projectId === 'northern-beans'): ?>
            <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 32px; align-items: start;" class="fade-in-up">
                <div>
                    <div class="pill beans-tag" style="margin-bottom: 16px;">
                        <span aria-hidden="true">☕</span>
                        <?php echo $texts['demoBadge']; ?> · <?php echo $texts['logicOff']; ?>
                    </div>
                    <h1 style="font-size: 52px; line-height: 1.1; margin: 16px 0 14px; color: #1f1307; font-weight: 900; letter-spacing: -0.03em;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color: #4b2b12; line-height: 1.7; max-width: 580px; font-size: 17px; margin-bottom: 24px;">
                        <?php echo $currentLang === 'en'
                            ? 'Warm coffee shop landing with sunny highlights and seasonal menu. All interactive elements are decorative only — this is a visual mockup showcasing the design concept.'
                            : 'Тёплый лендинг кофейни с солнечными акцентами и сезонным меню. Все интерактивные элементы только декоративные — это визуальный макет, демонстрирующий концепцию дизайна.'; ?>
                    </p>
                    <div style="display: flex; gap: 14px; flex-wrap: wrap; margin: 20px 0 28px;">
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Order for pickup' : 'Заказать к приезду') . ' · ' . $texts['ctaDemo'], 'beans'); ?>
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'View menu' : 'Посмотреть меню') . ' · ' . $texts['ctaDemo'], 'beans'); ?>
                    </div>
                    <div class="grid-auto">
                        <div class="section beans-card floaty">
                            <strong style="display: block; margin-bottom: 8px; color: #1f1307;"><?php echo $currentLang === 'en' ? 'Seasonal Menu' : 'Сезонное меню'; ?></strong>
                            <p style="color: #5b3417; margin-bottom: 12px;"><?php echo $currentLang === 'en' ? 'Pumpkin spice latte, cold brew, signature desserts and fresh pastries.' : 'Тыквенный латте, колд-брю, фирменные десерты и свежая выпечка.'; ?></p>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <span class="pill beans-tag">V60</span>
                                <span class="pill beans-tag">Cold brew</span>
                                <span class="pill beans-tag">Desserts</span>
                            </div>
                        </div>
                        <div class="section beans-card">
                            <strong style="display: block; margin-bottom: 8px; color: #1f1307;"><?php echo $currentLang === 'en' ? 'Atmosphere' : 'Атмосфера'; ?></strong>
                            <p style="color: #5b3417; margin-bottom: 12px;"><?php echo $currentLang === 'en' ? 'Vinyl records, wooden bar, sunny window seats and cozy corners.' : 'Виниловые пластинки, деревянный бар, солнечные подоконники и уютные уголки.'; ?></p>
                            <?php echo buttonDisabled($currentLang === 'en' ? 'Book a table' : 'Забронировать стол', 'beans'); ?>
                        </div>
                        <div class="section beans-card">
                            <strong style="display: block; margin-bottom: 8px; color: #1f1307;"><?php echo $currentLang === 'en' ? 'Location' : 'Локация'; ?></strong>
                            <p style="color: #5b3417; margin-bottom: 12px;"><?php echo $currentLang === 'en' ? 'Old town center, 2 minutes walk from the park. Easy parking nearby.' : 'Старый центр города, 2 минуты пешком от парка. Удобная парковка рядом.'; ?></p>
                            <div class="pill beans-tag pulse"><?php echo $currentLang === 'en' ? 'Map placeholder' : 'Карта-плейсхолдер'; ?></div>
                        </div>
                    </div>
                    <div class="note" style="border-color: #fbbf24; color: #5b3417; background: rgba(255, 247, 237, 0.8); margin-top: 24px;">
                        <?php echo $texts['noteStatic']; ?>
                    </div>
                </div>
                <div class="visual-preview beans-card floaty" aria-hidden="true" style="position: sticky; top: 24px;">
                    <div style="height: 360px; border-radius: 18px; background: linear-gradient(135deg, #fcd34d, #f59e0b); position: relative; overflow: hidden;">
                        <div style="position: absolute; inset: 16px; border-radius: 14px; background: #fff6eb; border: 2px solid rgba(243, 224, 199, 0.6);"></div>
                        <div style="position: absolute; top: 36px; left: 32px; background: #fff; padding: 14px 18px; border-radius: 14px; box-shadow: 0 12px 36px rgba(244, 160, 10, 0.3); color: #7c3b0c; font-weight: 700;">
                            <?php echo $currentLang === 'en' ? 'Latte Art Class' : 'Мастер-класс латте-арт'; ?>
                        </div>
                        <div style="position: absolute; bottom: 32px; right: 28px; background: #111827; color: #fff; padding: 12px 16px; border-radius: 12px; font-weight: 700; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);">
                            <?php echo $currentLang === 'en' ? 'Ready in 12 min' : 'Готово за 12 мин'; ?>
                        </div>
                        <div style="position: absolute; bottom: 24px; left: 28px; width: 100px; height: 40px; background: #fef3c7; border-radius: 14px; border: 2px dashed #f59e0b;"></div>
                    </div>
                </div>
            </div>

        <?php elseif ($projectId === 'bodycraft'): ?>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: start;" class="fade-in-up">
                <div>
                    <div class="pill" style="background: rgba(34, 197, 94, 0.15); color: #bbf7d0; margin-bottom: 16px;">
                        <span>🏋️</span>
                        <?php echo $texts['demoBadge']; ?> · <?php echo $texts['logicOff']; ?>
                    </div>
                    <h1 style="font-size: 50px; line-height: 1.1; margin: 16px 0 14px; color: #e7ffee; font-weight: 900; letter-spacing: -0.03em;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color: #c0ead1; line-height: 1.7; max-width: 560px; font-size: 17px; margin-bottom: 24px;">
                        <?php echo $currentLang === 'en'
                            ? 'High-contrast neon landing with strong CTA blocks and progress visualization. Forms and interactive elements are placeholders only.'
                            : 'Неоновый лендинг с яркими CTA-блоками и визуализацией прогресса. Формы и интерактивные элементы — только плейсхолдеры.'; ?>
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin: 20px 0 24px;">
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Start program' : 'Начать программу') . ' · ' . $texts['ctaDemo'], 'bodycraft'); ?>
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'View plan' : 'Посмотреть план') . ' · ' . $texts['ctaDemo'], 'bodycraft'); ?>
                    </div>
                    <div class="body-progress" aria-hidden="true" style="margin-bottom: 20px;"><span></span></div>
                    <div class="grid-auto">
                        <div class="section" style="background: rgba(255, 255, 255, 0.03); border-color: rgba(34, 197, 94, 0.3);">
                            <strong style="color: #bbf7d0;"><?php echo $currentLang === 'en' ? 'Before / After' : 'До / После'; ?></strong>
                            <p style="color: #c0ead1;"><?php echo $currentLang === 'en' ? 'Progress tiles with inert toggles and comparison views.' : 'Карточки прогресса с неактивными тогглами и видами сравнения.'; ?></p>
                        </div>
                        <div class="section" style="background: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3);">
                            <strong style="color: #c7d9ff;"><?php echo $currentLang === 'en' ? 'Lead Quiz' : 'Квиз-лид'; ?></strong>
                            <p style="color: #c0ead1;"><?php echo $currentLang === 'en' ? '3-step quiz with disabled submit button.' : '3-шаговый квиз с отключенной кнопкой отправки.'; ?></p>
                        </div>
                        <div class="section" style="background: rgba(34, 197, 94, 0.1); border-color: rgba(34, 197, 94, 0.3);">
                            <strong style="color: #bbf7d0;"><?php echo $currentLang === 'en' ? 'USP' : 'УТП'; ?></strong>
                            <p style="color: #c0ead1;"><?php echo $currentLang === 'en' ? 'Clear offer: 3 workouts/week, 40 min sessions.' : 'Чёткий оффер: 3 тренировки в неделю, сессии по 40 минут.'; ?></p>
                        </div>
                    </div>
                    <div class="note" style="border-color: rgba(34, 197, 94, 0.5); background: rgba(34, 197, 94, 0.12); color: #bbf7d0; margin-top: 24px;">
                        <?php echo $texts['noteStatic']; ?>
                    </div>
                </div>
                <div class="section floaty" style="background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(59, 130, 246, 0.1)); border-color: rgba(255, 255, 255, 0.1); position: sticky; top: 24px;">
                    <div style="height: 300px; border-radius: 18px; background: #0f172a; border: 2px solid rgba(255, 255, 255, 0.1); position: relative; overflow: hidden;">
                        <div style="position: absolute; inset: 18px; border-radius: 14px; border: 2px dashed rgba(59, 130, 246, 0.5);"></div>
                        <div style="position: absolute; top: 28px; left: 28px; padding: 12px 16px; border-radius: 12px; background: rgba(34, 197, 94, 0.25); color: #bbf7d0; font-weight: 700;">Before</div>
                        <div style="position: absolute; top: 28px; right: 28px; padding: 12px 16px; border-radius: 12px; background: rgba(59, 130, 246, 0.25); color: #c7d9ff; font-weight: 700;">After</div>
                        <div style="position: absolute; bottom: 36px; left: 28px; right: 28px; height: 60px; border-radius: 14px; background: linear-gradient(90deg, rgba(34, 197, 94, 0.5), rgba(59, 130, 246, 0.5));"></div>
                    </div>
                </div>
            </div>

        <?php elseif ($projectId === 'urbanframe'): ?>
            <div style="display: grid; grid-template-columns: 1fr 1.1fr; gap: 32px; align-items: start;" class="fade-in-up">
                <div>
                    <div class="pill" style="background: rgba(249, 115, 22, 0.15); color: #fbbf24; margin-bottom: 16px;">
                        🏗️ <?php echo $texts['demoBadge']; ?> · <?php echo $texts['logicOff']; ?>
                    </div>
                    <h1 style="font-size: 50px; line-height: 1.15; margin: 16px 0 14px; color: #fef3c7; font-weight: 900; letter-spacing: -0.03em;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color: #e5e7eb; line-height: 1.7; max-width: 600px; font-size: 17px; margin-bottom: 24px;">
                        <?php echo $currentLang === 'en'
                            ? 'Structured construction landing with step-by-step timeline and detailed price breakdown. All CTAs are intentionally disabled.'
                            : 'Структурированный лендинг строительства: пошаговый таймлайн и детальная разбивка цены. Все CTA намеренно отключены.'; ?>
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin: 20px 0 28px;">
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Calculate cost' : 'Рассчитать стоимость') . ' · ' . $texts['ctaDemo'], 'urbanframe'); ?>
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'View estimates' : 'Посмотреть смету') . ' · ' . $texts['ctaDemo'], 'urbanframe'); ?>
                    </div>
                    <div class="urban-road" style="margin-bottom: 24px;">
                        <?php
                        $steps = [
                            ['title' => $currentLang === 'en' ? 'Survey & Soil' : 'Замер и грунт', 'desc' => $currentLang === 'en' ? 'Lot scan, soil tests, permits.' : 'Скан участка, грунт, разрешения.'],
                            ['title' => $currentLang === 'en' ? 'Design' : 'Проект', 'desc' => $currentLang === 'en' ? 'Concept + technical drawings.' : 'Концепт + технические чертежи.'],
                            ['title' => $currentLang === 'en' ? 'Construction' : 'Стройка', 'desc' => $currentLang === 'en' ? 'Foundation, frame, engineering systems.' : 'Фундамент, коробка, инженерные системы.'],
                            ['title' => $currentLang === 'en' ? 'Handover' : 'Сдача', 'desc' => $currentLang === 'en' ? 'Finishings, keys, warranty documents.' : 'Отделка, ключи, гарантийные документы.'],
                        ];
                        foreach ($steps as $step):
                        ?>
                            <div class="urban-step">
                                <strong style="display: block; margin-bottom: 6px; color: #fef3c7;"><?php echo htmlspecialchars($step['title']); ?></strong>
                                <p style="color: #d1d5db; margin: 0; font-size: 14px;"><?php echo htmlspecialchars($step['desc']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="note" style="border-color: rgba(249, 115, 22, 0.5); background: rgba(249, 115, 22, 0.1); color: #fde68a; margin-top: 24px;">
                        <?php echo $texts['noteStatic']; ?>
                    </div>
                </div>
                <div style="background: linear-gradient(135deg, rgba(249, 115, 22, 0.15), rgba(248, 180, 56, 0.15)); border: 2px solid rgba(249, 115, 22, 0.4); border-radius: 20px; padding: 24px;" class="floaty" style="position: sticky; top: 24px;">
                    <h3 style="margin: 0 0 16px; color: #fcd34d; font-size: 24px;"><?php echo $currentLang === 'en' ? 'Price Breakdown' : 'Разбивка цены'; ?></h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px;">
                        <div style="background: rgba(0, 0, 0, 0.25); padding: 16px; border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.1);">
                            <strong style="display: block; margin-bottom: 6px; color: #fef3c7;"><?php echo $currentLang === 'en' ? 'Foundation' : 'Фундамент'; ?></strong>
                            <p style="margin: 0; color: #f3f4f6; font-size: 14px;"><?php echo $currentLang === 'en' ? 'Slab + piles' : 'Плита + сваи'; ?></p>
                        </div>
                        <div style="background: rgba(0, 0, 0, 0.25); padding: 16px; border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.1);">
                            <strong style="display: block; margin-bottom: 6px; color: #fef3c7;"><?php echo $currentLang === 'en' ? 'Frame' : 'Коробка'; ?></strong>
                            <p style="margin: 0; color: #f3f4f6; font-size: 14px;"><?php echo $currentLang === 'en' ? 'Walls, roof' : 'Стены, крыша'; ?></p>
                        </div>
                        <div style="background: rgba(0, 0, 0, 0.25); padding: 16px; border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.1);">
                            <strong style="display: block; margin-bottom: 6px; color: #fef3c7;"><?php echo $currentLang === 'en' ? 'Engineering' : 'Инженерка'; ?></strong>
                            <p style="margin: 0; color: #f3f4f6; font-size: 14px;"><?php echo $currentLang === 'en' ? 'HVAC, power, water' : 'ОВиК, электрика, вода'; ?></p>
                        </div>
                    </div>
                    <div class="pill" style="background: rgba(255, 255, 255, 0.08); color: #fbbf24; margin-top: 16px; display: inline-flex;">
                        <?php echo $currentLang === 'en' ? 'Guarantee & docs placeholders' : 'Гарантии и документы — плейсхолдеры'; ?>
                    </div>
                </div>
            </div>

        <?php elseif ($projectId === 'technest'): ?>
            <div style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 32px; align-items: start;" class="fade-in-up">
                <div>
                    <div class="pill tech-badge" style="margin-bottom: 16px;">
                        🛒 <?php echo $texts['demoBadge']; ?> · <?php echo $texts['logicOff']; ?>
                    </div>
                    <h1 style="font-size: 50px; line-height: 1.1; margin: 16px 0 14px; color: #0b1624; font-weight: 900; letter-spacing: -0.03em;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color: #334155; line-height: 1.7; max-width: 600px; font-size: 17px; margin-bottom: 24px;">
                        <?php echo $currentLang === 'en'
                            ? 'Clean tech store layout: catalog, product pages and shopping cart — all frozen for demo purposes. Payment and forms are disabled.'
                            : 'Чистый магазин техники: каталог, карточки товаров и корзина — всё заморожено для демо. Оплата и формы отключены.'; ?>
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin: 20px 0 28px;">
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Add to cart' : 'В корзину') . ' · ' . $texts['ctaDemo'], 'technest'); ?>
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Buy now' : 'Купить сейчас') . ' · ' . $texts['ctaDemo'], 'technest'); ?>
                    </div>
                    <div class="grid-auto">
                        <div class="tech-card">
                            <strong style="display: block; margin-bottom: 8px; color: #0b1624;"><?php echo $currentLang === 'en' ? 'Filters' : 'Фильтры'; ?></strong>
                            <p style="color: #475569; margin: 0;"><?php echo $currentLang === 'en' ? 'Brand, price range, specifications toggles — all inert.' : 'Бренд, диапазон цен, характеристики — все неактивны.'; ?></p>
                        </div>
                        <div class="tech-card">
                            <strong style="display: block; margin-bottom: 8px; color: #0b1624;"><?php echo $currentLang === 'en' ? 'Product Card' : 'Карточка товара'; ?></strong>
                            <p style="color: #475569; margin: 0;"><?php echo $currentLang === 'en' ? 'Gallery, specs, recommendations placeholder.' : 'Галерея, характеристики, рекомендации — плейсхолдер.'; ?></p>
                        </div>
                        <div class="tech-card">
                            <strong style="display: block; margin-bottom: 8px; color: #0b1624;"><?php echo $currentLang === 'en' ? 'Cart / Checkout' : 'Корзина / Чекаут'; ?></strong>
                            <p style="color: #475569; margin: 0;"><?php echo $currentLang === 'en' ? 'Totals and checkout steps are visual only.' : 'Итоги и шаги чекаута только визуально.'; ?></p>
                        </div>
                    </div>
                    <div class="note" style="border-color: #0ea5e9; color: #0b1624; background: rgba(224, 242, 254, 0.8); margin-top: 24px;">
                        <?php echo $texts['noteStatic']; ?>
                    </div>
                </div>
                <div class="tech-card floaty" aria-hidden="true" style="height: 380px; position: relative; overflow: hidden; position: sticky; top: 24px;">
                    <div style="position: absolute; inset: 16px; border: 2px dashed #cbd5e1; border-radius: 16px;"></div>
                    <div style="position: absolute; top: 32px; left: 32px; right: 32px; height: 140px; border-radius: 14px; background: linear-gradient(135deg, #e0f2fe, #e9d5ff);"></div>
                    <div style="position: absolute; top: 190px; left: 32px; right: 32px; height: 60px; border-radius: 14px; background: #0f172a; opacity: 0.95;"></div>
                    <div style="position: absolute; bottom: 28px; left: 32px; width: 130px; height: 48px; border-radius: 14px; background: linear-gradient(120deg, #0ea5e9, #6366f1);"></div>
                    <div style="position: absolute; bottom: 28px; right: 32px; width: 130px; height: 48px; border-radius: 14px; border: 2px solid #0ea5e9;"></div>
                </div>
            </div>

        <?php else: // lakeview-hotel ?>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: start;" class="fade-in-up">
                <div>
                    <div class="pill" style="background: rgba(217, 247, 241, 0.9); color: #0f766e; margin-bottom: 16px;">
                        🏨 <?php echo $texts['demoBadge']; ?> · <?php echo $texts['logicOff']; ?>
                    </div>
                    <h1 style="font-size: 50px; line-height: 1.1; margin: 16px 0 14px; color: #065f46; font-weight: 900; letter-spacing: -0.03em;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color: #0f3f38; line-height: 1.7; max-width: 580px; font-size: 17px; margin-bottom: 24px;">
                        <?php echo $currentLang === 'en'
                            ? 'Minty bright booking layout with room finder and serene accents. All booking buttons and filters are disabled — visual showcase only.'
                            : 'Светлый мятный макет бронирования: подбор номера и спокойные акценты. Все кнопки брони и фильтры отключены — только визуальная витрина.'; ?>
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap; margin: 20px 0 28px;">
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Book now' : 'Забронировать') . ' · ' . $texts['ctaDemo'], 'lakeview'); ?>
                        <?php echo buttonDisabled(($currentLang === 'en' ? 'Check availability' : 'Проверить даты') . ' · ' . $texts['ctaDemo'], 'lakeview'); ?>
                    </div>
                    <div class="section" style="background: rgba(233, 251, 247, 0.8); border-color: rgba(208, 242, 235, 0.6); color: #0f3f38; margin-bottom: 24px;">
                        <h3 style="color: #065f46; margin-bottom: 16px;"><?php echo $currentLang === 'en' ? 'Filters (Static)' : 'Фильтры (статик)'; ?></h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px;">
                            <div style="background: #fff; border: 2px solid rgba(208, 242, 235, 0.8); border-radius: 18px; padding: 16px; text-align: center; font-weight: 600; color: #0f766e;"><?php echo $currentLang === 'en' ? 'Dates' : 'Даты'; ?></div>
                            <div style="background: #fff; border: 2px solid rgba(208, 242, 235, 0.8); border-radius: 18px; padding: 16px; text-align: center; font-weight: 600; color: #0f766e;"><?php echo $currentLang === 'en' ? 'Guests' : 'Гости'; ?></div>
                            <div style="background: #fff; border: 2px solid rgba(208, 242, 235, 0.8); border-radius: 18px; padding: 16px; text-align: center; font-weight: 600; color: #0f766e;"><?php echo $currentLang === 'en' ? 'Purpose' : 'Цель'; ?></div>
                        </div>
                    </div>
                    <div class="note" style="border-color: #14b8a6; color: #0f3f38; background: rgba(217, 247, 241, 0.8); margin-top: 24px;">
                        <?php echo $texts['noteStatic']; ?>
                    </div>
                </div>
                <div class="grid-auto">
                    <div class="lake-room floaty">
                        <strong style="display: block; margin-bottom: 8px; color: #065f46; font-size: 18px;"><?php echo $currentLang === 'en' ? 'Lake View Suite' : 'Номер с видом на озеро'; ?></strong>
                        <p style="margin: 8px 0 16px; color: #0f3f38; line-height: 1.6;"><?php echo $currentLang === 'en' ? 'Panoramic windows, breakfast included, balcony access.' : 'Панорамные окна, завтрак включён, доступ к балкону.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Book suite' : 'Забронировать номер', 'lakeview'); ?>
                    </div>
                    <div class="lake-room">
                        <strong style="display: block; margin-bottom: 8px; color: #065f46; font-size: 18px;"><?php echo $currentLang === 'en' ? 'Family Room' : 'Семейный'; ?></strong>
                        <p style="margin: 8px 0 16px; color: #0f3f38; line-height: 1.6;"><?php echo $currentLang === 'en' ? '2 bedrooms, workspace, kitchenette.' : '2 спальни, рабочая зона, мини-кухня.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Choose dates' : 'Выбрать даты', 'lakeview'); ?>
                    </div>
                    <div class="lake-room">
                        <strong style="display: block; margin-bottom: 8px; color: #065f46; font-size: 18px;"><?php echo $currentLang === 'en' ? 'Workation Studio' : 'Для удалёнки'; ?></strong>
                        <p style="margin: 8px 0 16px; color: #0f3f38; line-height: 1.6;"><?php echo $currentLang === 'en' ? 'Fast Wi‑Fi, desk, coffee corner, quiet zone.' : 'Быстрый Wi‑Fi, стол, кофе-поинт, тихая зона.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Check availability' : 'Проверить наличие', 'lakeview'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Форма в стиле holymedia.kz -->
<section id="contact-form" class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Заголовок с изогнутой стрелкой -->
            <div class="mb-12 md:mb-16">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-extrabold leading-tight tracking-tighter mb-4" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'So, shall we work?' : 'Ну что, работаем?'; ?>
                </h2>
                <svg class="w-32 h-16 md:w-40 md:h-20" style="color: var(--color-text);" viewBox="0 0 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 50 Q 60 20, 120 30 T 180 50" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M170 45 L 180 50 L 170 55" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16 lg:gap-20">
                <!-- Контактная информация слева -->
                <div>
                    <!-- Телефон -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Our phone' : 'Наш телефон'; ?>
                        </h3>
                        <a href="tel:+77772738907" class="text-xl sm:text-2xl md:text-3xl font-bold transition-colors hover:opacity-80" style="color: #f97316;">
                            +7 777 273 89 07
                        </a>
                    </div>

                    <!-- Мессенджеры -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-4" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'You can write!' : 'Написать — можно!'; ?>
                        </h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://wa.me/77772738907" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xl sm:text-2xl font-semibold transition-colors hover:opacity-80" style="color: #f97316;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                WhatsApp
                            </a>
                            <a href="https://t.me/novacreatorstudio" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xl sm:text-2xl font-semibold transition-colors hover:opacity-80" style="color: #f97316;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.12l-6.869 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.566-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                                <?php echo $currentLang === 'en' ? 'Telegram' : 'Телеграм'; ?>
                            </a>
                            <a href="https://www.instagram.com/rocket_holymedia" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-xl sm:text-2xl font-semibold transition-colors hover:opacity-80" style="color: #f97316;">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.246 1.805-.413 2.227-.217.562-.477.96-.896 1.382-.42.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.246-2.236-.413-.569-.224-.96-.479-1.379-.896-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.817.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                                @rocket_holymedia
                            </a>
                        </div>
                    </div>

                    <!-- Адрес -->
                    <div class="mb-8 md:mb-10">
                        <h3 class="text-lg sm:text-xl md:text-2xl font-semibold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Address' : 'Адрес'; ?>
                        </h3>
                        <p class="text-lg sm:text-xl" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en' ? 'Almaty, Begalina st., 103' : 'Алматы, ул. Бегалина, 103'; ?>
                        </p>
                    </div>

                    <!-- Кнопка навигации -->
                    <a href="https://2gis.kz/almaty/search/%D0%90%D0%BB%D0%BC%D0%B0%D1%82%D1%8B%2C%20%D1%83%D0%BB.%20%D0%91%D0%B5%D0%B3%D0%B0%D0%BB%D0%B8%D0%BD%D0%B0%2C%20103" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 border-2 rounded-lg transition-all hover:opacity-80" style="border-color: var(--color-text); background: white;">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#00D26A"/>
                            <path d="M2 17L12 22L22 17V12L12 17L2 12V17Z" fill="#00D26A"/>
                        </svg>
                        <span class="font-semibold" style="color: var(--color-text);"><?php echo $currentLang === 'en' ? 'Open in navigator' : 'Открыть в навигаторе'; ?></span>
                    </a>
                </div>

                <!-- Форма справа -->
                <div>
                    <div class="p-6 md:p-8 rounded-2xl" style="background-color: #d1fae5; border: 1px solid rgba(0,0,0,0.1);">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-8" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Leave a request' : 'Оставить заявку'; ?>
                        </h3>

                        <form class="contact-form space-y-4 md:space-y-6" method="POST" action="/backend/send.php">
                            <input type="hidden" name="type" value="contact">
                            <input type="hidden" name="form_name" value="<?php echo $currentLang === 'en' ? 'Demo Contact Form' : 'Демо форма обратной связи'; ?>">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">

                            <!-- Имя -->
                            <div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="<?php echo $currentLang === 'en' ? 'Ali' : 'Али'; ?>"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors text-base md:text-lg" 
                                    style="background-color: white; border-color: var(--color-text); color: var(--color-text);"
                                    required
                                >
                            </div>

                            <!-- Телефон с флагом -->
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center gap-2 pointer-events-none">
                                    <span class="text-2xl">🇰🇿</span>
                                </div>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    placeholder="+7"
                                    class="w-full px-4 py-3 pl-14 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors text-base md:text-lg" 
                                    style="background-color: white; border-color: var(--color-text); color: var(--color-text);"
                                    pattern="^(\+7|7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$"
                                    required
                                    autocomplete="tel"
                                    maxlength="18"
                                >
                            </div>

                            <!-- Радио-кнопки -->
                            <div class="flex flex-col gap-3">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="messenger" 
                                        checked
                                        class="w-5 h-5"
                                        style="accent-color: #f97316;"
                                    >
                                    <span class="text-base md:text-lg font-medium" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Write in messenger' : 'Написать в мессенджер'; ?>
                                    </span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        name="contact_method" 
                                        value="call"
                                        class="w-5 h-5"
                                        style="accent-color: #000;"
                                    >
                                    <span class="text-base md:text-lg font-medium" style="color: var(--color-text);">
                                        <?php echo $currentLang === 'en' ? 'Call' : 'Позвонить'; ?>
                                    </span>
                                </label>
                            </div>

                            <!-- Кнопка отправки -->
                            <button 
                                type="submit" 
                                class="w-full px-6 py-4 text-base md:text-lg font-semibold rounded-lg transition-all hover:opacity-90 min-h-[48px] md:min-h-[56px]"
                                style="background-color: #f97316; color: white;"
                            >
                                <?php echo $currentLang === 'en' ? 'Send' : 'Отправить'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Форматирование телефона
    const phoneInput = document.querySelector('#contact-form input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d+]/g, '');
            if (value.startsWith('8')) {
                value = '+7' + value.substring(1);
            } else if (value.startsWith('7') && !value.startsWith('+7')) {
                value = '+7' + value.substring(1);
            } else if (!value.startsWith('+7')) {
                value = '+7' + value;
            }
            value = value.substring(0, 12);
            if (value.length > 2) {
                let formatted = value.substring(0, 2) + ' ';
                if (value.length > 2) {
                    formatted += '(' + value.substring(2, 5);
                }
                if (value.length > 5) {
                    formatted += ') ' + value.substring(5, 8);
                }
                if (value.length > 8) {
                    formatted += '-' + value.substring(8, 10);
                }
                if (value.length > 10) {
                    formatted += '-' + value.substring(10, 12);
                }
                e.target.value = formatted;
            } else {
                e.target.value = value;
            }
        });
    }

    // Обработка отправки формы
    const form = document.querySelector('#contact-form .contact-form');
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';

            const formData = new FormData(form);
            
            // Добавляем метод связи в сообщение
            const contactMethod = form.querySelector('input[name="contact_method"]:checked')?.value;
            if (contactMethod) {
                const methodText = contactMethod === 'messenger' 
                    ? '<?php echo $currentLang === 'en' ? 'Preferred contact: messenger' : 'Предпочтительный способ связи: мессенджер'; ?>'
                    : '<?php echo $currentLang === 'en' ? 'Preferred contact: call' : 'Предпочтительный способ связи: звонок'; ?>';
                formData.append('message', methodText);
            }

            try {
                const response = await fetch('/backend/send.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Request sent successfully!' : 'Заявка отправлена успешно!'; ?>');
                    form.reset();
                    // Сбрасываем радио-кнопку на значение по умолчанию
                    const defaultRadio = form.querySelector('input[name="contact_method"][value="messenger"]');
                    if (defaultRadio) defaultRadio.checked = true;
                } else {
                    alert(data.message || '<?php echo $currentLang === 'en' ? 'Error sending request' : 'Ошибка отправки заявки'; ?>');
                }
            } catch (error) {
                alert('<?php echo $currentLang === 'en' ? 'Error sending request' : 'Ошибка отправки заявки'; ?>');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
