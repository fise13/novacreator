<?php
/**
 * Демо-страницы портфолио: статичные макеты без бизнес-логики
 * Доступ: /demo.php?project={slug}
 */
require_once __DIR__ . '/includes/i18n.php';

$currentLang = getCurrentLanguage();

$demos = [
    'northern-beans' => [
        'accent' => '#8B5CF6',
        'accentAlt' => '#22D3EE',
        'title' => [
            'ru' => 'Кофейня “Northern Beans” — демо',
            'en' => 'Coffee shop “Northern Beans” — demo',
        ],
        'subtitle' => [
            'ru' => 'Атмосферный одностраничник с меню и заказом к приезду. Все кнопки отключены — это витрина макета.',
            'en' => 'Atmospheric one-page layout with menu and pickup CTA. All buttons are disabled — pure layout preview.',
        ],
        'description' => [
            'ru' => 'Статичный макет кофейни с героем, меню и блоком отзывов. Никакие формы и покупки не работают.',
            'en' => 'Static coffee shop layout with hero, menu and reviews. No forms or purchases are active.',
        ],
        'category' => [
            'ru' => 'Лендинг кофейни',
            'en' => 'Coffee shop landing',
        ],
        'heroPoints' => [
            'ru' => [
                'Герой с фото, оффером и CTA “Заказать к приезду”.',
                'Блок меню с фильтрами по крепости и молоку (заглушка).',
                'Отзывы заведения и карта — клики заблокированы.',
            ],
            'en' => [
                'Hero with photo, offer and “Order for pickup” CTA.',
                'Menu grid with strength/milk filters (placeholder).',
                'Reviews and map blocks — clicks are disabled.',
            ],
        ],
        'sections' => [
            [
                'title' => ['ru' => 'Hero + меню', 'en' => 'Hero + menu'],
                'text' => [
                    'ru' => 'Герой с коротким оффером и кнопкой заказа, под ним статичный прелоадер меню.',
                    'en' => 'Hero with concise offer and order button, below — static menu preview.',
                ],
                'chips' => ['Hero фото', 'CTA заглушка', 'Меню плейсхолдеры', 'Теги вкуса'],
            ],
            [
                'title' => ['ru' => 'Спешиалти и сезон', 'en' => 'Specialty & seasonal'],
                'text' => [
                    'ru' => 'Карточки напитков, бэйджи “seasonal”, кнопка “добавить в заказ” выключена.',
                    'en' => 'Drink cards with “seasonal” badge; “add to order” button is disabled.',
                ],
                'chips' => ['Сезонные теги', 'Цена-пустышка', 'Кнопки off', 'Лейаут 3 колонки'],
            ],
            [
                'title' => ['ru' => 'Отзывы и карта', 'en' => 'Reviews & map'],
                'text' => [
                    'ru' => 'Секция доверия с статичными отзывами и картой без кликов.',
                    'en' => 'Trust section with static reviews and a non-interactive map.',
                ],
                'chips' => ['Отзывы', 'Локация', 'Невидимые клики', 'Маркер кофейни'],
            ],
        ],
        'ctas' => [
            'ru' => ['Заказать к приезду', 'Выбрать зерно'],
            'en' => ['Order for pickup', 'Choose beans'],
        ],
    ],
    'bodycraft' => [
        'accent' => '#22C55E',
        'accentAlt' => '#10B981',
        'title' => [
            'ru' => 'Персональный тренер “BodyCraft” — демо',
            'en' => 'Personal trainer “BodyCraft” — demo',
        ],
        'subtitle' => [
            'ru' => 'Лендинг тренера с оффером, до/после и квизом-заглушкой. Все формы отключены.',
            'en' => 'Trainer landing with offer, before/after, and quiz placeholders. All forms are off.',
        ],
        'description' => [
            'ru' => 'Статичная версия лендинга: история клиента, блоки преимуществ, нерабочий квиз.',
            'en' => 'Static landing: client story, benefits and a non-working quiz.',
        ],
        'category' => [
            'ru' => 'Личный бренд',
            'en' => 'Personal brand',
        ],
        'heroPoints' => [
            'ru' => [
                'Оффер “3 тренировки в неделю по 40 минут”.',
                'Блок трансформаций “до/после” — изображения плейсхолдеры.',
                'Кнопки “Записаться” и квиз выключены.',
            ],
            'en' => [
                'Offer “3 workouts per week for 40 minutes”.',
                'Before/after transformations use placeholder frames.',
                'Buttons “Enroll” and quiz are disabled.',
            ],
        ],
        'sections' => [
            [
                'title' => ['ru' => 'Герой + позиционирование', 'en' => 'Hero + positioning'],
                'text' => [
                    'ru' => 'Короткий оффер, список боли, кнопка “Начать” с отключёнными событиями.',
                    'en' => 'Short offer, pain list, “Start” button with disabled actions.',
                ],
                'chips' => ['Оффер', 'Боли', 'CTA off', 'Аватар тренера'],
            ],
            [
                'title' => ['ru' => 'До / После', 'en' => 'Before / After'],
                'text' => [
                    'ru' => 'Галерея прогресса: до/после и факторы успеха, переключатели не работают.',
                    'en' => 'Progress gallery with before/after; toggles are inert.',
                ],
                'chips' => ['Свайпы off', 'Карточки кейсов', 'Тайминги', 'Маркеры результата'],
            ],
            [
                'title' => ['ru' => 'Квиз-приманка', 'en' => 'Lead quiz'],
                'text' => [
                    'ru' => 'Мини-квиз из 3 шагов в виде заглушки, кнопка “Отправить” disabled.',
                    'en' => '3-step quiz placeholder; “Submit” button disabled.',
                ],
                'chips' => ['3 шага', 'Прогресс-бар', 'CTA off', 'Поле телефона off'],
            ],
        ],
        'ctas' => [
            'ru' => ['Записаться', 'Получить план'],
            'en' => ['Enroll now', 'Get the plan'],
        ],
    ],
    'urbanframe' => [
        'accent' => '#F97316',
        'accentAlt' => '#F59E0B',
        'title' => [
            'ru' => 'Застройщик “UrbanFrame” — демо',
            'en' => 'Developer “UrbanFrame” — demo',
        ],
        'subtitle' => [
            'ru' => 'Лендинг строительства домов с дорожной картой и прозрачной ценой. Кнопки заглушены.',
            'en' => 'Construction landing with roadmap and transparent pricing. Buttons are placeholders.',
        ],
        'description' => [
            'ru' => 'Пошаговая карта проекта, блоки цены и гарантий. Формы не отправляются.',
            'en' => 'Step-by-step project map, pricing and guarantees. Forms do not submit.',
        ],
        'category' => [
            'ru' => 'Лендинг застройщика',
            'en' => 'Developer landing',
        ],
        'heroPoints' => [
            'ru' => [
                'Пошаговая дорожная карта 4 шага.',
                'Блок “что входит в цену” — статичный чек-лист.',
                'CTA “Рассчитать” и форма — отключены.',
            ],
            'en' => [
                '4-step delivery roadmap.',
                '“What’s included” static checklist.',
                'CTA “Calculate” and form are disabled.',
            ],
        ],
        'sections' => [
            [
                'title' => ['ru' => 'Дорожная карта', 'en' => 'Roadmap'],
                'text' => [
                    'ru' => '4 шага с иконками: замер, проект, строительство, сдача. Клики off.',
                    'en' => '4 steps with icons: survey, design, build, handover. Clicks off.',
                ],
                'chips' => ['4 шага', 'Иконки', 'CTA off', 'Статичная линия'],
            ],
            [
                'title' => ['ru' => 'Цена без сюрпризов', 'en' => 'Price breakdown'],
                'text' => [
                    'ru' => 'Разбивка по этапам: фундамент, коробка, инженерка. Кнопки неактивны.',
                    'en' => 'Stages: foundation, frame, engineering. Buttons inactive.',
                ],
                'chips' => ['Фундамент', 'Коробка', 'Инженерка', 'Гарантия'],
            ],
            [
                'title' => ['ru' => 'Доверие', 'en' => 'Trust'],
                'text' => [
                    'ru' => 'Документы, лицензии, фото объектов — все ссылки заглушки.',
                    'en' => 'Docs, licenses, site photos — all links are placeholders.',
                ],
                'chips' => ['PDF off', 'Фото объектов', 'Лицензии', 'Контакты off'],
            ],
        ],
        'ctas' => [
            'ru' => ['Рассчитать стоимость', 'Получить смету'],
            'en' => ['Calculate cost', 'Get estimate'],
        ],
    ],
    'technest' => [
        'accent' => '#0EA5E9',
        'accentAlt' => '#6366F1',
        'title' => [
            'ru' => 'Интернет-магазин “TechNest” — демо',
            'en' => 'E‑commerce “TechNest” — demo',
        ],
        'subtitle' => [
            'ru' => 'Каталог, карточка товара, корзина и чек-аут — всё статично, оплаты нет.',
            'en' => 'Catalog, PDP, cart and checkout are static; no payments here.',
        ],
        'description' => [
            'ru' => 'UX-магазин без логики: фильтры, рекомендации и корзина-плейсхолдер.',
            'en' => 'UX store without logic: filters, recommendations and cart placeholders.',
        ],
        'category' => [
            'ru' => 'E‑commerce',
            'en' => 'E‑commerce',
        ],
        'heroPoints' => [
            'ru' => [
                'Каталог с фильтрами по бренду и цене (не работают).',
                'Карточка товара с рекомендациями и “часто покупают вместе”.',
                'Корзина и чек-аут отключены от оплат.',
            ],
            'en' => [
                'Catalog with brand/price filters (disabled).',
                'PDP with recommendations and “often bought together”.',
                'Cart and checkout detached from payments.',
            ],
        ],
        'sections' => [
            [
                'title' => ['ru' => 'Каталог', 'en' => 'Catalog'],
                'text' => [
                    'ru' => 'Сетка карточек, фильтры и сортировка — все контролы неактивны.',
                    'en' => 'Grid, filters and sort — all controls inactive.',
                ],
                'chips' => ['Фильтры off', 'Сортировка off', 'Карточки', 'Бейдж скидки'],
            ],
            [
                'title' => ['ru' => 'Карточка товара', 'en' => 'Product page'],
                'text' => [
                    'ru' => 'Галерея, характеристики, рекомендации. “Купить” не работает.',
                    'en' => 'Gallery, specs, recommendations. “Buy” does not work.',
                ],
                'chips' => ['Галерея off', 'Характеристики', 'Реком.', 'Отзывы макет'],
            ],
            [
                'title' => ['ru' => 'Корзина / Чек-аут', 'en' => 'Cart / Checkout'],
                'text' => [
                    'ru' => 'Режим прототипа: шаги доставки, оплаты и итог — без логики.',
                    'en' => 'Prototype mode: shipping, payment and totals — no logic.',
                ],
                'chips' => ['Шаги', 'Форма off', 'Totals макет', 'Кнопка pay off'],
            ],
        ],
        'ctas' => [
            'ru' => ['Добавить в корзину', 'Купить сейчас'],
            'en' => ['Add to cart', 'Buy now'],
        ],
    ],
    'lakeview-hotel' => [
        'accent' => '#14B8A6',
        'accentAlt' => '#06B6D4',
        'title' => [
            'ru' => 'Бутик-отель “Lakeview” — демо',
            'en' => 'Boutique hotel “Lakeview” — demo',
        ],
        'subtitle' => [
            'ru' => 'Подбор номера, фильтры, календарь и бронирование — всё статично.',
            'en' => 'Room finder, filters, calendar and booking — all static.',
        ],
        'description' => [
            'ru' => 'Демо сайта бронирования: карточки номеров, фильтры, карта. Бронь не отправляется.',
            'en' => 'Booking site demo: room cards, filters, map. Booking not sent.',
        ],
        'category' => [
            'ru' => 'Сайт бронирования',
            'en' => 'Booking website',
        ],
        'heroPoints' => [
            'ru' => [
                'Фильтры дат и гостей — контролы не реагируют.',
                'Карточки номеров с бэйджами “семья / пара / workation”.',
                'Кнопки “Забронировать” и карта отключены.',
            ],
            'en' => [
                'Date and guest filters — controls don’t react.',
                'Room cards with “family / couple / workation” badges.',
                '“Book now” buttons and map are disabled.',
            ],
        ],
        'sections' => [
            [
                'title' => ['ru' => 'Подбор номера', 'en' => 'Room finder'],
                'text' => [
                    'ru' => 'Фильтры дат и гостей, плейсхолдер стоимости за ночь, кнопки не кликаются.',
                    'en' => 'Date/guest filters, nightly price placeholder, buttons don’t click.',
                ],
                'chips' => ['Даты off', 'Гости off', 'Цена-плейс', 'Кнопка off'],
            ],
            [
                'title' => ['ru' => 'Карточки номеров', 'en' => 'Room cards'],
                'text' => [
                    'ru' => 'Фото, удобства, бейдж “кому подходит”. CTA заблокирована.',
                    'en' => 'Photos, amenities, “who is it for” badge. CTA blocked.',
                ],
                'chips' => ['Удобства', 'Бейджи', 'CTA off', 'Фото-плейс'],
            ],
            [
                'title' => ['ru' => 'Карта и контакты', 'en' => 'Map & contacts'],
                'text' => [
                    'ru' => 'Статичная карта, контакты и FAQ — ссылки заглушки.',
                    'en' => 'Static map, contacts and FAQ — links are placeholders.',
                ],
                'chips' => ['Карта off', 'Контакты', 'FAQ off', 'Соцсети off'],
            ],
        ],
        'ctas' => [
            'ru' => ['Забронировать', 'Узнать наличие'],
            'en' => ['Book now', 'Check availability'],
        ],
    ],
];

