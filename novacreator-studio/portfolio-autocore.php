<?php
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = 'AutoCore (iOS + macOS)';
$pageMetaTitle = $currentLang === 'en'
    ? 'AutoCore Case Study | NovaCreator Studio'
    : 'Кейс AutoCore | NovaCreator Studio';
$pageMetaDescription = $currentLang === 'en'
    ? 'Complete AutoCore case study: native iOS/macOS architecture, synchronization model, and product UX decisions.'
    : 'Полный кейс AutoCore: нативная архитектура iOS/macOS, модель синхронизации и продуктовые UX-решения.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'autocore, ios macos case study, swiftui app'
    : 'autocore, кейс ios macos, swiftui приложение';

include 'includes/header.php';

$copy = [
    'back' => $currentLang === 'en' ? 'Back to Portfolio' : 'Назад в портфолио',
    'kicker' => $currentLang === 'en' ? 'Native Product Case' : 'Кейс нативного продукта',
    'intro' => $currentLang === 'en'
        ? 'AutoCore is a native iOS/macOS product built for day-to-day automotive workflows, with shared business logic and platform-specific UX.'
        : 'AutoCore - нативный продукт для iOS/macOS, созданный под ежедневные автомобильные процессы, с общей бизнес-логикой и платформенным UX.',
    'challengeTitle' => $currentLang === 'en' ? 'Challenge' : 'Задача',
    'challengeText' => $currentLang === 'en'
        ? 'Build one coherent product experience across mobile and desktop while preserving native interactions and reliable synchronized data.'
        : 'Построить единый продуктовый опыт для мобильной и десктопной платформ, сохранив нативные паттерны и надежную синхронизацию данных.',
    'solutionTitle' => $currentLang === 'en' ? 'What Was Implemented' : 'Что было реализовано',
    'solutionItems' => $currentLang === 'en'
        ? ['App state model for predictable screen transitions', 'Authentication flow with Firebase and Google Sign-In', 'macOS-specific window behavior and workspace controls']
        : ['Модель состояния приложения для предсказуемой навигации', 'Поток авторизации на Firebase и Google Sign-In', 'Отдельная логика окна и рабочего пространства для macOS'],
    'stackTitle' => $currentLang === 'en' ? 'Technology Stack' : 'Технологический стек',
    'resultTitle' => $currentLang === 'en' ? 'Outcome' : 'Результат',
    'resultText' => $currentLang === 'en'
        ? 'The product now runs as a unified platform across iOS and macOS, with clearer workflows and an architecture ready for new modules.'
        : 'Продукт работает как единая платформа на iOS и macOS, с более прозрачными сценариями работы и архитектурой, готовой к расширению.',
    'openRepo' => $currentLang === 'en' ? 'Open Repository' : 'Открыть репозиторий'
];
?>

<section class="portfolio-case-hero pt-28 md:pt-32 pb-12 md:pb-16" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <a class="portfolio-case-back" href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>">
                <?php echo htmlspecialchars($copy['back']); ?>
            </a>
            <p class="portfolio-case-kicker"><?php echo htmlspecialchars($copy['kicker']); ?></p>
            <h1 class="portfolio-case-title">AutoCore (iOS + macOS)</h1>
            <p class="portfolio-case-intro"><?php echo htmlspecialchars($copy['intro']); ?></p>
            <a class="portfolio-case-primary-link" href="https://github.com" target="_blank" rel="noopener noreferrer">
                <?php echo htmlspecialchars($copy['openRepo']); ?>
            </a>
        </div>
    </div>
</section>

<section class="portfolio-case-content pb-20 md:pb-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto portfolio-case-grid">
            <article class="portfolio-case-block">
                <h2><?php echo htmlspecialchars($copy['challengeTitle']); ?></h2>
                <p><?php echo htmlspecialchars($copy['challengeText']); ?></p>
            </article>

            <article class="portfolio-case-block">
                <h2><?php echo htmlspecialchars($copy['solutionTitle']); ?></h2>
                <ul>
                    <?php foreach ($copy['solutionItems'] as $item): ?>
                        <li><?php echo htmlspecialchars($item); ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>

            <article class="portfolio-case-block">
                <h2><?php echo htmlspecialchars($copy['stackTitle']); ?></h2>
                <div class="portfolio-case-tags">
                    <span>SwiftUI</span><span>Firebase</span><span>Google Sign-In</span><span>macOS AppKit Bridge</span>
                </div>
            </article>

            <article class="portfolio-case-block">
                <h2><?php echo htmlspecialchars($copy['resultTitle']); ?></h2>
                <p><?php echo htmlspecialchars($copy['resultText']); ?></p>
            </article>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
