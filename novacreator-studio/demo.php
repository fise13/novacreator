<?php
/**
 * Демо-страницы портфолио: статичные макеты без бизнес-логики
 * Доступ: /demo.php?project={slug}
 */
require_once __DIR__ . '/includes/i18n.php';

$currentLang = getCurrentLanguage();

// Мини-данные для мета-тегов
$demos = [
    'northern-beans' => [
        'title' => [
            'ru' => 'Кофейня “Northern Beans” — демо',
            'en' => 'Coffee shop “Northern Beans” — demo',
        ],
        'description' => [
            'ru' => 'Статичный макет кофейни: меню, атмосфера, кнопки отключены.',
            'en' => 'Static coffee shop mockup: menu and vibe, buttons disabled.',
        ],
    ],
    'bodycraft' => [
        'title' => [
            'ru' => 'Персональный тренер “BodyCraft” — демо',
            'en' => 'Personal trainer “BodyCraft” — demo',
        ],
        'description' => [
            'ru' => 'Неоновый лендинг тренера: до/после и квиз-плейсхолдер. Логики нет.',
            'en' => 'Neon trainer landing: before/after and quiz placeholders. Logic off.',
        ],
    ],
    'urbanframe' => [
        'title' => [
            'ru' => 'Застройщик “UrbanFrame” — демо',
            'en' => 'Developer “UrbanFrame” — demo',
        ],
        'description' => [
            'ru' => 'Лендинг строительства с дорожной картой и ценой. CTA выключены.',
            'en' => 'Construction landing with roadmap and pricing. CTAs disabled.',
        ],
    ],
    'technest' => [
        'title' => [
            'ru' => 'Интернет-магазин “TechNest” — демо',
            'en' => 'E‑commerce “TechNest” — demo',
        ],
        'description' => [
            'ru' => 'Каталог, PDP и корзина в статике. Оплаты и формы отключены.',
            'en' => 'Catalog, PDP and cart in static. Payments/forms are off.',
        ],
    ],
    'lakeview-hotel' => [
        'title' => [
            'ru' => 'Бутик-отель “Lakeview” — демо',
            'en' => 'Boutique hotel “Lakeview” — demo',
        ],
        'description' => [
            'ru' => 'Подбор номеров, фильтры и карта как витрина. Бронь не работает.',
            'en' => 'Rooms, filters and map as a showcase. Booking disabled.',
        ],
    ],
];

$projectId = $_GET['project'] ?? 'northern-beans';
$projectId = is_string($projectId) ? trim($projectId) : 'northern-beans';
$notFound = false;

if (!isset($demos[$projectId])) {
    http_response_code(404);
    $projectId = 'northern-beans';
    $notFound = true;
}

$demo = $demos[$projectId];

$pageTitle = ($currentLang === 'en' ? 'Demo layout: ' : 'Демо: ') . ($demo['title'][$currentLang] ?? $projectId);
$pageMetaTitle = $pageTitle;
$pageMetaDescription = $demo['description'][$currentLang] ?? '';

// Общие тексты
$backToPortfolio = $currentLang === 'en' ? 'Back to portfolio' : 'Назад к портфолио';
$logicOff = $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена';
$demoBadge = $currentLang === 'en' ? 'Demo layout' : 'Демо-макет';
$noteStatic = $currentLang === 'en'
    ? 'All buttons and forms are intentionally disabled. This is a visual mockup.'
    : 'Все кнопки и формы намеренно отключены. Это визуальный макет.';
$ctaDemo = $currentLang === 'en' ? 'demo' : 'демо';
$notFoundText = $currentLang === 'en'
    ? 'Demo not found, showing coffee shop mockup.'
    : 'Демо не найдено, показываем макет кофейни.';

include __DIR__ . '/includes/header.php';

function buttonDisabled(string $label): string {
    return '<button type="button" class="btn-disabled" disabled aria-disabled="true">' . htmlspecialchars($label) . '</button>';
}
?>