$projectId = $_GET['project'] ?? 'northern-beans';
$projectId = is_string($projectId) ? trim($projectId) : 'northern-beans';
$notFound = false;

if (!isset($demos[$projectId])) {
    http_response_code(404);
    $projectId = 'northern-beans';
    $notFound = true;
}

$demo = $demos[$projectId];

$pageTitle = ($currentLang === 'en' ? 'Demo layout: ' : 'Демо: ') . ($demo['title'][$currentLang] ?? $projectId);
$pageMetaTitle = $pageTitle;
$pageMetaDescription = $demo['description'][$currentLang] ?? '';

include __DIR__ . '/includes/header.php';
?>

<style>
    .demo-shell {
        --demo-accent: <?php echo htmlspecialchars($demo['accent']); ?>;
        --demo-accent-alt: <?php echo htmlspecialchars($demo['accentAlt']); ?>;
        color: #e5e7eb;
        background: radial-gradient(circle at 20% 20%, rgba(139,92,246,0.08), transparent 45%),
            radial-gradient(circle at 80% 10%, rgba(34,211,238,0.08), transparent 35%),
            #0a0a0f;
        min-height: 100vh;
    }
    .demo-container { max-width: 1180px; margin: 0 auto; padding: 120px 20px 80px; }
    .demo-card {
        background: rgba(15, 15, 23, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 22px;
        box-shadow: 0 25px 80px rgba(0,0,0,0.35);
    }
    .demo-hero { padding: 28px; position: relative; overflow: hidden; }
    .demo-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.04), transparent 60%);
        pointer-events: none;
    }
    .demo-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        font-size: 12px;
        letter-spacing: 0.04em;
    }
    .demo-title { font-size: clamp(32px, 4vw, 44px); margin: 14px 0 10px; line-height: 1.1; }
    .demo-subtitle { color: #cfd2dc; font-size: 16px; line-height: 1.6; margin-bottom: 16px; }
    .demo-meta { display: inline-flex; gap: 10px; flex-wrap: wrap; margin-bottom: 18px; }
    .demo-pill {
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,0.08);
        background: rgba(255,255,255,0.04);
        font-size: 13px;
    }
    .demo-actions { display: flex; gap: 12px; flex-wrap: wrap; align-items: center; margin-bottom: 22px; }
    .demo-btn {
        padding: 12px 18px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.14);
        background: linear-gradient(120deg, var(--demo-accent), var(--demo-accent-alt));
        color: #0a0a0f;
        font-weight: 700;
        cursor: not-allowed;
        opacity: 0.72;
    }
    .demo-btn.ghost {
        background: transparent;
        color: #e5e7eb;
    }
    .demo-btn.back {
        cursor: pointer;
        opacity: 1;
        background: rgba(255,255,255,0.05);
        color: #e5e7eb;
    }
    .demo-grid { display: grid; gap: 12px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
    .demo-tile {
        padding: 16px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
        background: rgba(255,255,255,0.02);
        min-height: 120px;
    }
    .demo-section { margin-top: 28px; padding: 20px 24px; border-top: 1px solid rgba(255,255,255,0.04); }
    .demo-section h3 { margin: 0 0 6px; font-size: 20px; }
    .demo-section p { margin: 0 0 12px; color: #cfd2dc; line-height: 1.6; }
    .demo-chips { display: flex; flex-wrap: wrap; gap: 8px; }
    .demo-chip {
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        font-size: 12px;
    }
    .demo-note {
        margin-top: 18px;
        padding: 12px 14px;
        border-radius: 12px;
        background: rgba(255,255,255,0.06);
        border: 1px dashed rgba(255,255,255,0.2);
        color: #e5e7eb;
        font-size: 14px;
        line-height: 1.5;
    }
    @media (max-width: 640px) {
        .demo-hero { padding: 22px; }
        .demo-actions { flex-direction: column; align-items: stretch; }
        .demo-btn { width: 100%; text-align: center; }
    }
</style>

<main class="demo-shell">
    <div class="demo-container">
        <?php if ($notFound): ?>
            <div class="demo-note" style="margin-bottom: 16px;">
                <?php echo $currentLang === 'en'
                    ? 'Demo not found, showing coffee shop mockup.'
                    : 'Демо не найдено, показываем макет кофейни.'; ?>
            </div>
        <?php endif; ?>

        <div class="demo-card demo-hero">
            <div class="demo-badge">
                <span aria-hidden="true">★</span>
                <?php echo $currentLang === 'en' ? 'Demo layout' : 'Демо-макет'; ?>
                <span style="color: var(--demo-accent);">•</span>
                <?php echo $currentLang === 'en' ? 'Logic is disabled' : 'Логика отключена'; ?>
            </div>
            <h1 class="demo-title"><?php echo htmlspecialchars($demo['title'][$currentLang]); ?></h1>
            <p class="demo-subtitle"><?php echo htmlspecialchars($demo['subtitle'][$currentLang]); ?></p>
            <div class="demo-meta">
                <span class="demo-pill"><?php echo htmlspecialchars($demo['category'][$currentLang]); ?></span>
                <span class="demo-pill" style="border-color: var(--demo-accent); color: var(--demo-accent);">
                    <?php echo $currentLang === 'en' ? 'Static preview' : 'Статичная витрина'; ?>
                </span>
                <span class="demo-pill">
                    <?php echo $currentLang === 'en' ? 'Buttons: disabled' : 'Кнопки: выключены'; ?>
                </span>
            </div>

            <div class="demo-actions">
                <a class="demo-btn back" href="<?php echo htmlspecialchars(getLocalizedUrl($currentLang, '/portfolio')); ?>">
                    ← <?php echo $currentLang === 'en' ? 'Back to portfolio' : 'Назад к портфолио'; ?>
                </a>
                <?php foreach ($demo['ctas'][$currentLang] as $cta): ?>
                    <button type="button" class="demo-btn" disabled aria-disabled="true">
                        <?php echo htmlspecialchars($cta); ?> · <?php echo $currentLang === 'en' ? 'demo' : 'демо'; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="demo-grid" role="presentation" aria-hidden="true">
                <?php foreach ($demo['heroPoints'][$currentLang] as $point): ?>
                    <div class="demo-tile">
                        <div style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, var(--demo-accent), var(--demo-accent-alt)); opacity: 0.8; margin-bottom: 10px;"></div>
                        <div style="font-weight: 700; margin-bottom: 6px; color: #f8fafc;"><?php echo $currentLang === 'en' ? 'Screen idea' : 'Экран'; ?></div>
                        <div style="color: #cfd2dc; line-height: 1.5;"><?php echo htmlspecialchars($point); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="demo-note">
                <?php echo $currentLang === 'en'
                    ? 'This is a frozen layout: forms, buttons and links intentionally do nothing. Use it only as a visual demo.'
                    : 'Это “замороженный” макет: формы, кнопки и ссылки специально не работают. Используется только как визуальное демо.'; ?>
            </div>
        </div>

        <div class="demo-card demo-section">
            <?php foreach ($demo['sections'] as $section): ?>
                <div style="margin-bottom: 18px;">
                    <h3><?php echo htmlspecialchars($section['title'][$currentLang]); ?></h3>
                    <p><?php echo htmlspecialchars($section['text'][$currentLang]); ?></p>
                    <div class="demo-chips">
                        <?php foreach ($section['chips'] as $chip): ?>
                            <span class="demo-chip"><?php echo htmlspecialchars($chip); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="demo-note" style="margin-top: 18px;">
            <?php echo $currentLang === 'en'
                ? 'Need a live version? We can connect forms, payments and integrations on top of this UX when the project goes into production.'
                : 'Нужна рабочая версия? Подключим формы, оплаты и интеграции поверх этого UX, когда проект пойдёт в прод.'; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

