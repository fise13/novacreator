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
    'backToPortfolio' => $currentLang === 'en' ? 'Back to home' : 'Назад на главную',
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
                <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/')); ?>" class="active-link">
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

<?php include __DIR__ . '/includes/footer.php'; ?>
