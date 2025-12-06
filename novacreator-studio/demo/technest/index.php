<?php
$pageTitle = 'TechNest — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Clean tech store mockup: catalog, PDP, cart visuals, no payments.';
$ASSET_BASE_OVERRIDE = ''; // грузим ассеты из корня
require_once __DIR__ . '/../../includes/header.php';
$currentLang = getCurrentLanguage();
$back = getLocalizedUrl($currentLang, '/portfolio');
$ctaDemo = $currentLang === 'en' ? 'demo' : 'демо';
$badge = $currentLang === 'en' ? 'Demo layout' : 'Демо-макет';
$logicOff = $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена';
$note = $currentLang === 'en'
    ? 'Cart, checkout and filters are decorative. Payments/forms disabled.'
    : 'Корзина, чекаут и фильтры декоративны. Оплаты/формы отключены.';
?>

<style>
    /* Компактный header для демо */
    #mainNavbar { padding-top: 0 !important; padding-bottom: 0 !important; }
    #mainNavbar .container { padding-top: 8px; padding-bottom: 8px; }
    #mainNavbar .flex.items-center.justify-between { height: 62px !important; }
    #mainNavbar img { width: 40px !important; height: 40px !important; }
    #mainNavbar span.text-gradient { font-size: 1.05rem !important; }

    :root { --bg: #f2f7fb; --accent: #0ea5e9; --accent2: #6366f1; --text: #0b1624; }
    .shell { background: radial-gradient(circle at 25% 10%, rgba(99,102,241,0.14), transparent 40%), var(--bg); color:var(--text); }
    .container { max-width: 1220px; margin:0 auto; padding:86px 20px 96px; }
    .nav { display:flex; justify-content:space-between; align-items:center; background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:14px 18px; box-shadow:0 18px 50px rgba(14,165,233,0.08); }
    .brand { display:flex; align-items:center; gap:10px; font-weight:800; }
    .links { display:flex; gap:12px; flex-wrap:wrap; }
    .links a { color:#0ea5e9; text-decoration:none; font-weight:700; }
    .links a.off { pointer-events:none; opacity:.55; }
    .hero { display:grid; grid-template-columns:1.05fr 0.95fr; gap:22px; align-items:center; margin-top:26px; }
    .pill { display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px; background:#e0f2fe; color:#0ea5e9; font-weight:700; }
    .title { font-size:44px; line-height:1.1; margin:12px 0 10px; color:#0b1624; }
    .lead { color:#334155; line-height:1.65; max-width:560px; }
    .btn { border:none; border-radius:12px; padding:12px 16px; font-weight:800; cursor:not-allowed; opacity:.82; }
    .btn-main { background:linear-gradient(120deg,#0ea5e9,#6366f1); color:white; }
    .btn-ghost { background:#fff; border:1px solid #0ea5e9; color:#0ea5e9; }
    .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; margin-top:14px; }
    .card { background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:16px; box-shadow:0 12px 40px rgba(0,0,0,0.04); }
    .note { margin-top:16px; padding:14px; border-radius:14px; border:1px dashed #0ea5e9; background:#e0f2fe; color:#0b1624; }
    .mock { position:relative; height:340px; border-radius:18px; background:#fff; border:1px solid #e2e8f0; box-shadow:0 18px 50px rgba(14,165,233,0.12); overflow:hidden; }
    .mock .bar { position:absolute; left:18px; right:18px; height:48px; border-radius:12px; background:linear-gradient(135deg,#e0f2fe,#e9d5ff); top:22px; }
    .mock .pdp { position:absolute; left:18px; right:18px; top:90px; height:70px; border-radius:12px; background:#0f172a; opacity:.9; }
    .mock .cta { position:absolute; bottom:24px; left:18px; width:140px; height:44px; border-radius:12px; background:linear-gradient(120deg,#0ea5e9,#6366f1); }
    .mock .cta-ghost { position:absolute; bottom:24px; right:18px; width:140px; height:44px; border-radius:12px; border:1px solid #0ea5e9; }
    .floaty { animation: floaty 7s ease-in-out infinite; }
    @keyframes floaty { 0%{transform:translateY(0);} 50%{transform:translateY(-10px);} 100%{transform:translateY(0);} }

    /* Дополнения */
    .section-block { margin-top: 42px; }
    .kpi-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .kpi-card { background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:16px; box-shadow:0 10px 28px rgba(0,0,0,0.04); }
    .kpi-value { font-size:32px; font-weight:800; color:#0ea5e9; }
    .screen-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px; }
    .screen { background:#fff; border:1px dashed #cbd5e1; border-radius:14px; padding:14px; min-height:150px; }
    .flow { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:12px; }
    .flow-step { background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:14px; }
    .faq { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px; }
    .faq-item { background:#fff; border:1px solid #e2e8f0; border-radius:14px; padding:14px; }
</style>

<main class="shell">
    <div class="container">
        <nav class="nav">
            <div class="brand">
                <span style="width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#0ea5e9,#6366f1);display:inline-block;"></span>
                <span>TechNest</span>
            </div>
            <div class="links">
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Catalog' : 'Каталог'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Deals' : 'Акции'; ?></a>
                <a class="off" href="#"><?php echo $currentLang === 'en' ? 'Support' : 'Поддержка'; ?></a>
                <a href="<?php echo htmlspecialchars($back); ?>"><?php echo $backToPortfolio; ?></a>
            </div>
        </nav>

        <section class="hero">
            <div>
                <div class="pill">🛒 <?php echo $badge; ?> · <?php echo $logicOff; ?></div>
                <h1 class="title"><?php echo $currentLang === 'en' ? 'Tech store UX without payment logic' : 'UX тех-магазина без логики оплаты'; ?></h1>
                <p class="lead">
                    <?php echo $currentLang === 'en'
                        ? 'Catalog grid, product card, recommendations and cart visuals. Filters, buttons and checkout are inert.'
                        : 'Каталог, карточка товара, рекомендации и корзина визуально. Фильтры, кнопки и чекаут неактивны.'; ?>
                </p>
                <div style="display:flex; gap:10px; flex-wrap:wrap; margin:14px 0 16px;">
                    <button class="btn btn-main"><?php echo $currentLang === 'en' ? 'Add to cart' : 'В корзину'; ?> · <?php echo $ctaDemo; ?></button>
                    <button class="btn btn-ghost"><?php echo $currentLang === 'en' ? 'Buy now' : 'Купить сейчас'; ?> · <?php echo $ctaDemo; ?></button>
                </div>
                <div class="grid">
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Filters' : 'Фильтры'; ?></strong>
                        <p style="color:#475569;"><?php echo $currentLang === 'en' ? 'Brand, price, spec toggles — decorative.' : 'Бренд, цена, характеристики — декоративны.'; ?></p>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Product card' : 'Карточка товара'; ?></strong>
                        <p style="color:#475569;"><?php echo $currentLang === 'en' ? 'Gallery and specs placeholder.' : 'Галерея и спеки — плейсхолдер.'; ?></p>
                    </div>
                    <div class="card">
                        <strong><?php echo $currentLang === 'en' ? 'Cart / Checkout' : 'Корзина / Чекаут'; ?></strong>
                        <p style="color:#475569;"><?php echo $currentLang === 'en' ? 'Totals, delivery, payment steps are visual only.' : 'Итоги, доставка, оплата только визуально.'; ?></p>
                    </div>
                </div>
                <div class="note"><?php echo $note; ?></div>
            </div>
            <div class="mock floaty" aria-hidden="true">
                <div class="bar"></div>
                <div class="pdp"></div>
                <div class="cta"></div>
                <div class="cta-ghost"></div>
            </div>
        </section>

        <!-- Показатели -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Metrics (demo data)' : 'Показатели (демо-данные)'; ?></h2>
            <div class="kpi-grid">
                <div class="kpi-card"><div class="kpi-value">+35%</div><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'CTR catalog → PDP' : 'CTR каталог → PDP'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">2.4×</div><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'Add-to-cart rate' : 'Добавление в корзину'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">68s</div><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'Time on PDP' : 'Время на PDP'; ?></p></div>
                <div class="kpi-card"><div class="kpi-value">4.8</div><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'UX satisfaction (placeholder)' : 'Удовлетворённость UX (плейсхолдер)'; ?></p></div>
            </div>
        </section>

        <!-- Экраны -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Screens / pages' : 'Экраны / страницы'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong>Catalog</strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'Filters, sort (decorative).' : 'Фильтры, сортировка (декор).'; ?></p></div>
                <div class="screen"><strong>PDP</strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'Gallery, specs, recommendations.' : 'Галерея, спеки, рекомендации.'; ?></p></div>
                <div class="screen"><strong>Cart</strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'Totals, delivery steps (static).' : 'Итоги, шаги доставки (статик).'; ?></p></div>
                <div class="screen"><strong>Support</strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'FAQ, contacts.' : 'FAQ, контакты.'; ?></p></div>
            </div>
        </section>

        <!-- Flow -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Flow</h2>
            <div class="flow">
                <div class="flow-step"><strong>1. Catalog</strong><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'Browse / filter (static).' : 'Смотрим / фильтруем (статик).'; ?></p></div>
                <div class="flow-step"><strong>2. PDP</strong><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'Specs, upsell (demo).' : 'Спеки, апселл (демо).'; ?></p></div>
                <div class="flow-step"><strong>3. Cart</strong><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'Totals placeholder.' : 'Итоги плейсхолдер.'; ?></p></div>
                <div class="flow-step"><strong>4. Checkout</strong><p style="color:#334155;"><?php echo $currentLang === 'en' ? 'Payment disabled.' : 'Оплата отключена.'; ?></p></div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">FAQ</h2>
            <div class="faq">
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Are filters live?' : 'Фильтры работают?'; ?></strong><p style="margin-top:6px; color:#334155;"><?php echo $currentLang === 'en' ? 'Decorative only.' : 'Только декоративно.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Payments?' : 'Оплаты?'; ?></strong><p style="margin-top:6px; color:#334155;"><?php echo $currentLang === 'en' ? 'Disabled in demo.' : 'Отключены в демо.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'User accounts?' : 'Аккаунты?'; ?></strong><p style="margin-top:6px; color:#334155;"><?php echo $currentLang === 'en' ? 'Not connected.' : 'Не подключены.'; ?></p></div>
                <div class="faq-item"><strong><?php echo $currentLang === 'en' ? 'Can go live?' : 'Запуск?'; ?></strong><p style="margin-top:6px; color:#334155;"><?php echo $currentLang === 'en' ? 'Yes, can wire payments later.' : 'Да, можем подключить оплаты позже.'; ?></p></div>
            </div>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

