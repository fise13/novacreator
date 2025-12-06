<?php
$pageTitle = 'Lakeview Hotel — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Bright booking mockup: filters, room cards, map placeholder. No booking logic.';
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
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

