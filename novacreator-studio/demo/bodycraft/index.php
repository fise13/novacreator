<?php
$pageTitle = 'BodyCraft — demo';
$pageMetaTitle = $pageTitle;
$pageMetaDescription = 'Neon trainer landing: before/after and quiz placeholders, no logic.';
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
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>

