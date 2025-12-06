<?php
$pageTitle = 'UrbanFrame — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Construction landing demo: roadmap, price breakdown, disabled CTAs.';
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
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

