<?php
$pageTitle = 'UrbanFrame — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Construction landing demo: roadmap, price breakdown, disabled CTAs.';
$ASSET_BASE_OVERRIDE = ''; // грузим ассеты из корня
require_once __DIR__ . '/../../includes/header.php';
$currentLang = getCurrentLanguage();
$back = getLocalizedUrl($currentLang, '/portfolio');
$ctaDemo = $currentLang === 'en' ? 'demo' : 'демо';
$badge = $currentLang === 'en' ? 'Demo layout' : 'Демо-макет';
$logicOff = $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена';
$note = $currentLang === 'en'
    ? 'All buttons and links are inert; this is a visual prototype.'
    : 'Все кнопки и ссылки неактивны; это визуальный прототип.';
?>

<style>
    /* Компактный header для демо и скрытие боевых пунктов */
    #mainNavbar { padding-top: 0 !important; padding-bottom: 0 !important; }
    #mainNavbar .container { padding-top: 8px; padding-bottom: 8px; }
    #mainNavbar .flex.items-center.justify-between { height: 62px !important; }
    #mainNavbar img { width: 40px !important; height: 40px !important; }
    #mainNavbar span.text-gradient { font-size: 1.05rem !important; }
    #mainNavbar .nav-link,
    #mainNavbar [role="menubar"],
    #mainNavbar #accountMenuBtn,
    #mainNavbar #accountMenu,
    #mainNavbar #mobileMenuBtn,
    #mainNavbar #mobileMenu,
    #mainNavbar #mobileMenuOverlay,
    #mainNavbar .flex.items-center.space-x-1,
    #mainNavbar .relative.inline-flex.items-center.justify-center.px-5.py-2 { display:none !important; }

    :root { --bg: #0f1115; --accent: #f97316; --accent2: #f59e0b; }
    .shell { background: radial-gradient(circle at 70% 20%, rgba(249,115,22,0.2), transparent 45%), var(--bg); color:#f5f5f5; }
    .container { max-width: 1220px; margin:0 auto; padding:90px 20px 100px; }
    .nav { display:flex; justify-content:space-between; align-items:center; background:#1a1d24; border:1px solid rgba(249,115,22,0.35); border-radius:16px; padding:14px 18px; box-shadow:0 20px 60px rgba(0,0,0,0.4); }
    .brand { display:flex; align-items:center; gap:10px; font-weight:800; }
    .links { display:flex; gap:12px; flex-wrap:wrap; }
    .links a { color:#fbbf24; text-decoration:none; font-weight:700; }
    .links a.off { pointer-events:none; opacity:.55; }
    .hero { display:grid; grid-template-columns:1fr 1.05fr; gap:22px; align-items:center; margin-top:28px; }
    .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:rgba(249,115,22,0.12); color:#fbbf24; font-weight:700; }
    .title { font-size:44px; line-height:1.1; margin:12px 0 10px; color:#fef3c7; }
    .lead { color:#e5e7eb; line-height:1.65; max-width:560px; }
    .btn { border:none; border-radius:12px; padding:12px 16px; font-weight:800; cursor:not-allowed; opacity:.82; }
    .btn-main { background:linear-gradient(120deg,#f97316,#f59e0b); color:#0f0f10; }
    .btn-ghost { background:transparent; border:1px solid rgba(249,115,22,0.5); color:#fbbf24; }
    .road { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; margin-top:16px; }
    .step { background:#141821; border:1px solid rgba(255,255,255,0.06); border-radius:14px; padding:14px; position:relative; }
    .step::after { content:''; position:absolute; inset:0; border-radius:14px; border:1px dashed rgba(249,115,22,0.35); pointer-events:none; }
    .pricing { background:linear-gradient(135deg, rgba(249,115,22,0.12), rgba(248,180,56,0.12)); border:1px solid rgba(249,115,22,0.35); border-radius:16px; padding:18px; box-shadow:0 18px 50px rgba(0,0,0,0.35); }
    .note { margin-top:16px; padding:14px; border-radius:14px; border:1px dashed rgba(249,115,22,0.45); background:rgba(249,115,22,0.08); color:#fde68a; }
    .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; margin-top:14px; }
    .card { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:14px; }
    .floaty { animation: floaty 7s ease-in-out infinite; }
    @keyframes floaty { 0%{transform:translateY(0);} 50%{transform:translateY(-10px);} 100%{transform:translateY(0);} }

    /* Дополнения */
    .section-block { margin-top: 44px; }
    .kpi-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .kpi-card { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:14px; }
    .kpi-value { font-size:32px; font-weight:800; color:#fbbf24; }
    .screen-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; }
    .screen { background:rgba(255,255,255,0.03); border:1px dashed rgba(249,115,22,0.35); border-radius:14px; padding:14px; min-height:150px; }
    .flow { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .flow-step { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:14px; }
    .faq { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; }
    .faq-item { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:14px; }
</style>

<main class="shell">
    <div class="container">
        <nav class="nav">
            <div class="brand">
                <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#f97316,#f59e0b);display:inline-block;"></span>
                <span>UrbanFrame</span>
            </div>
            <div class="links">
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Roadmap' : 'Дорожная карта'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Pricing' : 'Стоимость'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Guarantees' : 'Гарантии'; ?></a>
                <a href="<?php echo htmlspecialchars($back); ?>"><?php echo $backToPortfolio; ?></a>
            </div>
        </nav>

        <section class="hero">
            <div>
                <div class="pill">🏗️ <?php echo $badge; ?> · <?php echo $logicOff; ?></div>
                <h1 class="title"><?php echo $currentLang === 'en' ? 'Developer landing with transparent steps' : 'Лендинг застройщика с прозрачными этапами'; ?></h1>
                <p class="lead">
                    <?php echo $currentLang === 'en'
                        ? 'Timeline of 4 stages, price breakdown, trust badges. CTAs are disabled to keep demo safe.'
                        : 'Таймлайн из 4 этапов, разбивка цены, бейджи доверия. CTA отключены для безопасного демо.'; ?>
                </p>
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 16px;">
                    <button class="btn btn-main"><?php echo $currentLang === 'en' ? 'Calculate cost' : 'Рассчитать стоимость'; ?> · <?php echo $ctaDemo; ?></button>
                    <button class="btn btn-ghost"><?php echo $currentLang === 'en' ? 'See estimates' : 'Посмотреть смету'; ?> · <?php echo $ctaDemo; ?></button>
                </div>

                <div class="road">
                    <?php
                    $steps = [
                        ['title' => $currentLang === 'en' ? 'Survey & soil' : 'Замер и грунт', 'desc' => $currentLang === 'en' ? 'Lot scan, soil tests.' : 'Скан участка, грунт.'],
                        ['title' => $currentLang === 'en' ? 'Design' : 'Проект', 'desc' => $currentLang === 'en' ? 'Concept + drawings.' : 'Концепт + чертежи.'],
                        ['title' => $currentLang === 'en' ? 'Build' : 'Стройка', 'desc' => $currentLang === 'en' ? 'Foundation, frame, engineering.' : 'Фундамент, коробка, инженерка.'],
                        ['title' => $currentLang === 'en' ? 'Handover' : 'Сдача', 'desc' => $currentLang === 'en' ? 'Finishings, keys, warranty.' : 'Отделка, ключи, гарантия.'],
                    ];
                    foreach ($steps as $step):
                    ?>
                        <div class="step">
                            <strong><?php echo htmlspecialchars($step['title']); ?></strong>
                            <p style="color:#d1d5db;"><?php echo htmlspecialchars($step['desc']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="note"><?php echo $note; ?></div>
            </div>

            <div class="pricing floaty">
                <h3 style="margin:0 0 10px; color:#fcd34d;"><?php echo $currentLang === 'en' ? 'Price breakdown' : 'Разбивка цены'; ?></h3>
                <div class="grid">
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Foundation' : 'Фундамент'; ?></strong>
                        <p style="margin:6px 0 0; color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Slab + piles' : 'Плита + сваи'; ?></p>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Frame' : 'Коробка'; ?></strong>
                        <p style="margin:6px 0 0; color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Walls, roof' : 'Стены, крыша'; ?></p>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Engineering' : 'Инженерка'; ?></strong>
                        <p style="margin:6px 0 0; color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'HVAC, power, water' : 'ОВиК, электрика, вода'; ?></p>
                    </div>
                </div>
                <div class="pill" style="margin-top:12px; background:rgba(255,255,255,0.06); color:#fbbf24;">
                    <?php echo $currentLang === 'en' ? 'Guarantee & docs placeholders' : 'Гарантии и документы — плейсхолдеры'; ?>
                </div>
            </div>
        </section>

        <!-- Заявка -->
        <section class="section-block" id="demo-request">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Request a project' : 'Оставить заявку'; ?></h2>
            <form id="demoFormUrban" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Demo: UrbanFrame">
                <input type="hidden" name="service" value="builder-demo">
                <input type="hidden" name="type" value="contact">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Brief your project' : 'Опишите проект'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormUrbanSubmit"><?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?></button>
                    <span id="demoFormUrbanStatus" style="color:#fbbf24;"></span>
                </div>
            </form>
        </section>

        <!-- Показатели -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Metrics (demo data)' : 'Показатели (демо-данные)'; ?></h2>
            <div class="kpi-grid">
                <div class="kpi-card"><div class="kpi-value">+27%</div><p style="color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Inquiry rate' : 'Рост заявок'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">2.1×</div><p style="color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'CTR to CTA' : 'CTR к CTA'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">63s</div><p style="color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Time on page' : 'Время на странице'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">4.6</div><p style="color:#f3f4f6;"><?php echo $currentLang === 'en' ? 'Trust (placeholder)' : 'Доверие (плейсхолдер)'; ?></p></div>
            </div>
        </section>

        <!-- Экраны -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Screens / pages' : 'Экраны / страницы'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong>Hero</strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Offer, CTA, trust badges.' : 'Оффер, CTA, бейджи доверия.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Roadmap' : 'Дорожная карта'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? '4-step timeline.' : 'Таймлайн на 4 шага.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Pricing' : 'Стоимость'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Breakdown by stage.' : 'Разбивка по этапам.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Guarantees' : 'Гарантии'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Docs placeholders.' : 'Плейсхолдеры документов.'; ?></p></div>
            </div>
        </section>

        <!-- Flow -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Flow</h2>
            <div class="flow">
                <div class="flow-step"><strong>1. Hero</strong><p style="color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'See offer' : 'Оффер'; ?></p></div>
                <div class="flow-step"><strong>2. Steps</strong><p style="color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Roadmap detail' : 'Детализация шагов'; ?></p></div>
                <div class="flow-step"><strong>3. Pricing</strong><p style="color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Budget clarity' : 'Прозрачность бюджета'; ?></p></div>
                <div class="flow-step"><strong>4. CTA</strong><p style="color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Disabled CTA' : 'Отключённая CTA'; ?></p></div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">FAQ</h2>
            <div class="faq">
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Is form live?' : 'Форма живая?'; ?></strong><p style="margin-top:6px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Disabled in demo.' : 'Отключена в демо.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Docs?' : 'Документы?'; ?></strong><p style="margin-top:6px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Placeholders only.' : 'Только плейсхолдеры.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Calculator?' : 'Калькулятор?'; ?></strong><p style="margin-top:6px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'CTA disabled.' : 'CTA отключена.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Go live?' : 'Запуск?'; ?></strong><p style="margin-top:6px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Can connect forms/payments.' : 'Подключим формы/оплаты при запуске.'; ?></p></div>
            </div>
        </section>

        <!-- Capabilities -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What we can ship' : 'Что можем реализовать'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Process clarity' : 'Прозрачный процесс'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Roadmap, timelines, milestones.' : 'Дорожная карта, сроки, этапы.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Budget' : 'Бюджет'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Stage-based breakdown, options.' : 'Разбивка по этапам, опции.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Trust' : 'Доверие'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Docs, guarantees, cases.' : 'Документы, гарантии, кейсы.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Leads' : 'Заявки'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'CTA, calculator, callback.' : 'CTA, калькулятор, коллбек.'; ?></p></div>
            </div>
        </section>

        <!-- Components -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Component library' : 'Библиотека компонентов'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Hero' : 'Hero'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Offer, CTA, trust.' : 'Оффер, CTA, доверие.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Roadmap' : 'Этапы'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? '4 steps timeline.' : 'Таймлайн из 4 шагов.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Pricing' : 'Стоимость'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Stage breakdown.' : 'Разбивка по этапам.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Guarantees' : 'Гарантии'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Docs placeholders.' : 'Документы-плейсхолдеры.'; ?></p></div>
            </div>
        </section>

        <!-- Performance / SEO -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Performance / SEO</h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong>LCP</strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Optimized hero media.' : 'Оптимизация медиа hero.'; ?></p></div>
                <div class="card"><strong>CLS</strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Stable layout.' : 'Стабильный лейаут.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Schema' : 'Схемы'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Organization, FAQ, HowTo.' : 'Organization, FAQ, HowTo.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Tracking' : 'Трекинг'; ?></strong><p style="margin-top:8px; color:#e5e7eb;"><?php echo $currentLang === 'en' ? 'Events: CTA, calc, scroll depth.' : 'События: CTA, кальк, глубина скролла.'; ?></p></div>
            </div>
        </section>

        <!-- Gallery / Visual Showcase -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Visual showcase' : 'Визуальная витрина'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#6366f1,#4f46e5); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Hero Section' : 'Hero секция'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Trust-building intro' : 'Вступление, укрепляющее доверие'; ?></strong>
                    <p style="margin-top:8px; color:#cbd5e1;"><?php echo $currentLang === 'en' ? 'Compelling headline with clear value proposition and trust signals.' : 'Убедительный заголовок с чётким ценностным предложением и сигналами доверия.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#8b5cf6,#7c3aed); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Roadmap' : 'Дорожная карта'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Clear process' : 'Прозрачный процесс'; ?></strong>
                    <p style="margin-top:8px; color:#cbd5e1;"><?php echo $currentLang === 'en' ? 'Step-by-step timeline showing the construction process from start to finish.' : 'Пошаговый таймлайн, показывающий процесс строительства от начала до конца.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#06b6d4,#0891b2); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Pricing' : 'Стоимость'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Transparent pricing' : 'Прозрачное ценообразование'; ?></strong>
                    <p style="margin-top:8px; color:#cbd5e1;"><?php echo $currentLang === 'en' ? 'Stage-based pricing breakdown with clear options and guarantees.' : 'Разбивка стоимости по этапам с чёткими опциями и гарантиями.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Features & Benefits -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Key features' : 'Ключевые особенности'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:14px;">
                <div class="card" style="border-left:4px solid #6366f1;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🏗️</span>
                        <?php echo $currentLang === 'en' ? 'Process transparency' : 'Прозрачность процесса'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#cbd5e1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Clear roadmap showing every stage of the construction process with timelines.' : 'Чёткая дорожная карта, показывающая каждый этап строительства со сроками.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #8b5cf6;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">💰</span>
                        <?php echo $currentLang === 'en' ? 'Budget calculator' : 'Калькулятор бюджета'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#cbd5e1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Interactive calculator to estimate project costs based on requirements.' : 'Интерактивный калькулятор для оценки стоимости проекта на основе требований.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #06b6d4;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">📋</span>
                        <?php echo $currentLang === 'en' ? 'Documentation' : 'Документация'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#cbd5e1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Easy access to contracts, guarantees, and project documentation.' : 'Лёгкий доступ к договорам, гарантиям и проектной документации.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #6366f1;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🤝</span>
                        <?php echo $currentLang === 'en' ? 'Trust building' : 'Укрепление доверия'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#cbd5e1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Testimonials, case studies, and guarantees to build client confidence.' : 'Отзывы, кейсы и гарантии для укрепления доверия клиентов.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Testimonials / Reviews -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Client testimonials' : 'Отзывы клиентов'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#4f46e5); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">R</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Robert K.' : 'Роберт К.'; ?></strong>
                            <span style="color:#94a3b8; font-size:14px;"><?php echo $currentLang === 'en' ? 'Property Developer' : 'Застройщик'; ?></span>
                        </div>
                    </div>
                    <p style="color:#cbd5e1; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'The roadmap feature helped us convert 40% more leads. Excellent UX!' : 'Функция дорожной карты помогла нам конвертировать на 40% больше лидов. Отличный UX!'; ?>"</p>
                    <div style="margin-top:12px; color:#fbbf24; font-size:18px;">★★★★★</div>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#1e293b,#0f172a);">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#8b5cf6,#7c3aed); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">L</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Lisa M.' : 'Лиза М.'; ?></strong>
                            <span style="color:#94a3b8; font-size:14px;"><?php echo $currentLang === 'en' ? 'Construction Manager' : 'Менеджер по строительству'; ?></span>
                        </div>
                    </div>
                    <p style="color:#cbd5e1; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'Professional design that builds trust. Clients love the transparency!' : 'Профессиональный дизайн, который укрепляет доверие. Клиентам нравится прозрачность!'; ?>"</p>
                    <div style="margin-top:12px; color:#fbbf24; font-size:18px;">★★★★★</div>
                </div>
            </div>
        </section>

        <!-- Technology Stack -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Technology stack' : 'Технологический стек'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px;">
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">🎨</div>
                    <strong>Design</strong>
                    <p style="margin-top:6px; color:#cbd5e1; font-size:14px;"><?php echo $currentLang === 'en' ? 'Custom UI/UX' : 'Кастомный UI/UX'; ?></p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">💻</div>
                    <strong>Frontend</strong>
                    <p style="margin-top:6px; color:#cbd5e1; font-size:14px;">HTML5, CSS3, JS</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">⚙️</div>
                    <strong>Backend</strong>
                    <p style="margin-top:6px; color:#cbd5e1; font-size:14px;">PHP, MySQL</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">📊</div>
                    <strong>Analytics</strong>
                    <p style="margin-top:6px; color:#cbd5e1; font-size:14px;">GA4, Events</p>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    (function() {
        const form = document.getElementById('demoFormUrban');
        if (!form) return;
        const submitBtn = document.getElementById('demoFormUrbanSubmit');
        const statusEl = document.getElementById('demoFormUrbanStatus');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            statusEl.textContent = '';
            submitBtn.disabled = true;
            submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';
            try {
                const formData = new FormData(form);
                const res = await fetch('/backend/send.php', { method: 'POST', body: formData });
                const data = await res.json().catch(() => ({}));
                if (!res.ok || !data.success) {
                    throw new Error(data.message || '<?php echo $currentLang === 'en' ? 'Error sending' : 'Ошибка отправки'; ?>');
                }
                statusEl.style.color = '#22c55e';
                statusEl.textContent = '<?php echo $currentLang === 'en' ? 'Sent! We will contact you.' : 'Отправлено! Свяжемся с вами.'; ?>';
                form.reset();
            } catch (err) {
                statusEl.style.color = '#f87171';
                statusEl.textContent = err.message;
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?>';
            }
        });
    })();
</script>

<!-- Подключение улучшений для демо-проектов -->
<script src="/demo/demo-enhancements.js"></script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

