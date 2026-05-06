<?php
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = 'Motor-Land.kz';
$pageMetaTitle = $currentLang === 'en'
    ? 'Motor-Land.kz Case Study | NovaCreator Studio'
    : 'Кейс Motor-Land.kz | NovaCreator Studio';
$pageMetaDescription = $currentLang === 'en'
    ? 'Complete case study of Motor-Land.kz: goals, UX decisions, architecture, and launch outcomes.'
    : 'Полный кейс Motor-Land.kz: цели, UX-решения, архитектура и результаты запуска.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'motor-land, web case study, nova creator portfolio'
    : 'motor-land, кейс сайта, портфолио nova creator';

include 'includes/header.php';

$copy = [
    'back' => $currentLang === 'en' ? 'Back to Portfolio' : 'Назад в портфолио',
    'kicker' => $currentLang === 'en' ? 'Web Product Case' : 'Кейс web-продукта',
    'intro' => $currentLang === 'en'
        ? 'Motor-Land.kz is a conversion-focused website for contract engines and auto parts, designed to guide users from search intent to lead submission in a few clear steps.'
        : 'Motor-Land.kz - конверсионный сайт по контрактным двигателям и автозапчастям, построенный так, чтобы провести пользователя от запроса до заявки за несколько понятных шагов.',
    'challengeTitle' => $currentLang === 'en' ? 'Challenge' : 'Задача',
    'challengeText' => $currentLang === 'en'
        ? 'The project needed a clear information hierarchy, fast-loading key screens, and trust elements that reduce friction before contact.'
        : 'Проекту требовалась четкая иерархия информации, быстрая загрузка ключевых экранов и блоки доверия, снижающие барьер перед обращением.',
    'solutionTitle' => $currentLang === 'en' ? 'What Was Implemented' : 'Что было реализовано',
    'solutionItems' => $currentLang === 'en'
        ? ['Catalog-first structure with clear user routes', 'Landing sections tuned for conversion and trust', 'Adaptive behavior for mobile traffic and lead forms']
        : ['Каталоговая структура с понятными сценариями перехода', 'Посадочные секции с акцентом на конверсию и доверие', 'Адаптивное поведение для мобильного трафика и форм'],
    'stackTitle' => $currentLang === 'en' ? 'Technology Stack' : 'Технологический стек',
    'resultTitle' => $currentLang === 'en' ? 'Outcome' : 'Результат',
    'resultText' => $currentLang === 'en'
        ? 'The platform now presents the offer faster, simplifies decision-making, and supports steady lead flow from high-intent traffic.'
        : 'Платформа стала быстрее объяснять предложение, упростила принятие решения для клиента и поддерживает стабильный поток целевых обращений.',
    'openSite' => $currentLang === 'en' ? 'Open Website' : 'Открыть сайт'
];
?>

<section class="portfolio-case-hero pt-28 md:pt-32 pb-12 md:pb-16" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <a class="portfolio-case-back" href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>">
                <?php echo htmlspecialchars($copy['back']); ?>
            </a>
            <p class="portfolio-case-kicker"><?php echo htmlspecialchars($copy['kicker']); ?></p>
            <h1 class="portfolio-case-title">Motor-Land.kz</h1>
            <p class="portfolio-case-intro"><?php echo htmlspecialchars($copy['intro']); ?></p>
            <a class="portfolio-case-primary-link" href="https://motor-land.kz" target="_blank" rel="noopener noreferrer">
                <?php echo htmlspecialchars($copy['openSite']); ?>
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
                    <span>PHP</span><span>Tailwind CSS</span><span>JavaScript</span><span>Responsive UI</span>
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