<style>
    /* Общие утилиты */
    :root { --shadow-soft: 0 18px 50px rgba(0,0,0,0.22); }
    .demo-layout { min-height: 100vh; }
    .demo-nav {
        display:flex; align-items:center; justify-content:space-between;
        padding:14px 22px; border-radius:14px; margin-bottom:20px;
        border:1px solid rgba(255,255,255,0.06); background:rgba(12,12,16,0.5);
        backdrop-filter: blur(14px);
    }
    .demo-brand { display:flex; align-items:center; gap:10px; font-weight:700; }
    .demo-links { display:flex; gap:14px; flex-wrap:wrap; }
    .demo-links a { text-decoration:none; font-weight:600; }
    .btn-disabled {
        padding:12px 18px; border-radius:12px; border:none; cursor:not-allowed;
        font-weight:700; letter-spacing:0.01em; opacity:0.7;
    }
    .pill {
        display:inline-flex; align-items:center; gap:6px; padding:8px 12px;
        border-radius:999px; font-weight:600; font-size:12px; letter-spacing:0.04em;
    }
    .grid-auto { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:16px; }
    .section {
        border-radius:18px; padding:22px; border:1px solid rgba(255,255,255,0.08);
        background:rgba(255,255,255,0.03); box-shadow:var(--shadow-soft);
    }
    .section h3 { margin:0 0 8px; font-size:20px; }
    .section p { margin:0 0 12px; line-height:1.6; }
    .note { margin-top:14px; padding:12px 14px; border-radius:12px; font-size:14px; border:1px dashed rgba(255,255,255,0.25); }
    @keyframes floaty { 0% {transform:translateY(0);} 50% {transform:translateY(-8px);} 100% {transform:translateY(0);} }
    @keyframes pulse { 0% {opacity:0.45;} 50% {opacity:1;} 100% {opacity:0.45;} }
    .floaty { animation: floaty 6s ease-in-out infinite; }
    .pulse { animation: pulse 3s ease-in-out infinite; }

    /* Beans */
    .shell-beans { background: radial-gradient(circle at 10% 20%, rgba(255,214,170,0.35), transparent 40%), #f7f4ef; color:#0f0f10; }
    .beans-nav { background:#fff7ed; border-color:#fbd6a0; }
    .beans-btn-main { background:linear-gradient(120deg,#fbbf24,#f97316); color:#2c1400; }
    .beans-btn-ghost { background:#fff; color:#9a4b12; border:1px solid #fbbf24; }
    .beans-tag { background:#fff7ed; color:#9a4b12; }

    /* BodyCraft */
    .shell-body { background: radial-gradient(circle at 20% 30%, rgba(34,197,94,0.18), transparent 40%), #0b0f13; color:#e5e7eb; }
    .body-nav { background:rgba(12,18,22,0.9); border-color:rgba(34,197,94,0.35); }
    .body-btn-main { background:linear-gradient(120deg,#22c55e,#16a34a); color:#041007; }
    .body-btn-ghost { background:transparent; color:#9be6b8; border:1px solid rgba(34,197,94,0.55); }
    .body-progress { height:8px; border-radius:999px; background:rgba(255,255,255,0.08); overflow:hidden; }
    .body-progress span { display:block; height:100%; background:linear-gradient(90deg,#22c55e,#4ade80); width:70%; }

    /* UrbanFrame */
    .shell-urban { background: radial-gradient(circle at 70% 20%, rgba(249,115,22,0.2), transparent 45%), #0f1115; color:#f3f4f6; }
    .urban-nav { background:#1a1d24; border-color:rgba(249,115,22,0.35); }
    .urban-road { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:12px; }
    .urban-step { background:#141821; border:1px solid rgba(255,255,255,0.05); border-radius:14px; padding:14px; position:relative; }
    .urban-step::after { content:''; position:absolute; inset:0; border-radius:14px; border:1px dashed rgba(249,115,22,0.35); pointer-events:none; }
    .urban-btn-main { background:linear-gradient(120deg,#f97316,#f59e0b); color:#0f0f10; }
    .urban-btn-ghost { background:transparent; color:#fbbf24; border:1px solid rgba(249,115,22,0.5); }

    /* TechNest */
    .shell-tech { background: radial-gradient(circle at 25% 10%, rgba(99,102,241,0.16), transparent 40%), #f2f7fb; color:#0b1624; }
    .tech-nav { background:#ffffff; border:1px solid #e2e8f0; box-shadow:0 18px 50px rgba(14,165,233,0.08); }
    .tech-card { background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:18px; }
    .tech-badge { background:#e0f2fe; color:#0ea5e9; }
    .tech-btn-main { background:linear-gradient(120deg,#0ea5e9,#6366f1); color:white; }
    .tech-btn-ghost { background:#fff; border:1px solid #0ea5e9; color:#0ea5e9; }

    /* Lakeview */
    .shell-lake { background: radial-gradient(circle at 80% 10%, rgba(20,184,166,0.2), transparent 45%), #f1fbf8; color:#07312b; }
    .lake-nav { background:#ffffff; border:1px solid #d0f2eb; box-shadow:0 18px 50px rgba(20,184,166,0.12); }
    .lake-btn-main { background:linear-gradient(120deg,#14b8a6,#06b6d4); color:white; }
    .lake-btn-ghost { background:#fff; border:1px solid #14b8a6; color:#0f766e; }
    .lake-room { background:linear-gradient(135deg, rgba(20,184,166,0.12), rgba(6,182,212,0.12)); border:1px solid rgba(20,184,166,0.25); border-radius:14px; padding:14px; }
</style>

<main class="demo-layout">
    <?php if ($projectId === 'northern-beans'): ?>
        <div class="shell-beans" style="padding:42px 20px 56px;">
            <div class="demo-nav beans-nav">
                <div class="demo-brand">
                    <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#f59e0b,#fbbf24);display:inline-block;"></span>
                    <span>Northern Beans</span>
                </div>
                <div class="demo-links">
                    <a href="#" style="color:#9a4b12; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Menu' : 'Меню'; ?></a>
                    <a href="#" style="color:#9a4b12; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Story' : 'История'; ?></a>
                    <a href="#" style="color:#9a4b12; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Map' : 'Карта'; ?></a>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" style="color:#9a4b12;"><?php echo $backToPortfolio; ?></a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1.2fr 1fr; gap:18px; align-items:center;">
                <div>
                    <div class="pill beans-tag">
                        <span aria-hidden="true">☕</span><?php echo $demoBadge; ?> · <?php echo $logicOff; ?>
                    </div>
                    <h1 style="font-size:44px; line-height:1.1; margin:10px 0; color:#1f1307;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color:#4b2b12; line-height:1.6; max-width:540px;">
                        <?php echo $currentLang === 'en'
                            ? 'Warm coffee shop landing with sunny highlights. Buttons are decorative only.'
                            : 'Тёплый лендинг кофейни с солнечными акцентами. Кнопки только декоративные.'; ?>
                    </p>
                    <div style="display:flex; gap:12px; flex-wrap:wrap; margin:14px 0 18px;">
                        <button class="btn-disabled beans-btn-main" aria-disabled="true">
                            <?php echo $currentLang === 'en' ? 'Order for pickup' : 'Заказать к приезду'; ?> · <?php echo $ctaDemo; ?>
                        </button>
                        <button class="btn-disabled beans-btn-ghost" aria-disabled="true">
                            <?php echo $currentLang === 'en' ? 'See beans' : 'Выбрать зерно'; ?> · <?php echo $ctaDemo; ?>
                        </button>
                    </div>
                    <div class="grid-auto">
                        <div style="background:#fff; border:1px solid #f1e3d2; border-radius:18px; padding:20px; box-shadow:0 18px 50px rgba(108,68,28,0.12);" class="floaty">
                            <strong><?php echo $currentLang === 'en' ? 'Seasonal menu' : 'Сезонное меню'; ?></strong>
                            <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Pumpkin latte, cold brew, signature desserts.' : 'Тыковка латте, колд-брю и фирменные десерты.'; ?></p>
                            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                <span class="pill beans-tag">V60</span>
                                <span class="pill beans-tag">Cold brew</span>
                                <span class="pill beans-tag">Desserts</span>
                            </div>
                        </div>
                        <div style="background:#fff; border:1px solid #f1e3d2; border-radius:18px; padding:20px; box-shadow:0 18px 50px rgba(108,68,28,0.12);">
                            <strong><?php echo $currentLang === 'en' ? 'Atmosphere' : 'Атмосфера'; ?></strong>
                            <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Vinyl, wooden bar, sunny window seats.' : 'Винил, деревянный бар, солнечные подоконники.'; ?></p>
                            <?php echo buttonDisabled($currentLang === 'en' ? 'Book a table' : 'Забронировать стол'); ?>
                        </div>
                        <div style="background:#fff; border:1px solid #f1e3d2; border-radius:18px; padding:20px; box-shadow:0 18px 50px rgba(108,68,28,0.12);">
                            <strong><?php echo $currentLang === 'en' ? 'Location' : 'Локация'; ?></strong>
                            <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Old town, 2 min from the park.' : 'Старый центр, 2 минуты от парка.'; ?></p>
                            <div class="pill beans-tag pulse"><?php echo $currentLang === 'en' ? 'Map placeholder' : 'Карта-плейсхолдер'; ?></div>
                        </div>
                    </div>
                    <div class="note" style="border-color:#fbbf24; color:#5b3417; background:#fff7ed;">
                        <?php echo $noteStatic; ?>
                    </div>
                </div>
                <div style="background:#fff; border:1px solid #f1e3d2; border-radius:18px; padding:20px; box-shadow:0 18px 50px rgba(108,68,28,0.12);" class="floaty" aria-hidden="true">
                    <div style="height:280px; border-radius:14px; background:linear-gradient(135deg,#fcd34d,#f59e0b); position:relative; overflow:hidden;">
                        <div style="position:absolute; inset:12px; border-radius:12px; background:#fff6eb; border:1px solid #f3e0c7;"></div>
                        <div style="position:absolute; top:30px; left:28px; background:#fff; padding:12px 14px; border-radius:12px; box-shadow:0 10px 30px rgba(244,160,10,0.25); color:#7c3b0c;">
                            <?php echo $currentLang === 'en' ? 'Latte Art Class' : 'Мастер-класс латте-арт'; ?>
                        </div>
                        <div style="position:absolute; bottom:26px; right:24px; background:#111827; color:#fff; padding:10px 14px; border-radius:10px;">
                            <?php echo $currentLang === 'en' ? 'Order in 12 min' : 'Готово за 12 мин'; ?>
                        </div>
                        <div style="position:absolute; bottom:18px; left:24px; width:90px; height:36px; background:#fef3c7; border-radius:12px; border:1px dashed #f59e0b;"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($projectId === 'bodycraft'): ?>
        <div class="shell-body" style="padding:44px 20px 60px;">
            <div class="demo-nav body-nav">
                <div class="demo-brand">
                    <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#22c55e,#0ea5e9);display:inline-block;"></span>
                    <span>BodyCraft</span>
                </div>
                <div class="demo-links">
                    <a href="#" style="color:#9be6b8; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Programs' : 'Программы'; ?></a>
                    <a href="#" style="color:#9be6b8; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Results' : 'Результаты'; ?></a>
                    <a href="#" style="color:#9be6b8; pointer-events:none;">FAQ</a>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" style="color:#9be6b8;"><?php echo $backToPortfolio; ?></a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:center;">
                <div style="background:linear-gradient(135deg, rgba(34,197,94,0.08), rgba(59,130,246,0.08)); border:1px solid rgba(255,255,255,0.06); border-radius:18px; padding:20px;">
                    <div class="pill" style="background:rgba(34,197,94,0.12); color:#bbf7d0;">
                        <span>🏋️</span><?php echo $demoBadge; ?> · <?php echo $logicOff; ?>
                    </div>
                    <h1 style="font-size:42px; line-height:1.1; margin:12px 0 10px; color:#e7ffee;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color:#c0ead1; line-height:1.6; max-width:520px;">
                        <?php echo $currentLang === 'en'
                            ? 'High-contrast neon landing with strong CTA blocks. Forms are placeholders.'
                            : 'Неоновый лендинг с яркими CTA. Формы и кнопки — плейсхолдеры.'; ?>
                    </p>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 18px;">
                        <button class="btn-disabled body-btn-main"><?php echo $currentLang === 'en' ? 'Start program' : 'Начать программу'; ?> · <?php echo $ctaDemo; ?></button>
                        <button class="btn-disabled body-btn-ghost"><?php echo $currentLang === 'en' ? 'See plan' : 'Посмотреть план'; ?> · <?php echo $ctaDemo; ?></button>
                    </div>
                    <div class="body-progress" aria-hidden="true"><span></span></div>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:10px; margin-top:14px;">
                        <div class="section" style="background:rgba(255,255,255,0.02); border-color:rgba(34,197,94,0.25);">
                            <strong><?php echo $currentLang === 'en' ? 'Before / After' : 'До / После'; ?></strong>
                            <p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Progress tiles with inert toggles.' : 'Карточки прогресса с неактивными тогглами.'; ?></p>
                        </div>
                        <div class="section" style="background:rgba(59,130,246,0.08); border-color:rgba(59,130,246,0.25);">
                            <strong><?php echo $currentLang === 'en' ? 'Lead quiz' : 'Квиз-лид'; ?></strong>
                            <p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? '3 steps, disabled submit.' : '3 шага, отправка отключена.'; ?></p>
                        </div>
                        <div class="section" style="background:rgba(34,197,94,0.08); border-color:rgba(34,197,94,0.25);">
                            <strong><?php echo $currentLang === 'en' ? 'USP' : 'УТП'; ?></strong>
                            <p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Clear offer: 3 workouts/week, 40 min.' : 'Чёткий оффер: 3 тренировки в неделю, 40 минут.'; ?></p>
                        </div>
                    </div>
                    <div class="note" style="border-color:rgba(34,197,94,0.45); background:rgba(34,197,94,0.1); color:#bbf7d0;">
                        <?php echo $noteStatic; ?>
                    </div>
                </div>
                <div class="section floaty" style="background:linear-gradient(135deg, rgba(34,197,94,0.08), rgba(59,130,246,0.08)); border-color:rgba(255,255,255,0.08);">
                    <div style="height:260px; border-radius:16px; background:#0f172a; border:1px solid rgba(255,255,255,0.08); position:relative; overflow:hidden;">
                        <div style="position:absolute; inset:14px; border-radius:12px; border:1px dashed rgba(59,130,246,0.4);"></div>
                        <div style="position:absolute; top:22px; left:22px; padding:10px 12px; border-radius:10px; background:rgba(34,197,94,0.2); color:#bbf7d0;">Before</div>
                        <div style="position:absolute; top:22px; right:22px; padding:10px 12px; border-radius:10px; background:rgba(59,130,246,0.2); color:#c7d9ff;">After</div>
                        <div style="position:absolute; bottom:30px; left:22px; right:22px; height:54px; border-radius:12px; background:linear-gradient(90deg, rgba(34,197,94,0.4), rgba(59,130,246,0.4));"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($projectId === 'urbanframe'): ?>
        <div class="shell-urban" style="padding:46px 20px 64px;">
            <div class="demo-nav urban-nav">
                <div class="demo-brand">
                    <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#f97316,#f59e0b);display:inline-block;"></span>
                    <span>UrbanFrame</span>
                </div>
                <div class="demo-links">
                    <a href="#" style="color:#fbbf24; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Roadmap' : 'Дорожная карта'; ?></a>
                    <a href="#" style="color:#fbbf24; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Pricing' : 'Стоимость'; ?></a>
                    <a href="#" style="color:#fbbf24; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Guarantees' : 'Гарантии'; ?></a>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" style="color:#fbbf24;"><?php echo $backToPortfolio; ?></a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1.1fr; gap:18px; align-items:center;">
                <div>
                    <div class="pill" style="background:rgba(249,115,22,0.12); color:#fbbf24;">
                        🏗️ <?php echo $demoBadge; ?> · <?php echo $logicOff; ?>
                    </div>
                    <h1 style="font-size:42px; line-height:1.15; margin:12px 0 10px; color:#fef3c7;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color:#e5e7eb; line-height:1.6; max-width:540px;">
                        <?php echo $currentLang === 'en'
                            ? 'Structured construction landing with step timeline and price breakdown. All CTAs inert.'
                            : 'Структурный лендинг строительства: таймлайн шагов и цена по этапам. Все CTA неактивны.'; ?>
                    </p>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 18px;">
                        <button class="btn-disabled urban-btn-main"><?php echo $currentLang === 'en' ? 'Calculate cost' : 'Рассчитать стоимость'; ?> · <?php echo $ctaDemo; ?></button>
                        <button class="btn-disabled urban-btn-ghost"><?php echo $currentLang === 'en' ? 'See estimates' : 'Посмотреть смету'; ?> · <?php echo $ctaDemo; ?></button>
                    </div>

                    <div class="urban-road">
                        <?php
                        $steps = [
                            ['title' => $currentLang === 'en' ? 'Survey & soil' : 'Замер и грунт', 'desc' => $currentLang === 'en' ? 'Lot scan, soil tests.' : 'Скан участка, грунт.'],
                            ['title' => $currentLang === 'en' ? 'Design' : 'Проект', 'desc' => $currentLang === 'en' ? 'Concept + drawings.' : 'Концепт + чертежи.'],
                            ['title' => $currentLang === 'en' ? 'Build' : 'Стройка', 'desc' => $currentLang === 'en' ? 'Foundation, frame, engineering.' : 'Фундамент, коробка, инженерка.'],
                            ['title' => $currentLang === 'en' ? 'Handover' : 'Сдача', 'desc' => $currentLang === 'en' ? 'Finishings, keys, warranty.' : 'Отделка, ключи, гарантия.'],
                        ];
                        foreach ($steps as $step):
                        ?>
                            <div class="urban-step">
                                <strong><?php echo htmlspecialchars($step['title']); ?></strong>
                                <p style="color:#d1d5db;"><?php echo htmlspecialchars($step['desc']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="note" style="border-color:rgba(249,115,22,0.45); background:rgba(249,115,22,0.08); color:#fde68a;">
                        <?php echo $noteStatic; ?>
                    </div>
                </div>
                <div style="background:linear-gradient(135deg, rgba(249,115,22,0.12), rgba(248,180,56,0.12)); border:1px solid rgba(249,115,22,0.35); border-radius:16px; padding:18px;" class="floaty">
                    <h3 style="margin:0 0 8px; color:#fcd34d;"><?php echo $currentLang === 'en' ? 'Price breakdown' : 'Разбивка цены'; ?></h3>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:10px;">
                        <div style="background:rgba(0,0,0,0.2); padding:12px; border-radius:12px;">
                            <strong><?php echo $currentLang === 'en' ? 'Foundation' : 'Фундамент'; ?></strong>
                            <p style="margin:6px 0 0; color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Slab + piles' : 'Плита + сваи'; ?></p>
                        </div>
                        <div style="background:rgba(0,0,0,0.2); padding:12px; border-radius:12px;">
                            <strong><?php echo $currentLang === 'en' ? 'Frame' : 'Коробка'; ?></strong>
                            <p style="margin:6px 0 0; color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Walls, roof' : 'Стены, крыша'; ?></p>
                        </div>
                        <div style="background:rgba(0,0,0,0.2); padding:12px; border-radius:12px;">
                            <strong><?php echo $currentLang === 'en' ? 'Engineering' : 'Инженерка'; ?></strong>
                            <p style="margin:6px 0 0; color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'HVAC, power, water' : 'ОВиК, электрика, вода'; ?></p>
                        </div>
                    </div>
                    <div class="pill" style="background:rgba(255,255,255,0.06); color:#fbbf24; margin-top:12px; display:inline-flex;">
                        <?php echo $currentLang === 'en' ? 'Guarantee & docs placeholders' : 'Гарантии и документы — плейсхолдеры'; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($projectId === 'technest'): ?>
        <div class="shell-tech" style="padding:40px 20px 60px;">
            <div class="demo-nav tech-nav">
                <div class="demo-brand">
                    <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#0ea5e9,#6366f1);display:inline-block;"></span>
                    <span>TechNest</span>
                </div>
                <div class="demo-links">
                    <a href="#" style="color:#0ea5e9; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Catalog' : 'Каталог'; ?></a>
                    <a href="#" style="color:#0ea5e9; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Deals' : 'Акции'; ?></a>
                    <a href="#" style="color:#0ea5e9; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Support' : 'Поддержка'; ?></a>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" style="color:#0ea5e9;"><?php echo $backToPortfolio; ?></a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1.1fr 1fr; gap:18px; align-items:center;">
                <div>
                    <div class="pill tech-badge">
                        🛒 <?php echo $demoBadge; ?> · <?php echo $logicOff; ?>
                    </div>
                    <h1 style="font-size:42px; line-height:1.1; margin:12px 0 10px; color:#0b1624;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color:#334155; line-height:1.6; max-width:540px;">
                        <?php echo $currentLang === 'en'
                            ? 'Clean tech store layout: catalog, PDP and cart — all frozen for demo.'
                            : 'Чистый магазин: каталог, карточка товара и корзина — всё заморожено.'; ?>
                    </p>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 18px;">
                        <button class="btn-disabled tech-btn-main"><?php echo $currentLang === 'en' ? 'Add to cart' : 'В корзину'; ?> · <?php echo $ctaDemo; ?></button>
                        <button class="btn-disabled tech-btn-ghost"><?php echo $currentLang === 'en' ? 'Buy now' : 'Купить сейчас'; ?> · <?php echo $ctaDemo; ?></button>
                    </div>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:12px;">
                        <div class="tech-card">
                            <strong><?php echo $currentLang === 'en' ? 'Filters' : 'Фильтры'; ?></strong>
                            <p style="color:#475569;"><?php echo $currentLang === 'en' ? 'Brand, price, spec toggles — inert.' : 'Бренд, цена, характеристики — неактивны.'; ?></p>
                        </div>
                        <div class="tech-card">
                            <strong><?php echo $currentLang === 'en' ? 'Product card' : 'Карточка товара'; ?></strong>
                            <p style="color:#475569;"><?php echo $currentLang === 'en' ? 'Gallery, specs, recommendations placeholder.' : 'Галерея, спеки, рекомендации — плейсхолдер.'; ?></p>
                        </div>
                        <div class="tech-card">
                            <strong><?php echo $currentLang === 'en' ? 'Cart / Checkout' : 'Корзина / Чекаут'; ?></strong>
                            <p style="color:#475569;"><?php echo $currentLang === 'en' ? 'Totals and steps are visual only.' : 'Итоги и шаги только визуально.'; ?></p>
                        </div>
                    </div>
                    <div class="note" style="border-color:#0ea5e9; color:#0b1624; background:#e0f2fe;">
                        <?php echo $noteStatic; ?>
                    </div>
                </div>
                <div class="tech-card floaty" aria-hidden="true" style="height:320px; position:relative; overflow:hidden;">
                    <div style="position:absolute; inset:12px; border:1px dashed #cbd5e1; border-radius:14px;"></div>
                    <div style="position:absolute; top:26px; left:26px; right:26px; height:110px; border-radius:12px; background:linear-gradient(135deg,#e0f2fe,#e9d5ff);"></div>
                    <div style="position:absolute; top:150px; left:26px; right:26px; height:50px; border-radius:12px; background:#0f172a; opacity:0.9;"></div>
                    <div style="position:absolute; bottom:24px; left:26px; width:120px; height:44px; border-radius:12px; background:linear-gradient(120deg,#0ea5e9,#6366f1);"></div>
                    <div style="position:absolute; bottom:24px; right:26px; width:120px; height:44px; border-radius:12px; border:1px solid #0ea5e9;"></div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="shell-lake" style="padding:42px 20px 60px;">
            <div class="demo-nav lake-nav">
                <div class="demo-brand">
                    <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#14b8a6,#06b6d4);display:inline-block;"></span>
                    <span>Lakeview Hotel</span>
                </div>
                <div class="demo-links">
                    <a href="#" style="color:#0f766e; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Rooms' : 'Номера'; ?></a>
                    <a href="#" style="color:#0f766e; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Experience' : 'Опыт'; ?></a>
                    <a href="#" style="color:#0f766e; pointer-events:none;"><?php echo $currentLang === 'en' ? 'Map' : 'Карта'; ?></a>
                    <a href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>" style="color:#0f766e;"><?php echo $backToPortfolio; ?></a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; align-items:center;">
                <div>
                    <div class="pill" style="background:#d9f7f1; color:#0f766e;">
                        🏨 <?php echo $demoBadge; ?> · <?php echo $logicOff; ?>
                    </div>
                    <h1 style="font-size:42px; line-height:1.1; margin:12px 0 10px; color:#065f46;">
                        <?php echo htmlspecialchars($demo['title'][$currentLang]); ?>
                    </h1>
                    <p style="color:#0f3f38; line-height:1.6; max-width:540px;">
                        <?php echo $currentLang === 'en'
                            ? 'Minty bright booking layout with room finder and serene accents. Buttons are disabled.'
                            : 'Светлый мятный макет бронирования: подбор номера и спокойные акценты. Кнопки отключены.'; ?>
                    </p>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 18px;">
                        <button class="btn-disabled lake-btn-main"><?php echo $currentLang === 'en' ? 'Book now' : 'Забронировать'; ?> · <?php echo $ctaDemo; ?></button>
                        <button class="btn-disabled lake-btn-ghost"><?php echo $currentLang === 'en' ? 'Check availability' : 'Проверить даты'; ?> · <?php echo $ctaDemo; ?></button>
                    </div>
                    <div class="section" style="background:#e9fbf7; border-color:#d0f2eb; color:#0f3f38;">
                        <h3><?php echo $currentLang === 'en' ? 'Filters (static)' : 'Фильтры (статик)'; ?></h3>
                        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:10px;">
                            <div style="background:#fff; border:1px solid #d0f2eb; border-radius:18px; padding:14px;"><?php echo $currentLang === 'en' ? 'Dates' : 'Даты'; ?></div>
                            <div style="background:#fff; border:1px solid #d0f2eb; border-radius:18px; padding:14px;"><?php echo $currentLang === 'en' ? 'Guests' : 'Гости'; ?></div>
                            <div style="background:#fff; border:1px solid #d0f2eb; border-radius:18px; padding:14px;"><?php echo $currentLang === 'en' ? 'Purpose' : 'Цель'; ?></div>
                        </div>
                    </div>
                    <div class="note" style="border-color:#14b8a6; color:#0f3f38; background:#d9f7f1;">
                        <?php echo $noteStatic; ?>
                    </div>
                </div>
                <div class="grid-auto">
                    <div class="lake-room floaty">
                        <strong><?php echo $currentLang === 'en' ? 'Lake view suite' : 'Номер с видом на озеро'; ?></strong>
                        <p style="margin:6px 0 10px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Panoramic windows, breakfast included.' : 'Панорамные окна, завтрак включён.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Book suite' : 'Забронировать номер'); ?>
                    </div>
                    <div class="lake-room">
                        <strong><?php echo $currentLang === 'en' ? 'Family room' : 'Семейный'; ?></strong>
                        <p style="margin:6px 0 10px; color:#0f3f38;"><?php echo $currentLang === 'en' ? '2 bedrooms, workspace.' : '2 спальни, рабочая зона.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Choose dates' : 'Выбрать даты'); ?>
                    </div>
                    <div class="lake-room">
                        <strong><?php echo $currentLang === 'en' ? 'Workation studio' : 'Для удалёнки'; ?></strong>
                        <p style="margin:6px 0 10px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Fast Wi‑Fi, desk, coffee corner.' : 'Быстрый Wi‑Fi, стол, кофе-поинт.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Check availability' : 'Проверить наличие'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($notFound): ?>
        <div class="note" style="margin: 16px 20px;">
            <?php echo $notFoundText; ?>
        </div>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

