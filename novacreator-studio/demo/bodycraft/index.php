<?php
$pageTitle = 'BodyCraft — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Neon trainer landing: before/after and quiz placeholders, no logic.';
$ASSET_BASE_OVERRIDE = ''; // грузим ассеты из корня
require_once __DIR__ . '/../../includes/header.php';
$currentLang = getCurrentLanguage();
$back = getLocalizedUrl($currentLang, '/portfolio');
$ctaDemo = $currentLang === 'en' ? 'demo' : 'демо';
$badge = $currentLang === 'en' ? 'Demo layout' : 'Демо-макет';
$logicOff = $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена';
$note = $currentLang === 'en'
    ? 'Buttons, forms and toggles are disabled. Visual concept only.'
    : 'Кнопки, формы и тогглы отключены. Только визуальный концепт.';
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

    :root { --bg: #090d12; --accent: #22c55e; --accent2: #0ea5e9; }
    .shell { background: radial-gradient(circle at 20% 25%, rgba(34,197,94,0.2), transparent 40%), var(--bg); color:#e7f5ec; }
    .container { max-width: 1180px; margin:0 auto; padding:88px 20px 96px; }
    .nav { display:flex; justify-content:space-between; align-items:center; background:rgba(12,18,22,0.9); border:1px solid rgba(34,197,94,0.35); border-radius:16px; padding:14px 18px; box-shadow:0 20px 60px rgba(0,0,0,0.35); }
    .brand { display:flex; align-items:center; gap:10px; font-weight:800; }
    .links { display:flex; gap:12px; flex-wrap:wrap; }
    .links a { color:#9be6b8; text-decoration:none; font-weight:700; }
    .links a.off { pointer-events:none; opacity:.55; }
    .hero { display:grid; grid-template-columns:1fr 1fr; gap:22px; align-items:center; margin-top:28px; }
    .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:rgba(34,197,94,0.12); color:#bdfccf; font-weight:700; }
    .title { font-size:44px; line-height:1.1; margin:12px 0 10px; color:#e9ffee; }
    .lead { color:#c3ead6; line-height:1.65; max-width:560px; }
    .btn { border:none; border-radius:12px; padding:12px 16px; font-weight:800; cursor:not-allowed; opacity:.8; }
    .btn-main { background:linear-gradient(120deg,#22c55e,#16a34a); color:#041007; }
    .btn-ghost { background:transparent; border:1px solid rgba(34,197,94,0.55); color:#9be6b8; }
    .panel { background:linear-gradient(135deg, rgba(34,197,94,0.08), rgba(59,130,246,0.08)); border:1px solid rgba(255,255,255,0.06); border-radius:18px; padding:20px; box-shadow:0 18px 50px rgba(0,0,0,0.35); }
    .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; margin-top:16px; }
    .card { background:rgba(255,255,255,0.02); border:1px solid rgba(255,255,255,0.08); border-radius:16px; padding:16px; }
    .progress { height:10px; border-radius:999px; background:rgba(255,255,255,0.08); overflow:hidden; margin:12px 0; }
    .progress span { display:block; height:100%; width:72%; background:linear-gradient(90deg,#22c55e,#4ade80); }
    .mock { height:280px; border-radius:18px; background:#0f172a; border:1px solid rgba(255,255,255,0.08); position:relative; overflow:hidden; }
    .mock::after { content:''; position:absolute; inset:14px; border-radius:14px; border:1px dashed rgba(59,130,246,0.4); }
    .floaty { animation: floaty 7s ease-in-out infinite; }
    @keyframes floaty { 0%{transform:translateY(0);} 50%{transform:translateY(-10px);} 100%{transform:translateY(0);} }

    /* Дополнения */
    .section-block { margin-top: 44px; }
    .kpi-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .kpi-card { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.1); border-radius:16px; padding:16px; }
    .kpi-value { font-size:32px; font-weight:800; color:#4ade80; }
    .screen-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; }
    .screen { background:rgba(255,255,255,0.04); border:1px dashed rgba(255,255,255,0.12); border-radius:14px; padding:14px; min-height:150px; }
    .flow { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .flow-step { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:14px; }
    .faq { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; }
    .faq-item { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:14px; }
</style>

<main class="shell">
    <div class="container">
        <nav class="nav">
            <div class="brand">
                <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#22c55e,#0ea5e9);display:inline-block;"></span>
                <span>BodyCraft</span>
            </div>
            <div class="links">
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Programs' : 'Программы'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Results' : 'Результаты'; ?></a>
                <a class="off" href="#">FAQ</a>
                <a href="<?php echo htmlspecialchars($back); ?>"><?php echo $backToPortfolio; ?></a>
            </div>
        </nav>

        <section class="hero">
            <div class="panel">
                <div class="pill">🏋️ <?php echo $badge; ?> · <?php echo $logicOff; ?></div>
                <h1 class="title"><?php echo $currentLang === 'en' ? 'Neon landing for a personal trainer' : 'Неоновый лендинг персонального тренера'; ?></h1>
                <p class="lead">
                    <?php echo $currentLang === 'en'
                        ? 'High-contrast hero, before/after gallery, quiz placeholders. Buttons and forms are inert — pure demo.'
                        : 'Контрастный герой, галерея до/после, квиз-плейсхолдеры. Кнопки и формы не работают — чистое демо.'; ?>
                </p>
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 16px;">
                    <button class="btn btn-main"><?php echo $currentLang === 'en' ? 'Start program' : 'Начать программу'; ?> · <?php echo $ctaDemo; ?></button>
                    <button class="btn btn-ghost"><?php echo $currentLang === 'en' ? 'See plan' : 'Посмотреть план'; ?> · <?php echo $ctaDemo; ?></button>
                </div>
                <div class="progress" aria-hidden="true"><span></span></div>
                <div class="grid">
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Before / After' : 'До / После'; ?></strong>
                        <p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Static progress tiles; toggles disabled.' : 'Статичные тайлы прогресса; переключатели неактивны.'; ?></p>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Lead quiz' : 'Квиз-лид'; ?></strong>
                        <p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? '3-step quiz placeholder, submit off.' : '3 шага квиза, отправка выключена.'; ?></p>
                    </div>
                    <div class="card">
                        <strong>USP</strong>
                        <p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Offer: 3 workouts/week, 40 minutes.' : 'Оффер: 3 тренировки в неделю по 40 минут.'; ?></p>
                    </div>
                </div>
                <div class="note" style="border-color:rgba(34,197,94,0.45); background:rgba(34,197,94,0.08); color:#bfffd2;">
                    <?php echo $note; ?>
                </div>
            </div>
            <div class="panel floaty" aria-hidden="true">
                <div class="mock">
                    <div style="position:absolute; top:22px; left:22px; padding:10px 12px; border-radius:10px; background:rgba(34,197,94,0.2); color:#bbf7d0;">Before</div>
                    <div style="position:absolute; top:22px; right:22px; padding:10px 12px; border-radius:10px; background:rgba(59,130,246,0.2); color:#c7d9ff;">After</div>
                    <div style="position:absolute; bottom:32px; left:22px; right:22px; height:58px; border-radius:12px; background:linear-gradient(90deg, rgba(34,197,94,0.4), rgba(59,130,246,0.4));"></div>
                </div>
            </div>
        </section>

        <!-- Заявка -->
        <section class="section-block" id="demo-request">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Request a project' : 'Оставить заявку'; ?></h2>
            <form id="demoFormBody" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Demo: BodyCraft">
                <input type="hidden" name="service" value="trainer-demo">
                <input type="hidden" name="type" value="contact">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Describe your goal' : 'Опишите задачу'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormBodySubmit"><?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?></button>
                    <span id="demoFormBodyStatus" style="color:#c0ead1;"></span>
                </div>
            </form>
        </section>

        <!-- Показатели -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Metrics (demo data)' : 'Показатели (демо-данные)'; ?></h2>
            <div class="kpi-grid">
                <div class="kpi-card"><div class="kpi-value">+42%</div><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Lead volume (vs baseline)' : 'Рост лидов (к базовой)'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">2.9×</div><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Click-to-lead' : 'Кликабельность → лид'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">68s</div><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Avg. time on page' : 'Время на странице'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">4.7</div><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Satisfaction (placeholder)' : 'Удовлетворённость (плейсхолдер)'; ?></p></div>
            </div>
        </section>

        <!-- Экраны -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Screens / pages' : 'Экраны / страницы'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong>Hero</strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Offer, CTA, badges.' : 'Оффер, CTA, бейджи.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Before/After' : 'До/После'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Transformations gallery.' : 'Галерея трансформаций.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Quiz' : 'Квиз'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? '3 steps, disabled submit.' : '3 шага, отправка выключена.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'FAQ' : 'FAQ'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Objections handling.' : 'Снятие возражений.'; ?></p></div>
            </div>
        </section>

        <!-- Flow -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Flow</h2>
            <div class="flow">
                <div class="flow-step"><strong>1. Hero</strong><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'See offer' : 'Смотрим оффер'; ?></p></div>
                <div class="flow-step"><strong>2. Proof</strong><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Before/after proof' : 'Доказательства до/после'; ?></p></div>
                <div class="flow-step"><strong>3. Quiz</strong><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Quiz placeholder' : 'Квиз-плейсхолдер'; ?></p></div>
                <div class="flow-step"><strong>4. CTA</strong><p style="color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Disabled CTA' : 'Отключённая CTA'; ?></p></div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">FAQ</h2>
            <div class="faq">
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Is quiz live?' : 'Квиз рабочий?'; ?></strong><p style="margin-top:6px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'No, demo only.' : 'Нет, это демо.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Payments?' : 'Оплаты?'; ?></strong><p style="margin-top:6px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Not connected in demo.' : 'Не подключены.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Forms?' : 'Формы?'; ?></strong><p style="margin-top:6px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Disabled for safety.' : 'Отключены для безопасности.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Go live?' : 'Запуск в прод?'; ?></strong><p style="margin-top:6px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Can enable forms and payments.' : 'Можем включить формы и оплаты.'; ?></p></div>
            </div>
        </section>

        <!-- Capabilities -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What we can ship' : 'Что можем реализовать'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Positioning' : 'Позиционирование'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Clear offer, avatar, objections.' : 'Чёткий оффер, аватар, возражения.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Programs' : 'Программы'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Packages, bonuses, guarantees.' : 'Пакеты, бонусы, гарантии.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Social proof' : 'Доказательства'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Before/after, reviews, media.' : 'До/после, отзывы, медиа.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Lead funnel' : 'Лид-флоу'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Quiz, CTA, messengers integration.' : 'Квиз, CTA, интеграция мессенджеров.'; ?></p></div>
            </div>
        </section>

        <!-- Components -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Component library' : 'Библиотека компонентов'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong>Hero</strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Offer, CTA, badges.' : 'Оффер, CTA, бейджи.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Before/After' : 'До/После'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Tiles, toggles, stats.' : 'Тайлы, тогглы, цифры.'; ?></p></div>
                <div class="screen"><strong>Quiz</strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Steps, progress, CTA.' : 'Шаги, прогресс, CTA.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'FAQ/Proof' : 'FAQ/Доверие'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'FAQ, media mentions.' : 'FAQ, медиа-упоминания.'; ?></p></div>
            </div>
        </section>

        <!-- Performance / SEO -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Performance / SEO</h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong>LCP</strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Optimized hero, lazy images.' : 'Оптимизация hero, lazy изображений.'; ?></p></div>
                <div class="card"><strong>CLS</strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Stable layouts.' : 'Стабильные лейауты.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Schema' : 'Схемы'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'FAQ, Article, Person.' : 'FAQ, Article, Person.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Tracking' : 'Трекинг'; ?></strong><p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Events: quiz steps, CTA, scroll.' : 'События: шаги квиза, CTA, скролл.'; ?></p></div>
            </div>
        </section>

        <!-- Gallery / Visual Showcase -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Visual showcase' : 'Визуальная витрина'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#0a2818,#0d3d24);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#10b981,#059669); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Hero Section' : 'Hero секция'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Powerful introduction' : 'Мощное вступление'; ?></strong>
                    <p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Bold headline, clear value proposition, and compelling CTA.' : 'Яркий заголовок, чёткое ценностное предложение и убедительный CTA.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#0a2818,#0d3d24);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#065f46,#047857); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Before/After' : 'До/После'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Transformation proof' : 'Доказательство трансформации'; ?></strong>
                    <p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Interactive before/after gallery showcasing real results.' : 'Интерактивная галерея до/после с реальными результатами.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#0a2818,#0d3d24);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#10b981,#059669); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Quiz Flow' : 'Квиз'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Engaging quiz' : 'Увлекательный квиз'; ?></strong>
                    <p style="margin-top:8px; color:#c0ead1;"><?php echo $currentLang === 'en' ? 'Multi-step quiz to qualify leads and personalize offers.' : 'Многошаговый квиз для квалификации лидов и персонализации предложений.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Features & Benefits -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Key features' : 'Ключевые особенности'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:14px;">
                <div class="card" style="border-left:4px solid #10b981;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">💪</span>
                        <?php echo $currentLang === 'en' ? 'Results showcase' : 'Витрина результатов'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#c0ead1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Compelling before/after gallery that builds trust and demonstrates expertise.' : 'Убедительная галерея до/после, которая укрепляет доверие и демонстрирует экспертизу.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #059669;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🎯</span>
                        <?php echo $currentLang === 'en' ? 'Lead qualification' : 'Квалификация лидов'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#c0ead1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Interactive quiz helps identify client needs and personalize the offer.' : 'Интерактивный квиз помогает определить потребности клиента и персонализировать предложение.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #10b981;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">📱</span>
                        <?php echo $currentLang === 'en' ? 'Mobile optimized' : 'Мобильная оптимизация'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#c0ead1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Perfect experience on all devices, ensuring maximum reach and engagement.' : 'Идеальный опыт на всех устройствах, обеспечивающий максимальный охват и вовлечённость.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #059669;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">⚡</span>
                        <?php echo $currentLang === 'en' ? 'Fast conversion' : 'Быстрая конверсия'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#c0ead1; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Streamlined user journey from first visit to booking a consultation.' : 'Оптимизированный пользовательский путь от первого визита до бронирования консультации.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Testimonials / Reviews -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Success stories' : 'Истории успеха'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#0a2818,#0d3d24);">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#10b981,#059669); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">J</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'John D.' : 'Джон Д.'; ?></strong>
                            <span style="color:#6ee7b7; font-size:14px;"><?php echo $currentLang === 'en' ? 'Personal Trainer' : 'Персональный тренер'; ?></span>
                        </div>
                    </div>
                    <p style="color:#c0ead1; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'The quiz feature increased my bookings by 60%. Highly recommend!' : 'Функция квиза увеличила мои бронирования на 60%. Очень рекомендую!'; ?>"</p>
                    <div style="margin-top:12px; color:#10b981; font-size:18px;">★★★★★</div>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#0a2818,#0d3d24);">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#059669,#047857); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">S</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Sarah L.' : 'Сара Л.'; ?></strong>
                            <span style="color:#6ee7b7; font-size:14px;"><?php echo $currentLang === 'en' ? 'Fitness Coach' : 'Фитнес-коуч'; ?></span>
                        </div>
                    </div>
                    <p style="color:#c0ead1; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'Professional design that perfectly represents my brand. Clients love it!' : 'Профессиональный дизайн, который идеально представляет мой бренд. Клиентам нравится!'; ?>"</p>
                    <div style="margin-top:12px; color:#10b981; font-size:18px;">★★★★★</div>
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
                    <p style="margin-top:6px; color:#c0ead1; font-size:14px;"><?php echo $currentLang === 'en' ? 'Custom UI/UX' : 'Кастомный UI/UX'; ?></p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">💻</div>
                    <strong>Frontend</strong>
                    <p style="margin-top:6px; color:#c0ead1; font-size:14px;">HTML5, CSS3, JS</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">⚙️</div>
                    <strong>Backend</strong>
                    <p style="margin-top:6px; color:#c0ead1; font-size:14px;">PHP, MySQL</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">📊</div>
                    <strong>Analytics</strong>
                    <p style="margin-top:6px; color:#c0ead1; font-size:14px;">GA4, Events</p>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    (function() {
        const form = document.getElementById('demoFormBody');
        if (!form) return;
        const submitBtn = document.getElementById('demoFormBodySubmit');
        const statusEl = document.getElementById('demoFormBodyStatus');

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
                statusEl.style.color = '#4ade80';
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

