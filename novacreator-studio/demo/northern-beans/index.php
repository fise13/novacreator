<?php
$pageTitle = 'Northern Beans — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Static coffee shop mockup: warm hero, menu, atmosphere. Buttons are disabled.';
$ASSET_BASE_OVERRIDE = ''; // грузим ассеты из корня
require_once __DIR__ . '/../../includes/header.php';
$currentLang = getCurrentLanguage();
$back = getLocalizedUrl($currentLang, '/portfolio');
$ctaDemo = $currentLang === 'en' ? 'demo' : 'демо';
$badge = $currentLang === 'en' ? 'Demo layout' : 'Демо-макет';
$logicOff = $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена';
$note = $currentLang === 'en'
    ? 'Forms and buttons are intentionally disabled. Visual showcase only.'
    : 'Формы и кнопки намеренно отключены. Только визуальная витрина.';
?>

<style>
    /* Компактный header только для демо */
    #mainNavbar { padding-top: 0 !important; padding-bottom: 0 !important; }
    #mainNavbar .container { padding-top: 8px; padding-bottom: 8px; }
    #mainNavbar .flex.items-center.justify-between { height: 62px !important; }
    #mainNavbar img { width: 40px !important; height: 40px !important; }
    #mainNavbar span.text-gradient { font-size: 1.05rem !important; }

    :root { --bg: #f7f3ec; --text: #1b1208; --accent: #f59e0b; --accent2: #f97316; }
    .shell { background: radial-gradient(circle at 12% 18%, rgba(255,214,170,0.32), transparent 40%), var(--bg); color: var(--text); }
    .container { max-width: 1180px; margin: 0 auto; padding: 80px 20px 96px; }
    .nav { display:flex; justify-content:space-between; align-items:center; background:#fff7ed; border:1px solid #f3e6d7; border-radius:18px; padding:14px 18px; box-shadow:0 18px 50px rgba(108,68,28,0.08); }
    .brand { display:flex; align-items:center; gap:10px; font-weight:800; }
    .links { display:flex; gap:12px; flex-wrap:wrap; }
    .links a { color:#8a4713; text-decoration:none; font-weight:700; }
    .links a.off { pointer-events:none; opacity:.6; }
    .hero { display:grid; grid-template-columns:1.15fr 0.85fr; gap:22px; align-items:center; margin-top:28px; }
    .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:#fff2da; color:#8a4713; font-weight:700; }
    .title { font-size:46px; line-height:1.08; margin:12px 0 10px; }
    .lead { color:#4b2b12; line-height:1.65; max-width:560px; }
    .btn { border:none; border-radius:14px; padding:14px 18px; font-weight:800; cursor:not-allowed; opacity:.78; }
    .btn-main { background:linear-gradient(120deg,var(--accent),var(--accent2)); color:#2c1400; }
    .btn-ghost { background:#fff; border:1px solid var(--accent); color:#9a4b12; }
    .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:14px; margin-top:18px; }
    .card { background:#fff; border:1px solid #f3e6d7; border-radius:18px; padding:18px; box-shadow:0 18px 50px rgba(108,68,28,0.1); }
    .note { margin-top:16px; padding:14px; border-radius:14px; border:1px dashed var(--accent); background:#fff7ed; color:#5b3417; }
    .visual { background:#fff; border:1px solid #f3e6d7; border-radius:18px; padding:18px; box-shadow:0 20px 60px rgba(108,68,28,0.12); position:relative; overflow:hidden; }
    .visual-hero { height:320px; border-radius:16px; background:linear-gradient(135deg,#fcd34d,#f59e0b); position:relative; overflow:hidden; }
    .visual-hero::after { content:''; position:absolute; inset:12px; border-radius:12px; border:1px solid rgba(255,255,255,0.4); }
    .floaty { animation: floaty 7s ease-in-out infinite; }
    @keyframes floaty { 0%{transform:translateY(0);} 50%{transform:translateY(-10px);} 100%{transform:translateY(0);} }

    /* Дополнительные секции */
    .section-block { margin-top: 46px; }
    .kpi-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .kpi-card { background:#fff; border:1px solid #f1e3d2; border-radius:16px; padding:16px; box-shadow:0 12px 36px rgba(108,68,28,0.08); }
    .kpi-value { font-size:32px; font-weight:800; color:#c2410c; }
    .screen-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; }
    .screen { background:#fff; border:1px solid #f1e3d2; border-radius:16px; padding:16px; min-height:160px; position:relative; overflow:hidden; }
    .screen::after { content:''; position:absolute; inset:12px; border:1px dashed #f3d9b0; border-radius:12px; opacity:.6; }
    .flow { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .flow-step { background:#fff; border:1px solid #f1e3d2; border-radius:16px; padding:14px; box-shadow:0 10px 32px rgba(108,68,28,0.07); }
    .faq { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px; }
    .faq-item { background:#fff; border:1px solid #f1e3d2; border-radius:16px; padding:14px; }
</style>

<main class="shell">
    <div class="container">
        <nav class="nav">
            <div class="brand">
                <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#f59e0b,#fbbf24);display:inline-block;"></span>
                <span>Northern Beans</span>
            </div>
            <div class="links">
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Menu' : 'Меню'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Story' : 'История'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Map' : 'Карта'; ?></a>
                <a href="<?php echo htmlspecialchars($back); ?>"><?php echo $backToPortfolio; ?></a>
            </div>
        </nav>

        <section class="hero">
            <div>
                <div class="pill">☕ <?php echo $badge; ?> · <?php echo $logicOff; ?></div>
                <h1 class="title"><?php echo $currentLang === 'en' ? 'Sunlit coffee landing for a cozy roastery' : 'Солнечный лендинг кофейни и обжарки'; ?></h1>
                <p class="lead">
                    <?php echo $currentLang === 'en'
                        ? 'Hero with seasonal offer, warm palette, tactile cards for menu, atmosphere and location. All CTAs are decorative.'
                        : 'Герой с сезонным оффером, тёплой палитрой и тактильными карточками меню, атмосферы и локации. Все CTA декоративные.'; ?>
                </p>
                <div style="display:flex; gap:12px; flex-wrap:wrap; margin:16px 0 18px;">
                    <button class="btn btn-main" aria-disabled="true">
                        <?php echo $currentLang === 'en' ? 'Order for pickup' : 'Заказать к приезду'; ?> · <?php echo $ctaDemo; ?>
                    </button>
                    <button class="btn btn-ghost" aria-disabled="true">
                        <?php echo $currentLang === 'en' ? 'See beans' : 'Выбрать зерно'; ?> · <?php echo $ctaDemo; ?>
                    </button>
                </div>
                <div class="grid">
                    <div class="card floaty">
                        <strong><?php echo $currentLang === 'en' ? 'Seasonal menu' : 'Сезонное меню'; ?></strong>
                        <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Pumpkin latte, cold brew, signature desserts.' : 'Тыковка латте, колд-брю и фирменные десерты.'; ?></p>
                        <div style="display:flex; gap:8px; flex-wrap:wrap;">
                            <span class="pill beans-tag">V60</span>
                            <span class="pill beans-tag">Cold brew</span>
                            <span class="pill beans-tag">Desserts</span>
                        </div>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Atmosphere' : 'Атмосфера'; ?></strong>
                        <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Vinyl, wooden bar, sunny window seats.' : 'Винил, деревянный бар, солнечные подоконники.'; ?></p>
                        <?php echo buttonDisabled($currentLang === 'en' ? 'Book a table' : 'Забронировать стол'); ?>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Location' : 'Локация'; ?></strong>
                        <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Old town, 2 min from the park.' : 'Старый центр, 2 минуты от парка.'; ?></p>
                        <div class="pill beans-tag" style="pointer-events:none;"><?php echo $currentLang === 'en' ? 'Map placeholder' : 'Карта-плейсхолдер'; ?></div>
                    </div>
                </div>
                <div class="note"><?php echo $note; ?></div>
            </div>
            <div class="visual floaty" aria-hidden="true">
                <div class="visual-hero">
                    <div style="position:absolute; top:32px; left:24px; background:#fff; padding:12px 14px; border-radius:12px; box-shadow:0 12px 36px rgba(244,160,10,0.25); color:#7c3b0c;">
                        <?php echo $currentLang === 'en' ? 'Latte Art Class' : 'Мастер-класс латте-арт'; ?>
                    </div>
                    <div style="position:absolute; bottom:28px; right:24px; background:#111827; color:#fff; padding:10px 14px; border-radius:10px;">
                        <?php echo $currentLang === 'en' ? 'Order in 12 min' : 'Готово за 12 мин'; ?>
                    </div>
                    <div style="position:absolute; bottom:26px; left:24px; width:110px; height:40px; background:#fef3c7; border-radius:14px; border:1px dashed #f59e0b;"></div>
                </div>
            </div>
        </section>

        <!-- Показатели -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Metrics (demo data)' : 'Показатели (демо-данные)'; ?></h2>
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-value">18%</div>
                    <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Pickup conversion' : 'Конверсия в заказ к приезду'; ?></p>
                </div>
                <div class="kpi-card">
                    <div class="kpi-value">3.8×</div>
                    <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Sessions vs IG only' : 'Сессий vs только Instagram'; ?></p>
                </div>
                <div class="kpi-card">
                    <div class="kpi-value">72s</div>
                    <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Avg. time on page' : 'Среднее время на странице'; ?></p>
                </div>
                <div class="kpi-card">
                    <div class="kpi-value">4.9</div>
                    <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Rating (placeholder)' : 'Рейтинг (плейсхолдер)'; ?></p>
                </div>
            </div>
        </section>

        <!-- Экраны -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Screens / pages' : 'Экраны / страницы'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong>Hero</strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Seasonal offer, CTA.' : 'Сезонный оффер, CTA.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Menu' : 'Меню'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Filters and specials (static).' : 'Фильтры и спецпредложения (статик).'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Story' : 'История'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Roastery, beans, team cards.' : 'Обжарка, зерно, команда.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Map' : 'Карта'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Location placeholder.' : 'Плейсхолдер локации.'; ?></p></div>
            </div>
        </section>

        <!-- Flow -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Flow</h2>
            <div class="flow">
                <div class="flow-step"><strong>1. Hero</strong><p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'See offer and CTA.' : 'Оффер и CTA.'; ?></p></div>
                <div class="flow-step"><strong>2. Menu</strong><p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Pick drink (static).' : 'Выбор напитка (статик).'; ?></p></div>
                <div class="flow-step"><strong>3. CTA</strong><p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Order button disabled.' : 'Кнопка заказа отключена.'; ?></p></div>
                <div class="flow-step"><strong>4. Location</strong><p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Map placeholder.' : 'Карта-плейсхолдер.'; ?></p></div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">FAQ</h2>
            <div class="faq">
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Is this live?' : 'Это боевой сайт?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'No, demo only. Buttons are off.' : 'Нет, это демо. Кнопки выключены.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Payments?' : 'Оплаты?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Not connected in demo.' : 'Не подключены в демо.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Map?' : 'Карта?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Static placeholder.' : 'Статичный плейсхолдер.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Can go live?' : 'Можно включить?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Yes, we can connect forms, payments, map.' : 'Да, можем подключить формы, оплаты, карту.'; ?></p></div>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

