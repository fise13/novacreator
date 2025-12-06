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
    /* Компактный header только для демо + скрываем боевые пункты */
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

        <!-- Заявка -->
        <section class="section-block" id="demo-request">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Request a project' : 'Оставить заявку'; ?></h2>
            <form id="demoFormBeans" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Demo: Northern Beans">
                <input type="hidden" name="service" value="coffee-demo">
                <input type="hidden" name="type" value="contact">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Describe your task' : 'Опишите задачу'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormBeansSubmit"><?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?></button>
                    <span id="demoFormBeansStatus" style="color:#5b3417;"></span>
                </div>
            </form>
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

        <!-- Capabilities -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What we can ship' : 'Что можем реализовать'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Menu UX' : 'UX меню'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Filters, specials, badges.' : 'Фильтры, спецпредложения, бейджи.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Pre-order' : 'Заказ к приезду'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Cart, pickup time slot.' : 'Корзина, слот времени.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Loyalty' : 'Лояльность'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Rewards, visits tracking.' : 'Бонусы, отслеживание визитов.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Local SEO' : 'Локальное SEO'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Schema, maps, reviews widgets.' : 'Схемы, карты, виджеты отзывов.'; ?></p></div>
            </div>
        </section>

        <!-- Screens / Components -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Screens / components' : 'Экраны / компоненты'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Hero + CTA' : 'Hero + CTA'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Offer, seasonal badge.' : 'Оффер, сезонный бейдж.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Menu cards' : 'Карточки меню'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Variants, add-ons.' : 'Варианты, добавки.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Story' : 'История'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Team, roasting, beans.' : 'Команда, обжарка, зерно.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Map / contacts' : 'Карта / контакты'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Static map, hours, socials.' : 'Карта, часы, соцсети.'; ?></p></div>
            </div>
        </section>

        <!-- Performance / SEO -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Performance / SEO</h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong>LCP</strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Optimized hero, lazyload.' : 'Оптимизация hero, lazyload.'; ?></p></div>
                <div class="card"><strong>CLS</strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Reserved media slots.' : 'Резерв мест под медиа.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Schema' : 'Схемы'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'LocalBusiness, FAQ, Menu.' : 'LocalBusiness, FAQ, Menu.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Tracking' : 'Трекинг'; ?></strong><p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Events: menu view, add, submit.' : 'События: просмотр, добавление, отправка.'; ?></p></div>
            </div>
        </section>

        <!-- Gallery / Visual Showcase -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Visual showcase' : 'Визуальная витрина'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#fff7ed,#fff2da);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#f59e0b,#f97316); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Hero Section' : 'Hero секция'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Warm welcome' : 'Тёплое приветствие'; ?></strong>
                    <p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Seasonal offers, hero image, clear CTA buttons.' : 'Сезонные предложения, hero-изображение, чёткие CTA.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#fff7ed,#fff2da);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#8a4713,#5b3417); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Menu Cards' : 'Карточки меню'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Product showcase' : 'Витрина продуктов'; ?></strong>
                    <p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Filterable menu with images, descriptions, and prices.' : 'Фильтруемое меню с изображениями, описаниями и ценами.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#fff7ed,#fff2da);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#fef3c7,#fde68a); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#5b3417; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Story Section' : 'История'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Brand story' : 'История бренда'; ?></strong>
                    <p style="margin-top:8px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'About the roastery, team, and coffee philosophy.' : 'Об обжарке, команде и философии кофе.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Features & Benefits -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Key features' : 'Ключевые особенности'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:14px;">
                <div class="card" style="border-left:4px solid #f59e0b;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">☕</span>
                        <?php echo $currentLang === 'en' ? 'Menu management' : 'Управление меню'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Easy-to-update menu with categories, seasonal items, and special offers.' : 'Легко обновляемое меню с категориями, сезонными позициями и спецпредложениями.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #f97316;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">📱</span>
                        <?php echo $currentLang === 'en' ? 'Mobile-first design' : 'Мобильный дизайн'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Fully responsive layout optimized for all devices and screen sizes.' : 'Полностью адаптивная вёрстка, оптимизированная для всех устройств.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #f59e0b;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🎨</span>
                        <?php echo $currentLang === 'en' ? 'Custom branding' : 'Уникальный брендинг'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Unique visual identity that reflects your coffee shop\'s personality.' : 'Уникальная визуальная идентичность, отражающая характер вашей кофейни.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #f97316;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">⚡</span>
                        <?php echo $currentLang === 'en' ? 'Fast loading' : 'Быстрая загрузка'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Optimized performance ensures quick page loads and smooth user experience.' : 'Оптимизированная производительность обеспечивает быструю загрузку и плавный UX.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Testimonials / Reviews -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What clients say' : 'Отзывы клиентов'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:#fff;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#f59e0b,#f97316); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">A</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Alex M.' : 'Алекс М.'; ?></strong>
                            <span style="color:#8a4713; font-size:14px;"><?php echo $currentLang === 'en' ? 'Coffee Shop Owner' : 'Владелец кофейни'; ?></span>
                        </div>
                    </div>
                    <p style="color:#5b3417; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'The website perfectly captures our warm atmosphere. Orders increased by 40%!' : 'Сайт идеально передаёт нашу тёплую атмосферу. Заказы выросли на 40%!'; ?>"</p>
                    <div style="margin-top:12px; color:#f59e0b; font-size:18px;">★★★★★</div>
                </div>
                <div class="card" style="padding:24px; background:#fff;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#8a4713,#5b3417); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">M</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Maria K.' : 'Мария К.'; ?></strong>
                            <span style="color:#8a4713; font-size:14px;"><?php echo $currentLang === 'en' ? 'Barista & Manager' : 'Бариста и менеджер'; ?></span>
                        </div>
                    </div>
                    <p style="color:#5b3417; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'Customers love the easy menu navigation. Great UX design!' : 'Клиентам нравится удобная навигация по меню. Отличный UX-дизайн!'; ?>"</p>
                    <div style="margin-top:12px; color:#f59e0b; font-size:18px;">★★★★★</div>
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
                    <p style="margin-top:6px; color:#5b3417; font-size:14px;"><?php echo $currentLang === 'en' ? 'Custom UI/UX' : 'Кастомный UI/UX'; ?></p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">💻</div>
                    <strong>Frontend</strong>
                    <p style="margin-top:6px; color:#5b3417; font-size:14px;">HTML5, CSS3, JS</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">⚙️</div>
                    <strong>Backend</strong>
                    <p style="margin-top:6px; color:#5b3417; font-size:14px;">PHP, MySQL</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">📊</div>
                    <strong>Analytics</strong>
                    <p style="margin-top:6px; color:#5b3417; font-size:14px;">GA4, Events</p>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    (function() {
        const form = document.getElementById('demoFormBeans');
        if (!form) return;
        const submitBtn = document.getElementById('demoFormBeansSubmit');
        const statusEl = document.getElementById('demoFormBeansStatus');

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
                statusEl.style.color = '#16a34a';
                statusEl.textContent = '<?php echo $currentLang === 'en' ? 'Sent! We will contact you.' : 'Отправлено! Свяжемся с вами.'; ?>';
                form.reset();
            } catch (err) {
                statusEl.style.color = '#b91c1c';
                statusEl.textContent = err.message;
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?>';
            }
        });
    })();
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

