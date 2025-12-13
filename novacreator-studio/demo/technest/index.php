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

        <!-- Заявка -->
        <section class="section-block" id="demo-request">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Request a project' : 'Оставить заявку'; ?></h2>
            <form id="demoFormTech" class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:12px;">
                <input type="hidden" name="form_name" value="Demo: TechNest">
                <input type="hidden" name="service" value="store-demo">
                <input type="hidden" name="type" value="contact">
                <input type="text" name="name" placeholder="<?php echo $currentLang === 'en' ? 'Name' : 'Имя'; ?>" required class="card" style="min-height:60px;">
                <input type="tel" name="phone" placeholder="<?php echo $currentLang === 'en' ? 'Phone' : 'Телефон'; ?>" required class="card" style="min-height:60px;">
                <input type="email" name="email" placeholder="Email" required class="card" style="min-height:60px;">
                <input type="text" name="website" value="" autocomplete="off" style="display:none;">
                <textarea name="message" placeholder="<?php echo $currentLang === 'en' ? 'Describe your store task' : 'Опишите задачу для магазина'; ?>" required class="card" style="min-height:120px; grid-column:1/-1;"></textarea>
                <div style="grid-column:1/-1; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    <button type="submit" class="btn btn-main" id="demoFormTechSubmit"><?php echo $currentLang === 'en' ? 'Send request' : 'Отправить'; ?></button>
                    <span id="demoFormTechStatus" style="color:#0ea5e9;"></span>
                </div>
            </form>
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

        <!-- Capabilities -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'What we can ship' : 'Что можем реализовать'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:12px;">
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Catalog UX' : 'UX каталога'; ?></strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Facets, badges, promos, quick-view.' : 'Фасеты, бейджи, промо, квик-вью.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'PDP depth' : 'Глубина PDP'; ?></strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Comparisons, bundles, cross/upsell.' : 'Сравнения, бандлы, кросс/апселл.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Checkout UX' : 'UX чекаута'; ?></strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? '1–2 steps, delivery/payment matrix.' : '1–2 шага, матрица доставки/оплаты.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Integrations' : 'Интеграции'; ?></strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'CRM/ERP, payments, analytics (on go-live).' : 'CRM/ERP, оплаты, аналитика (в проде).'; ?></p></div>
            </div>
        </section>

        <!-- Components -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Component library' : 'Библиотека компонентов'; ?></h2>
            <div class="screen-grid">
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Cards' : 'Карточки'; ?></strong><p style="margin-top:8px; color:#334155;">SKU, promo, rating, stock.</p></div>
                <div class="screen"><strong>Filters</strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'Price slider, brand, specs.' : 'Цена, бренд, характеристики.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Cart widgets' : 'Виджеты корзины'; ?></strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'Mini-cart, promo code, delivery calc.' : 'Мини-корзина, промокод, доставка.'; ?></p></div>
                <div class="screen"><strong><?php echo $currentLang === 'en' ? 'Support' : 'Поддержка'; ?></strong><p style="margin-top:8px; color:#334155;"><?php echo $currentLang === 'en' ? 'FAQ, chat hook, returns info.' : 'FAQ, чат-хук, возвраты.'; ?></p></div>
            </div>
        </section>

        <!-- Performance & SEO -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;">Performance / SEO</h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:12px;">
                <div class="card"><strong>LCP</strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Hero optimization, lazy images.' : 'Оптимизация hero, lazy изображений.'; ?></p></div>
                <div class="card"><strong>CLS</strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Reserved spaces, stable UI.' : 'Резерв мест, стабильный UI.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Schema' : 'Схемы'; ?></strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Product, Breadcrumb, FAQ, Offer.' : 'Product, Breadcrumb, FAQ, Offer.'; ?></p></div>
                <div class="card"><strong><?php echo $currentLang === 'en' ? 'Tracking' : 'Трекинг'; ?></strong><p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Events: view, add-to-cart, checkout steps.' : 'События: просмотр, корзина, шаги чекаута.'; ?></p></div>
            </div>
        </section>

        <!-- Gallery / Visual Showcase -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Visual showcase' : 'Визуальная витрина'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#f1f5f9,#e2e8f0);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#3b82f6,#2563eb); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Product Catalog' : 'Каталог товаров'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Smart filtering' : 'Умная фильтрация'; ?></strong>
                    <p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Advanced filters by price, brand, specs, and ratings.' : 'Продвинутые фильтры по цене, бренду, характеристикам и рейтингам.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#f1f5f9,#e2e8f0);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#8b5cf6,#7c3aed); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Shopping Cart' : 'Корзина покупок'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Seamless checkout' : 'Беспроблемный чекаут'; ?></strong>
                    <p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Intuitive cart with promo codes and delivery options.' : 'Интуитивная корзина с промокодами и вариантами доставки.'; ?></p>
                </div>
                <div class="card" style="padding:24px; background:linear-gradient(135deg,#f1f5f9,#e2e8f0);">
                    <div style="width:100%; height:180px; background:linear-gradient(135deg,#06b6d4,#0891b2); border-radius:12px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;"><?php echo $currentLang === 'en' ? 'Product Details' : 'Детали товара'; ?></div>
                    <strong><?php echo $currentLang === 'en' ? 'Rich product pages' : 'Насыщенные страницы товаров'; ?></strong>
                    <p style="margin-top:8px; color:#475569;"><?php echo $currentLang === 'en' ? 'Detailed specs, reviews, related items, and recommendations.' : 'Подробные характеристики, отзывы, похожие товары и рекомендации.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Features & Benefits -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Key features' : 'Ключевые особенности'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:14px;">
                <div class="card" style="border-left:4px solid #3b82f6;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🛒</span>
                        <?php echo $currentLang === 'en' ? 'E-commerce ready' : 'Готов к продажам'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#475569; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Full shopping cart functionality with inventory management and order tracking.' : 'Полнофункциональная корзина с управлением запасами и отслеживанием заказов.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #8b5cf6;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">🔍</span>
                        <?php echo $currentLang === 'en' ? 'Advanced search' : 'Продвинутый поиск'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#475569; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Powerful search with filters, sorting, and smart recommendations.' : 'Мощный поиск с фильтрами, сортировкой и умными рекомендациями.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #06b6d4;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">📱</span>
                        <?php echo $currentLang === 'en' ? 'Mobile optimized' : 'Мобильная оптимизация'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#475569; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Perfect shopping experience on smartphones and tablets.' : 'Идеальный опыт покупок на смартфонах и планшетах.'; ?></p>
                </div>
                <div class="card" style="border-left:4px solid #3b82f6;">
                    <strong style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:24px;">⚡</span>
                        <?php echo $currentLang === 'en' ? 'Fast performance' : 'Быстрая работа'; ?>
                    </strong>
                    <p style="margin-top:10px; color:#475569; line-height:1.6;"><?php echo $currentLang === 'en' ? 'Optimized for speed with lazy loading and efficient caching.' : 'Оптимизировано для скорости с ленивой загрузкой и эффективным кешированием.'; ?></p>
                </div>
            </div>
        </section>

        <!-- Testimonials / Reviews -->
        <section class="section-block">
            <h2 class="title" style="font-size:30px; margin-bottom:12px;"><?php echo $currentLang === 'en' ? 'Client feedback' : 'Отзывы клиентов'; ?></h2>
            <div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:16px;">
                <div class="card" style="padding:24px; background:#fff;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#3b82f6,#2563eb); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">D</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'David R.' : 'Давид Р.'; ?></strong>
                            <span style="color:#64748b; font-size:14px;"><?php echo $currentLang === 'en' ? 'Tech Store Owner' : 'Владелец техно-магазина'; ?></span>
                        </div>
                    </div>
                    <p style="color:#475569; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'Sales increased by 85% after launch. The filtering system is amazing!' : 'Продажи выросли на 85% после запуска. Система фильтрации потрясающая!'; ?>"</p>
                    <div style="margin-top:12px; color:#fbbf24; font-size:18px;">★★★★★</div>
                </div>
                <div class="card" style="padding:24px; background:#fff;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg,#8b5cf6,#7c3aed); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:18px;">E</div>
                        <div>
                            <strong style="display:block;"><?php echo $currentLang === 'en' ? 'Emma T.' : 'Эмма Т.'; ?></strong>
                            <span style="color:#64748b; font-size:14px;"><?php echo $currentLang === 'en' ? 'E-commerce Manager' : 'Менеджер интернет-магазина'; ?></span>
                        </div>
                    </div>
                    <p style="color:#475569; line-height:1.7; font-style:italic;">"<?php echo $currentLang === 'en' ? 'The checkout process is so smooth. Customer satisfaction is through the roof!' : 'Процесс оформления заказа такой плавный. Удовлетворённость клиентов зашкаливает!'; ?>"</p>
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
                    <p style="margin-top:6px; color:#475569; font-size:14px;"><?php echo $currentLang === 'en' ? 'Custom UI/UX' : 'Кастомный UI/UX'; ?></p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">💻</div>
                    <strong>Frontend</strong>
                    <p style="margin-top:6px; color:#475569; font-size:14px;">HTML5, CSS3, JS</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">⚙️</div>
                    <strong>Backend</strong>
                    <p style="margin-top:6px; color:#475569; font-size:14px;">PHP, MySQL</p>
                </div>
                <div class="card" style="text-align:center; padding:20px;">
                    <div style="font-size:32px; margin-bottom:8px;">📊</div>
                    <strong>Analytics</strong>
                    <p style="margin-top:6px; color:#475569; font-size:14px;">GA4, Events</p>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    (function() {
        const form = document.getElementById('demoFormTech');
        if (!form) return;
        const submitBtn = document.getElementById('demoFormTechSubmit');
        const statusEl = document.getElementById('demoFormTechStatus');

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

