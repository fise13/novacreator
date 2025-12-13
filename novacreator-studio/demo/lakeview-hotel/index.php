<?php
$pageTitle = 'Lakeview Hotel — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Bright booking mockup: filters, room cards, map placeholder. No booking logic.';
$ASSET_BASE_OVERRIDE = ''; // грузим ассеты из корня
require_once __DIR__ . '/../../includes/header.php';
$currentLang = getCurrentLanguage();
$back = getLocalizedUrl($currentLang, '/portfolio');
$ctaDemo = $currentLang === 'en' ? 'demo' : 'демо';
$badge = $currentLang === 'en' ? 'Demo layout' : 'Демо-макет';
$logicOff = $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена';
$note = $currentLang === 'en'
    ? 'Booking buttons, filters and map are decorative. Visual showcase only.'
    : 'Кнопки брони, фильтры и карта декоративные. Только визуальная витрина.';
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

    :root { --bg: #f1fbf8; --accent: #14b8a6; --accent2: #06b6d4; --text: #07312b; }
    .shell { background: radial-gradient(circle at 80% 12%, rgba(20,184,166,0.22), transparent 45%), var(--bg); color:var(--text); }
    .container { max-width: 1200px; margin:0 auto; padding:86px 20px 96px; }
    .nav { display:flex; justify-content:space-between; align-items:center; background:#fff; border:1px solid #d0f2eb; border-radius:16px; padding:14px 18px; box-shadow:0 18px 50px rgba(20,184,166,0.12); }
    .brand { display:flex; align-items:center; gap:10px; font-weight:800; }
    .links { display:flex; gap:12px; flex-wrap:wrap; }
    .links a { color:#0f766e; text-decoration:none; font-weight:700; }
    .links a.off { pointer-events:none; opacity:.55; }
    .hero { display:grid; grid-template-columns:1fr 1fr; gap:22px; align-items:start; margin-top:26px; }
    .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:#d9f7f1; color:#0f766e; font-weight:700; }
    .title { font-size:44px; line-height:1.1; margin:12px 0 10px; color:#065f46; }
    .lead { color:#0f3f38; line-height:1.65; max-width:560px; }
    .btn { border:none; border-radius:12px; padding:12px 16px; font-weight:800; cursor:not-allowed; opacity:.84; }
    .btn-main { background:linear-gradient(120deg,var(--accent),var(--accent2)); color:white; }
    .btn-ghost { background:#fff; border:1px solid var(--accent); color:#0f766e; }
    .card { background:#fff; border:1px solid #d0f2eb; border-radius:16px; padding:16px; box-shadow:0 12px 36px rgba(0,0,0,0.04); }
    .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; margin-top:14px; }
    .note { margin-top:16px; padding:14px; border-radius:14px; border:1px dashed var(--accent); background:#d9f7f1; color:#0f3f38; }
    .filters { background:#e9fbf7; border:1px solid #d0f2eb; border-radius:16px; padding:16px; margin-top:14px; }
    .room { background:linear-gradient(135deg, rgba(20,184,166,0.12), rgba(6,182,212,0.12)); border:1px solid rgba(20,184,166,0.25); border-radius:16px; padding:14px; box-shadow:0 12px 32px rgba(20,184,166,0.12); }
    .floaty { animation: floaty 7s ease-in-out infinite; }
    @keyframes floaty { 0%{transform:translateY(0);} 50%{transform:translateY(-10px);} 100%{transform:translateY(0);} }

    /* Дополнения */
    .section-block { margin-top: 42px; }
    .kpi-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .kpi-card { background:#fff; border:1px solid #d0f2eb; border-radius:16px; padding:16px; box-shadow:0 10px 32px rgba(20,184,166,0.12); }
    .kpi-value { font-size:32px; font-weight:800; color:#0f766e; }
    .screen-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; }
    .screen { background:#fff; border:1px dashed #bfeee4; border-radius:14px; padding:14px; min-height:150px; }
    .flow { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .flow-step { background:#fff; border:1px solid #d0f2eb; border-radius:14px; padding:14px; }
    .faq { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; }
    .faq-item { background:#fff; border:1px solid #d0f2eb; border-radius:14px; padding:14px; }
</style>

<main class="shell">
    <div class="container">
        <nav class="nav">
            <div class="brand">
                <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#14b8a6,#06b6d4);display:inline-block;"></span>
                <span>Lakeview Hotel</span>
            </div>
            <div class="links">
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Rooms' : 'Номера'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Experience' : 'Опыт'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Map' : 'Карта'; ?></a>
                <a href="<?php echo htmlspecialchars($back); ?>"><?php echo $backToPortfolio; ?></a>
            </div>
        </nav>

        <section class="hero">
            <div>
                <div class="pill">🏨 <?php echo $badge; ?> · <?php echo $logicOff; ?></div>
                <h1 class="title"><?php echo $currentLang === 'en' ? 'Calm mint booking layout' : 'Спокойный мятный макет бронирования'; ?></h1>
                <p class="lead">
                    <?php echo $currentLang === 'en'
                        ? 'Room finder, filters, room cards and map placeholder. Booking buttons stay disabled.'
                        : 'Подбор номера, фильтры, карточки и карта-плейсхолдер. Кнопки брони отключены.'; ?>
                </p>
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 16px;">
                    <button class="btn btn-main"><?php echo $currentLang === 'en' ? 'Book now' : 'Забронировать'; ?> · <?php echo $ctaDemo; ?></button>
                    <button class="btn btn-ghost"><?php echo $currentLang === 'en' ? 'Check availability' : 'Проверить даты'; ?> · <?php echo $ctaDemo; ?></button>
                </div>

                <div class="filters">
                    <h3 style="margin:0 0 10px;"><?php echo $currentLang === 'en' ? 'Filters (static)' : 'Фильтры (статик)'; ?></h3>
                    <div class="grid">
                        <div class="card"><?php echo $currentLang === 'en' ? 'Dates' : 'Даты'; ?></div>
                        <div class="card"><?php echo $currentLang === 'en' ? 'Guests' : 'Гости'; ?></div>
                        <div class="card"><?php echo $currentLang === 'en' ? 'Purpose' : 'Цель'; ?></div>
                    </div>
                </div>

                <div class="note"><?php echo $note; ?></div>
            </div>

            <div class="grid">
                <div class="room floaty">
                    <strong><?php echo $currentLang === 'en' ? 'Lake view suite' : 'Номер с видом на озеро'; ?></strong>
                    <p style="margin:6px 0 10px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Panoramic windows, breakfast included.' : 'Панорамные окна, завтрак включён.'; ?></p>
                    <?php echo buttonDisabled($currentLang === 'en' ? 'Book suite' : 'Забронировать номер'); ?>
                </div>
                <div class="room">
                    <strong><?php echo $currentLang === 'en' ? 'Family room' : 'Семейный'; ?></strong>
                    <p style="margin:6px 0 10px; color:#0f3f38;"><?php echo $currentLang === 'en' ? '2 bedrooms, workspace.' : '2 спальни, рабочая зона.'; ?></p>
                    <?php echo buttonDisabled($currentLang === 'en' ? 'Choose dates' : 'Выбрать даты'); ?>
                </div>
                <div class="room">
                    <strong><?php echo $currentLang === 'en' ? 'Workation studio' : 'Для удалёнки'; ?></strong>
                    <p style="margin:6px 0 10px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Fast Wi‑Fi, desk, coffee corner.' : 'Быстрый Wi‑Fi, стол, кофе-поинт.'; ?></p>
                    <?php echo buttonDisabled($currentLang === 'en' ? 'Check availability' : 'Проверить наличие'); ?>
                </div>
            </div>
        </section>

        <!-- Заявка -->
        <section class="section-block" id="demo-request">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Request a project' : 'Оставить заявку'; ?></h2>
            <form id="demoFormLake" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Demo: Lakeview Hotel">
                <input type="hidden" name="service" value="hotel-demo">
                <input type="hidden" name="type" value="contact">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Describe your booking task' : 'Опишите задачу по бронированию'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormLakeSubmit"><?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?></button>
                    <span id="demoFormLakeStatus" style="color:#0f3f38;"></span>
                </div>
            </form>
        </section>

        <!-- Показатели -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Metrics (demo data)' : 'Показатели (демо-данные)'; ?></h2>
            <div class="kpi-grid">
                <div class="kpi-card"><div class="kpi-value">+31%</div><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Search-to-book click' : 'Клики поиск→бронир.'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">2.2×</div><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Request rate' : 'Частота запросов'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">74s</div><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Time on page' : 'Время на странице'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">4.8</div><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Satisfaction (placeholder)' : 'Удовлетворённость (плейсхолдер)'; ?></p></div>
            </div>
        </section>

        <!-- Экраны -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Screens / pages' : 'Экраны / страницы'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Hero & filters' : 'Герой и фильтры'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Dates, guests, purpose.' : 'Даты, гости, цель.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Rooms' : 'Номера'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Room cards with badges.' : 'Карточки номеров с бейджами.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Details' : 'Детали'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Amenities, photos (static).' : 'Удобства, фото (статик).'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Map / Contacts' : 'Карта / Контакты'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Static map, contact info.' : 'Статичная карта, контакты.'; ?></p></div>
            </div>
        </section>

        <!-- Flow -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Flow</h2>
            <div class="flow">
                <div class="flow-step"><strong>1. Filters</strong><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Set dates/guests (static).' : 'Задаём даты/гостей (статик).'; ?></p></div>
                <div class="flow-step"><strong>2. Pick room</strong><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Choose card' : 'Выбор карточки'; ?></p></div>
                <div class="flow-step"><strong>3. CTA</strong><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Booking CTA disabled' : 'CTA брони отключена'; ?></p></div>
                <div class="flow-step"><strong>4. Info</strong><p style="color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Map & contacts placeholders' : 'Карта и контакты — плейсхолдеры'; ?></p></div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">FAQ</h2>
            <div class="faq">
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Is booking live?' : 'Работает бронь?'; ?></strong><p style="margin-top:6px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'No, demo only.' : 'Нет, демо.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Payments?' : 'Оплата?'; ?></strong><p style="margin-top:6px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Disabled in demo.' : 'Отключена в демо.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Availability?' : 'Наличие?'; ?></strong><p style="margin-top:6px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Placeholder only.' : 'Только плейсхолдер.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Go live?' : 'Запуск?'; ?></strong><p style="margin-top:6px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'We can connect real booking.' : 'Подключим реальную бронь.'; ?></p></div>
            </div>
        </section>

        <!-- Capabilities -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What we can ship' : 'Что можем реализовать'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Booking flow' : 'Бронирование'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Dates, guests, room selection.' : 'Даты, гости, выбор номера.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Rates & upsell' : 'Тарифы и апселл'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Packages, add-ons, late checkout.' : 'Пакеты, допы, поздний выезд.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Trust' : 'Доверие'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Reviews, safety, guarantees.' : 'Отзывы, безопасность, гарантии.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Local info' : 'Локальная инфо'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Map, transfer, activities.' : 'Карта, трансфер, активности.'; ?></p></div>
            </div>
        </section>

        <!-- Components -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Component library' : 'Библиотека компонентов'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Filters' : 'Фильтры'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Dates, guests, purpose.' : 'Даты, гости, цель.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Rooms' : 'Номера'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Cards, badges, amenities.' : 'Карточки, бейджи, удобства.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Details' : 'Детали'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Gallery, policies, FAQ.' : 'Галерея, правила, FAQ.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Map & contacts' : 'Карта и контакты'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Static map, contact options.' : 'Карта, способы связи.'; ?></p></div>
            </div>
        </section>

        <!-- Performance / SEO -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Performance / SEO</h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong>LCP</strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Hero, media lazyload.' : 'Hero, lazyload медиа.'; ?></p></div>
                <div class="card"><strong>CLS</strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Stable layout.' : 'Стабильный лейаут.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Schema' : 'Схемы'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Hotel, FAQ, Breadcrumb.' : 'Hotel, FAQ, Breadcrumb.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Tracking' : 'Трекинг'; ?></strong><p style="margin-top:8px; color:#0f3f38;"><?php echo $currentLang === 'en' ? 'Events: filter, room click, submit.' : 'События: фильтр, выбор номера, отправка.'; ?></p></div>
            </div>
        </section>

        <!-- Gallery / Visual Showcase -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Visual showcase' : 'Визуальная витрина'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#ecfdf5,#d1fae5);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#10b981,#059669); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Booking System' : 'Система бронирования'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Smart filters' : 'Умные фильтры'; ?></strong>
                    <p style="margin-top:8px; color:#065f46;"><?php echo $currentLang === 'en' ? 'Easy date selection, guest count, and room type filtering.' : 'Простой выбор дат, количества гостей и фильтрация по типу номера.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#ecfdf5,#d1fae5);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#059669,#047857); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Room Gallery' : 'Галерея номеров'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Beautiful rooms' : 'Красивые номера'; ?></strong>
                    <p style="margin-top:8px; color:#065f46;"><?php echo $currentLang === 'en' ? 'High-quality images showcasing each room with amenities and details.' : 'Высококачественные изображения каждого номера с удобствами и деталями.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#ecfdf5,#d1fae5);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#10b981,#059669); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Location Map' : 'Карта локации'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Easy navigation' : 'Простая навигация'; ?></strong>
                    <p style="margin-top:8px; color:#065f46;"><?php echo $currentLang === 'en' ? 'Interactive map showing hotel location and nearby attractions.' : 'Интерактивная карта с расположением отеля и близлежащими достопримечательностями.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Features & Benefits -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Key features' : 'Ключевые особенности'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:14px;">
                <div class="card" style="border-left:4px solid #10b981;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🏨</span>
                        <?php echo $currentLang === 'en' ? 'Room management' : 'Управление номерами'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#065f46; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Easy-to-update room inventory with availability calendar and pricing.' : 'Легко обновляемый инвентарь номеров с календарём доступности и ценами.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #059669;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">📅</span>
                        <?php echo $currentLang === 'en' ? 'Booking system' : 'Система бронирования'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#065f46; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Streamlined booking process with real-time availability checking.' : 'Оптимизированный процесс бронирования с проверкой доступности в реальном времени.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #10b981;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">📱</span>
                        <?php echo $currentLang === 'en' ? 'Mobile booking' : 'Мобильное бронирование'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#065f46; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Fully responsive design for seamless mobile booking experience.' : 'Полностью адаптивный дизайн для беспроблемного мобильного бронирования.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #059669;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">⭐</span>
                        <?php echo $currentLang === 'en' ? 'Guest reviews' : 'Отзывы гостей'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#065f46; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Integrated review system to build trust and showcase guest satisfaction.' : 'Встроенная система отзывов для укрепления доверия и демонстрации удовлетворённости гостей.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Testimonials / Reviews -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Guest reviews' : 'Отзывы гостей'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:#fff;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#10b981,#059669); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">M</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Michael P.' : 'Майкл П.'; ?></strong>
                            <span style="color:#047857; font-size:14px;"><?php echo $currentLang === 'en' ? 'Hotel Guest' : 'Гость отеля'; ?></span>
                        </div>
                    </div>
                    <p style="color:#065f46; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'Booking was so easy! The website is beautiful and user-friendly.' : 'Бронирование было таким простым! Сайт красивый и удобный.'; ?>"</p>
                    <div style="margin-top:12px; color:#fbbf24; font-size:18px;">★★★★★</div>
                </div>
                <div class="card" style="padding:24px; background:#fff;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#059669,#047857); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">A</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Anna W.' : 'Анна В.'; ?></strong>
                            <span style="color:#047857; font-size:14px;"><?php echo $currentLang === 'en' ? 'Hotel Manager' : 'Менеджер отеля'; ?></span>
                        </div>
                    </div>
                    <p style="color:#065f46; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'Direct bookings increased by 70%! The booking system works perfectly.' : 'Прямые бронирования выросли на 70%! Система бронирования работает отлично.'; ?>"</p>
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
                    <p style="margin-top:6px; color:#065f46; font-size:14px;"><?php echo $currentLang === 'en' ? 'Custom UI/UX' : 'Кастомный UI/UX'; ?></p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">💻</div>
                    <strong>Frontend</strong>
                    <p style="margin-top:6px; color:#065f46; font-size:14px;">HTML5, CSS3, JS</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">⚙️</div>
                    <strong>Backend</strong>
                    <p style="margin-top:6px; color:#065f46; font-size:14px;">PHP, MySQL</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">📊</div>
                    <strong>Analytics</strong>
                    <p style="margin-top:6px; color:#065f46; font-size:14px;">GA4, Events</p>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    (function() {
        const form = document.getElementById('demoFormLake');
        if (!form) return;
        const submitBtn = document.getElementById('demoFormLakeSubmit');
        const statusEl = document.getElementById('demoFormLakeStatus');

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

<!-- Подключение улучшений для демо-проектов -->
<script src="/demo/demo-enhancements.js"></script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

