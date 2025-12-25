<?php
$pageTitle = 'Northern Beans — Coffee Shop & Roastery';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Fresh roasted coffee daily. Order ahead for pickup, explore our seasonal menu, and experience our cozy atmosphere in the heart of the old town.';
$ASSET_BASE_OVERRIDE = ''; // грузим ассеты из корня
require_once __DIR__ . '/../../includes/header.php';
$currentLang = getCurrentLanguage();
$back = getLocalizedUrl($currentLang, '/');
$backToPortfolio = $currentLang === 'en' ? 'Back to home' : 'Назад на главную';
?>

<style>
    /* Полностью скрываем header основного сайта */
    #mainNavbar { display: none !important; }

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
    .btn { border:none; border-radius:14px; padding:14px 18px; font-weight:800; cursor:pointer; transition:all 0.3s ease; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(245,158,11,0.3); }
    .btn-main:hover { opacity: 0.9; }
    .btn-ghost:hover { background: #fff7ed; }
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
                <a href="#menu"><?php echo $currentLang === 'en' ? 'Menu' : 'Меню'; ?></a>
                <a href="#story"><?php echo $currentLang === 'en' ? 'Story' : 'История'; ?></a>
                <a href="#location"><?php echo $currentLang === 'en' ? 'Map' : 'Карта'; ?></a>
                <a href="<?php echo htmlspecialchars($back); ?>" style="opacity:0.7; font-size:0.9em;"><?php echo $backToPortfolio; ?></a>
            </div>
        </nav>

        <section class="hero">
            <div>
                <div class="pill" style="background:#fff2da; color:#8a4713;">☕ <?php echo $currentLang === 'en' ? 'Fresh roasted daily' : 'Свежая обжарка каждый день'; ?></div>
                <h1 class="title"><?php echo $currentLang === 'en' ? 'Welcome to Northern Beans' : 'Добро пожаловать в Northern Beans'; ?></h1>
                <p class="lead">
                    <?php echo $currentLang === 'en'
                        ? 'Discover our seasonal menu, cozy atmosphere, and premium coffee beans. Order ahead for pickup or explore our selection of specialty roasts.'
                        : 'Откройте для себя наше сезонное меню, уютную атмосферу и премиальные кофейные зёрна. Закажите заранее к приезду или изучите нашу коллекцию специальной обжарки.'; ?>
                </p>
                <div style="display:flex; gap:12px; flex-wrap:wrap; margin:16px 0 18px;">
                    <button class="btn btn-main" onclick="document.getElementById('order-form').scrollIntoView({behavior:'smooth'})">
                        <?php echo $currentLang === 'en' ? 'Order for pickup' : 'Заказать к приезду'; ?>
                    </button>
                    <button class="btn btn-ghost" onclick="document.getElementById('menu').scrollIntoView({behavior:'smooth'})">
                        <?php echo $currentLang === 'en' ? 'View menu' : 'Посмотреть меню'; ?>
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
                        <button class="btn btn-ghost" style="margin-top:12px; width:100%;" onclick="document.getElementById('contact-form').scrollIntoView({behavior:'smooth'})">
                            <?php echo $currentLang === 'en' ? 'Book a table' : 'Забронировать стол'; ?>
                        </button>
                    </div>
                    <div class="card" id="location">
                        <strong><?php echo $currentLang === 'en' ? 'Location' : 'Локация'; ?></strong>
                        <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Old town, 2 min from the park.' : 'Старый центр, 2 минуты от парка.'; ?></p>
                        <div class="pill beans-tag" style="margin-top:12px; cursor:pointer;" onclick="alert('<?php echo $currentLang === 'en' ? 'Map integration coming soon' : 'Интеграция карты скоро появится'; ?>')">
                            <?php echo $currentLang === 'en' ? 'View on map' : 'Посмотреть на карте'; ?>
                        </div>
                    </div>
                </div>
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

        <!-- Меню -->
        <section class="section-block" id="menu">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Our Menu' : 'Наше меню'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px; margin-top:24px;">
                <div class="card">
                    <strong style="font-size:20px;"><?php echo $currentLang === 'en' ? 'Espresso' : 'Эспрессо'; ?></strong>
                    <p style="color:#5b3417; margin-top:8px;"><?php echo $currentLang === 'en' ? 'Classic Italian espresso, rich and bold.' : 'Классический итальянский эспрессо, насыщенный и крепкий.'; ?></p>
                    <div style="margin-top:12px; font-weight:800; color:#c2410c; font-size:18px;">₽180</div>
                </div>
                <div class="card">
                    <strong style="font-size:20px;"><?php echo $currentLang === 'en' ? 'Cappuccino' : 'Капучино'; ?></strong>
                    <p style="color:#5b3417; margin-top:8px;"><?php echo $currentLang === 'en' ? 'Espresso with steamed milk and foam.' : 'Эспрессо с молочной пеной.'; ?></p>
                    <div style="margin-top:12px; font-weight:800; color:#c2410c; font-size:18px;">₽220</div>
                </div>
                <div class="card">
                    <strong style="font-size:20px;"><?php echo $currentLang === 'en' ? 'Latte' : 'Латте'; ?></strong>
                    <p style="color:#5b3417; margin-top:8px;"><?php echo $currentLang === 'en' ? 'Smooth espresso with steamed milk.' : 'Нежный эспрессо с молоком.'; ?></p>
                    <div style="margin-top:12px; font-weight:800; color:#c2410c; font-size:18px;">₽240</div>
                </div>
                <div class="card">
                    <strong style="font-size:20px;"><?php echo $currentLang === 'en' ? 'Cold Brew' : 'Колд-брю'; ?></strong>
                    <p style="color:#5b3417; margin-top:8px;"><?php echo $currentLang === 'en' ? 'Slow-steeped cold coffee, smooth and refreshing.' : 'Медленно заваренный холодный кофе, мягкий и освежающий.'; ?></p>
                    <div style="margin-top:12px; font-weight:800; color:#c2410c; font-size:18px;">₽200</div>
                </div>
            </div>
        </section>

        <!-- История -->
        <section class="section-block" id="story">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Our Story' : 'Наша история'; ?></h2>
            <div class="card" style="padding:32px;">
                <p style="color:#5b3417; line-height:1.8; font-size:18px;">
                    <?php echo $currentLang === 'en'
                        ? 'Northern Beans was born from a passion for exceptional coffee. We source the finest beans from around the world and roast them daily in small batches to ensure maximum flavor. Our cozy space in the old town welcomes coffee lovers to enjoy a perfect cup in a warm, inviting atmosphere.'
                        : 'Northern Beans родился из страсти к исключительному кофе. Мы закупаем лучшие зёрна со всего мира и обжариваем их ежедневно небольшими партиями, чтобы обеспечить максимальный вкус. Наше уютное пространство в старом городе приветствует любителей кофе, чтобы насладиться идеальной чашкой в тёплой, гостеприимной атмосфере.'; ?>
                </p>
            </div>
        </section>

        <!-- Форма заказа -->
        <section class="section-block" id="order-form">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Order for Pickup' : 'Заказ к приезду'; ?></h2>
            <form id="demoFormBeans" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Northern Beans - Order">
                <input type="hidden" name="service" value="coffee-order">
                <input type="hidden" name="type" value="order">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Your order details (items, quantities, pickup time)' : 'Детали заказа (позиции, количество, время получения)'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormBeansSubmit"><?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?></button>
                    <span id="demoFormBeansStatus" style="color:#5b3417;"></span>
                </div>
            </form>
        </section>

        <!-- Контактная форма -->
        <section class="section-block" id="contact-form">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Contact Us' : 'Свяжитесь с нами'; ?></h2>
            <form id="demoFormBeansContact" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Northern Beans - Contact">
                <input type="hidden" name="service" value="coffee-contact">
                <input type="hidden" name="type" value="contact">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Your message' : 'Ваше сообщение'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormBeansContactSubmit"><?php echo $currentLang === 'en' ? 'Send message' : 'Отправить сообщение'; ?></button>
                    <span id="demoFormBeansContactStatus" style="color:#5b3417;"></span>
                </div>
            </form>
        </section>

        <!-- Статистика -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Why choose us' : 'Почему выбирают нас'; ?></h2>
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
                    <p style="color:#5b3417;"><?php echo $currentLang === 'en' ? 'Customer rating' : 'Рейтинг клиентов'; ?></p>
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
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Frequently Asked Questions' : 'Часто задаваемые вопросы'; ?></h2>
            <div class="faq">
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Do you offer delivery?' : 'Есть ли доставка?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Yes, we offer delivery within the city center. Minimum order 500₽.' : 'Да, мы доставляем в пределах центра города. Минимальный заказ 500₽.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Can I book a table?' : 'Можно ли забронировать стол?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Yes, use the contact form or call us directly.' : 'Да, используйте контактную форму или позвоните нам напрямую.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'What are your opening hours?' : 'Какие часы работы?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'We are open daily from 8:00 to 22:00.' : 'Мы работаем ежедневно с 8:00 до 22:00.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Do you roast coffee on-site?' : 'Вы обжариваете кофе на месте?'; ?></strong><p style="margin-top:6px; color:#5b3417;"><?php echo $currentLang === 'en' ? 'Yes, we roast fresh beans daily in small batches for maximum flavor.' : 'Да, мы обжариваем свежие зёрна ежедневно небольшими партиями для максимального вкуса.'; ?></p></div>
            </div>
        </section>


        <!-- Why Choose Us -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Why choose us' : 'Почему выбирают нас'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:14px;">
                <div class="card" style="border-left:4px solid #f59e0b;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">☕</span>
                        <?php echo $currentLang === 'en' ? 'Fresh roasted daily' : 'Свежая обжарка каждый день'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'We roast our beans in small batches every morning to ensure maximum freshness and flavor.' : 'Мы обжариваем наши зёрна небольшими партиями каждое утро, чтобы обеспечить максимальную свежесть и вкус.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #f97316;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🌍</span>
                        <?php echo $currentLang === 'en' ? 'Premium beans' : 'Премиальные зёрна'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'We source the finest coffee beans from around the world, directly from trusted farmers.' : 'Мы закупаем лучшие кофейные зёрна со всего мира, напрямую у проверенных фермеров.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #f59e0b;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">👨‍🍳</span>
                        <?php echo $currentLang === 'en' ? 'Expert baristas' : 'Опытные бариста'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Our team consists of certified baristas passionate about creating the perfect cup.' : 'Наша команда состоит из сертифицированных бариста, увлечённых созданием идеальной чашки.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #f97316;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">❤️</span>
                        <?php echo $currentLang === 'en' ? 'Cozy atmosphere' : 'Уютная атмосфера'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#5b3417; line-height:1.6;"><?php echo $currentLang === 'en' ? 'A warm, inviting space where you can relax, work, or meet with friends.' : 'Тёплое, гостеприимное пространство, где вы можете расслабиться, поработать или встретиться с друзьями.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Customer Reviews -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What our customers say' : 'Что говорят наши клиенты'; ?></h2>
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

    </div>
</main>

<script>
    (function() {
        // Форма заказа
        const form = document.getElementById('demoFormBeans');
        if (form) {
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
                    statusEl.textContent = '<?php echo $currentLang === 'en' ? 'Order sent! We will contact you soon.' : 'Заказ отправлен! Мы свяжемся с вами в ближайшее время.'; ?>';
                    form.reset();
                } catch (err) {
                    statusEl.style.color = '#b91c1c';
                    statusEl.textContent = err.message;
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = '<?php echo $currentLang === 'en' ? 'Send order' : 'Отправить заказ'; ?>';
                }
            });
        }

        // Контактная форма
        const contactForm = document.getElementById('demoFormBeansContact');
        if (contactForm) {
            const submitBtnContact = document.getElementById('demoFormBeansContactSubmit');
            const statusElContact = document.getElementById('demoFormBeansContactStatus');

            contactForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                statusElContact.textContent = '';
                submitBtnContact.disabled = true;
                submitBtnContact.textContent = '<?php echo $currentLang === 'en' ? 'Sending...' : 'Отправляем...'; ?>';
                try {
                    const formData = new FormData(contactForm);
                    const res = await fetch('/backend/send.php', { method: 'POST', body: formData });
                    const data = await res.json().catch(() => ({}));
                    if (!res.ok || !data.success) {
                        throw new Error(data.message || '<?php echo $currentLang === 'en' ? 'Error sending' : 'Ошибка отправки'; ?>');
                    }
                    statusElContact.style.color = '#16a34a';
                    statusElContact.textContent = '<?php echo $currentLang === 'en' ? 'Message sent! We will reply soon.' : 'Сообщение отправлено! Мы ответим в ближайшее время.'; ?>';
                    contactForm.reset();
                } catch (err) {
                    statusElContact.style.color = '#b91c1c';
                    statusElContact.textContent = err.message;
                } finally {
                    submitBtnContact.disabled = false;
                    submitBtnContact.textContent = '<?php echo $currentLang === 'en' ? 'Send message' : 'Отправить сообщение'; ?>';
                }
            });
        }
    })();
</script>

<!-- Подключение улучшений для демо-проектов -->
<script src="/demo/demo-enhancements.js"></script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

