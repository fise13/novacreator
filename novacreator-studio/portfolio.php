<?php
/**
 * Страница портфолио
 * Пока пустая, так как мы только открылись
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.portfolio.breadcrumb');
$pageMetaTitle = t('seo.pages.portfolio.title');
$pageMetaDescription = t('seo.pages.portfolio.description');
$pageMetaKeywords = t('seo.pages.portfolio.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.portfolio.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.portfolio.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Портфолио проектов -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-12 animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gradient">
                Наши демонстрационные проекты
            </h2>
            <p class="text-lg md:text-xl text-gray-400 leading-relaxed">
                Клиентам важен не масштаб бренда, а качество реализации. Мы собрали подборку демонстрационных проектов,
                которые показывают наш подход к дизайну, структуре и смыслу — от кофеен до интернет-магазинов.
            </p>
        </div>

        <div class="grid gap-8 md:gap-10 md:grid-cols-2">
            <!-- Coffee shop website -->
            <article class="service-card animate-on-scroll">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gradient">
                        Coffee shop “Northern Beans”
                    </h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-neon-purple/10 border border-neon-purple/50 text-neon-purple">
                        Website
                    </span>
                </div>
                <p class="text-gray-300 mb-4">
                    Одностраничный сайт для локальной кофейни: акцент на атмосфере, простом заказе и понятном меню.
                    Сделали фокус на “заказ к приезду”, чтобы люди не стояли в очереди.
                </p>
                <ul class="space-y-1.5 text-sm text-gray-400 mb-4">
                    <li>• Интерактивное меню с фильтрами по крепости, молоку и объёму.</li>
                    <li>• Микроанимации без тяжёлых эффектов — сайт быстрый даже на 3G.</li>
                    <li>• Локальное SEO и схема <span class="font-mono text-xs">LocalBusiness</span> для карты.</li>
                </ul>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    <span class="text-gray-400">
                        Результат: рост онлайн‑заказов на вынос и узнаваемости в районе.
                    </span>
                    <span class="text-neon-blue text-xs uppercase tracking-wide">
                        UX / UI · Адаптив · SEO‑база
                    </span>
                </div>
            </article>

            <!-- Fitness trainer website -->
            <article class="service-card animate-on-scroll">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gradient">
                        Персональный тренер “BodyCraft”
                    </h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-neon-blue/20 border border-neon-blue/30 text-neon-blue">
                        Personal brand
                    </span>
                </div>
                <p class="text-gray-300 mb-4">
                    Лендинг для персонального тренера, который продаёт офлайн и онлайн‑тренировки через чёткое
                    позиционирование и реальные трансформации клиентов.
                </p>
                <ul class="space-y-1.5 text-sm text-gray-400 mb-4">
                    <li>• Герой‑блок “3 тренировки в неделю по 40 минут” вместо абстрактных слоганов.</li>
                    <li>• Кейсы “до/после” с историей: исходные данные, срок, результат.</li>
                    <li>• Мини‑квиз “Когда вы увидите результат?” c сбором лидов в мессенджеры.</li>
                </ul>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    <span class="text-gray-400">
                        Результат: стабильный поток заявок из органики и таргета на один лендинг.
                    </span>
                    <span class="text-neon-blue text-xs uppercase tracking-wide">
                        Лендинг · Контент‑структура · Лиды
                    </span>
                </div>
            </article>

            <!-- Construction company landing -->
            <article class="service-card animate-on-scroll">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gradient">
                        Строительная компания “UrbanFrame”
                    </h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-neon-purple/10 border border-neon-purple/50 text-neon-purple">
                        Landing
                    </span>
                </div>
                <p class="text-gray-300 mb-4">
                    Лендинг для компании, которая строит малоэтажные дома под ключ. Нужно было объяснить сложный продукт
                    простым языком и снять недоверие к подрядчику.
                </p>
                <ul class="space-y-1.5 text-sm text-gray-400 mb-4">
                    <li>• Пошаговая дорожная карта проекта: от замера участка до сдачи дома.</li>
                    <li>• Блок “Из чего складывается цена” с прозрачной разбивкой по этапам.</li>
                    <li>• Галерея готовых объектов и документы/гарантии в удобном формате.</li>
                </ul>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    <span class="text-gray-400">
                        Результат: больше заявок на консультации и ощутимый рост доверия к бренду.
                    </span>
                    <span class="text-neon-blue text-xs uppercase tracking-wide">
                        Структура · Trust‑блоки · Lead‑формы
                    </span>
                </div>
            </article>

            <!-- Online store demo -->
            <article class="service-card animate-on-scroll">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-semibold text-gradient">
                        Интернет‑магазин “TechNest” (демо)
                    </h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-neon-blue/20 border border-neon-blue/30 text-neon-blue">
                        E‑commerce demo
                    </span>
                </div>
                <p class="text-gray-300 mb-4">
                    Демонстрационный интернет‑магазин электроники, который показывает, как мы проектируем полный
                    e‑commerce‑флоу: от каталога до личного кабинета.
                </p>
                <ul class="space-y-1.5 text-sm text-gray-400 mb-4">
                    <li>• Каталог с фильтрами по брендам, цене и характеристикам.</li>
                    <li>• Страница товара с рекомендациями и блоком “часто покупают вместе”.</li>
                    <li>• Корзина, оформление заказа и демо‑личный кабинет без привязки к реальному бэкенду.</li>
                </ul>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    <span class="text-gray-400">
                        Результат: живой пример, как может выглядеть магазин клиента “до интеграции с 1С и оплатой”.
                    </span>
                    <span class="text-neon-blue text-xs uppercase tracking-wide">
                        UX магазина · Каталог · Checkout
                    </span>
                </div>
            </article>

            <!-- Hotel booking site -->
            <article class="service-card animate-on-scroll md:col-span-2">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                    <h3 class="text-2xl md:text-3xl font-semibold text-gradient">
                        Сайт бронирования отеля “Lakeview Hotel”
                    </h3>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-neon-purple/10 border border-neon-purple/50 text-neon-purple">
                        Booking website
                    </span>
                </div>
                <p class="text-gray-300 mb-4">
                    Концепт сайта для бутик‑отеля у озера: быстрый подбор номера, понятные условия проживания и акцент
                    на атмосфере отдыха, а не только на цене.
                </p>
                <div class="grid gap-4 md:grid-cols-2 mb-4 text-sm text-gray-400">
                    <ul class="space-y-1.5">
                        <li>• Фильтр номеров по датам, количеству гостей и типу отдыха.</li>
                        <li>• Календарь доступности с мгновенным пересчётом цены.</li>
                        <li>• Блок “для кого этот отель”: пары, семьи, удалёнщики.</li>
                    </ul>
                    <ul class="space-y-1.5">
                        <li>• Карта и информация о трансфере из ближайшего города.</li>
                        <li>• Отзывы гостей и фотогалерея с упором на детали.</li>
                        <li>• Оптимизация под мобильные устройства — бронирование в пару тапов.</li>
                    </ul>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                    <span class="text-gray-400">
                        Результат: готовый UX‑каркас для реального проекта, который можно быстро адаптировать под любого отельера.
                    </span>
                    <span class="text-neon-blue text-xs uppercase tracking-wide">
                        Booking‑флоу · Mobile‑first · Storytelling
                    </span>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.title')); ?>
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.subtitle')); ?>
            </p>
            <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                <?php echo htmlspecialchars(t('pages.portfolio.cta.button')); ?>
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

