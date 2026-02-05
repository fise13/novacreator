<?php
/**
 * Страница услуги: iOS разработка на Swift / SwiftUI
 * Отдельная SEO-страница для продвижения услуги разработки iOS приложений
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en'
    ? 'iOS App Development on Swift/SwiftUI'
    : 'iOS разработка на Swift/SwiftUI';

$pageMetaTitle = $currentLang === 'en'
    ? 'iOS App Development on Swift/SwiftUI | NovaCreator Studio'
    : 'iOS разработка на Swift/SwiftUI под бизнес-задачи';

$pageMetaDescription = $currentLang === 'en'
    ? 'Native iOS app development on Swift and SwiftUI for business. Analytics, design, architecture, Firebase, API integrations, App Store launch and post-release support.'
    : 'Разработка нативных iOS приложений на Swift и SwiftUI для бизнеса в Казахстане. Аналитика, дизайн, интеграции, App Store, поддержка. Оценим проект и сроки за 24 часа.';

$pageMetaKeywords = $currentLang === 'en'
    ? 'ios app development, swift developer, swiftui development, iphone app development, ios development agency, native ios apps, firebase ios integration, app store launch'
    : 'iOS разработка Казахстан, разработка приложений iPhone, Swift разработчик Алматы, SwiftUI разработка, заказ мобильного приложения iOS, разработка iOS приложений для бизнеса, нативные iOS приложения Swift, разработка мобильного приложения Алматы, публикация приложения в App Store, iOS разработка под ключ, разработка MVP iOS, бизнес-приложение для iPhone, мобильная разработка Казахстан';

$pageMetaCanonical = '/ios-razrabotka-swift-swiftui';

include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="reveal-group relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en'
                    ? 'iOS app development on Swift / SwiftUI'
                    : 'iOS разработка на Swift / SwiftUI под задачи вашего бизнеса'; ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light reveal px-2" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en'
                    ? 'We design, develop and launch native iOS apps to the App Store that grow your business metrics.'
                    : 'Проектируем, разрабатываем и выводим в App Store нативные iOS приложения, которые приносят заявки и повторные продажи.'; ?>
            </p>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4 md:gap-6 reveal px-4 sm:px-0">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 bg-black text-white text-base md:text-lg font-semibold rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center hover:scale-105 hover:shadow-xl overflow-hidden">
                    <span class="relative z-10">
                        <?php echo $currentLang === 'en' ? 'Get a project estimate' : 'Получить оценку проекта'; ?>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="<?php echo getLocalizedUrl($currentLang, '/portfolio'); ?>" class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 text-base md:text-lg font-semibold rounded-full transition-all duration-300 min-h-[44px] md:min-h-[48px] flex items-center justify-center border" style="border-color: var(--color-border); color: var(--color-text);">
                    <?php echo $currentLang === 'en' ? 'View cases' : 'Посмотреть кейсы'; ?>
                </a>
            </div>

            <div class="mt-8 md:mt-10 flex flex-col sm:flex-row items-center justify-center gap-3 text-sm sm:text-base md:text-lg font-medium reveal" style="color: var(--color-text-secondary);">
                <div><?php echo $currentLang === 'en' ? 'MVP launch from 6–8 weeks' : 'Запуск MVP от 6–8 недель'; ?></div>
                <span class="hidden sm:inline">•</span>
                <div><?php echo $currentLang === 'en' ? 'Swift / SwiftUI / MVVM architecture' : 'Архитектура на Swift / SwiftUI / MVVM'; ?></div>
                <span class="hidden sm:inline">•</span>
                <div><?php echo $currentLang === 'en' ? 'Full App Store launch support' : 'Полное сопровождение релиза в App Store'; ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Описание услуги -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Native iOS apps for business'
                        : 'Нативные iOS приложения под ваш бизнес'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed mb-4" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'NovaCreator Studio develops native iOS apps on Swift and SwiftUI tailored to business goals: leads, sales, client service and internal efficiency.'
                        : 'NovaCreator Studio разрабатывает нативные iOS приложения под конкретные бизнес-цели: лиды, продажи, сервис для клиентов, внутреннюю эффективность команды.'; ?>
                </p>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'We handle the full cycle — from analytics and architecture to publication in the App Store and post-release support.'
                        : 'Мы берем на себя весь цикл — от аналитики и архитектуры до публикации в App Store и пострелизной поддержки.'; ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12">
                <div class="space-y-6 reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-2" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en'
                            ? 'Modern stack: Swift, SwiftUI and UIKit'
                            : 'Современный стек: Swift, SwiftUI и UIKit'; ?>
                    </h3>
                    <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'We use Swift and SwiftUI for fast development of modern interfaces and UIKit where deep customization is required. MVVM architecture makes the codebase predictable and scalable.'
                            : 'Используем Swift и SwiftUI для быстрого создания современных интерфейсов и подключаем UIKit там, где нужна глубокая кастомизация. Архитектура на MVVM делает код предсказуемым и масштабируемым.'; ?>
                    </p>

                    <h3 class="text-2xl md:text-3xl font-bold mb-2 mt-6" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en'
                            ? 'Integrations'
                            : 'Интеграции под ваш цифровой контур'; ?>
                    </h3>
                    <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'We integrate with REST APIs, CRM systems, payment providers, Firebase, maps and internal services to make the app part of your digital ecosystem.'
                            : 'Интегрируем приложение с REST API, CRM, платежными провайдерами, Firebase, картами и внутренними сервисами, чтобы приложение стало частью вашего цифрового контура.'; ?>
                    </p>
                </div>

                <div class="space-y-6 reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-2" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en'
                            ? 'Design and architecture'
                            : 'Дизайн и архитектура'; ?>
                    </h3>
                    <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'We design UX, visuals and app architecture simultaneously: from user flows and prototypes to a design system and module breakdown. This reduces rework and technical debt.'
                            : 'Прорабатываем UX, визуал и архитектуру приложения параллельно: от пользовательских потоков и прототипов до дизайн-системы и декомпозиции модулей. Это снижает количество переделок и технический долг.'; ?>
                    </p>

                    <h3 class="text-2xl md:text-3xl font-bold mb-2 mt-6" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en'
                            ? 'App Store launch'
                            : 'Публикация и сопровождение в App Store'; ?>
                    </h3>
                    <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'We prepare the build, screenshots, descriptions and help pass App Store review. After launch we track metrics and plan updates.'
                            : 'Готовим сборку, скриншоты, описания и помогаем пройти модерацию App Store. После релиза следим за метриками и планируем обновления.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Что входит в разработку -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'What is included in development'
                        : 'Что входит в разработку iOS приложения'; ?>
                </h2>
            </div>

            <div class="space-y-8">
                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Analytics and prototyping' : 'Аналитика и прототипирование'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We analyse business goals, user scenarios and constraints, build a screen map and interactive prototypes to fix logic before development.'
                            : 'Разбираем цели бизнеса, пользовательские сценарии и ограничения, строим карту экранов и интерактивные прототипы, чтобы зафиксировать логику до начала разработки.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'UI/UX design' : 'UI/UX дизайн'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We create a design system and screens according to iOS guidelines, focusing on simple scenarios and fast completion of target actions.'
                            : 'Создаем дизайн-систему и экраны по гайдам iOS, фокусируясь на простоте сценариев и скорости выполнения целевых действий.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Swift / SwiftUI development' : 'Разработка на Swift / SwiftUI'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We implement functionality with Swift, SwiftUI and UIKit, using MVVM architecture to ensure clear separation of logic and interface.'
                            : 'Реализуем функциональность на Swift, SwiftUI и UIKit, используя архитектуру MVVM для четкого разделения логики и интерфейса.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Backend integration (REST API, JSON)' : 'Backend интеграция (REST API, JSON)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We connect the app to your backend via REST API and JSON: auth, data exchange, synchronization and background updates.'
                            : 'Подключаем приложение к вашему backend через REST API и JSON: авторизация, обмен данными, синхронизация и фоновые обновления.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Firebase (Auth, Firestore, Push)' : 'Firebase (Auth, Firestore, Push)'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We set up Firebase for authentication, data storage, analytics and push notifications to increase engagement and returns.'
                            : 'Настраиваем Firebase для аутентификации, хранения данных, аналитики и Push-уведомлений, чтобы повышать вовлеченность и возвраты.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Performance optimization' : 'Оптимизация производительности'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We monitor response time, animations and resource usage, optimize heavy screens and networking to keep the app fast and smooth.'
                            : 'Следим за временем отклика, анимациями и потреблением ресурсов, оптимизируем тяжелые экраны и работу с сетью, чтобы приложение оставалось быстрым и плавным.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Testing' : 'Тестирование'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We conduct functional, UX and load testing on real devices and TestFlight groups to catch critical issues before release.'
                            : 'Проводим функциональное, UX- и нагрузочное тестирование на реальных устройствах и группах в TestFlight, чтобы отловить критические ошибки до релиза.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'App Store release' : 'Подготовка к релизу и публикация в App Store'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We prepare everything for App Store publication: build, screenshots, descriptions, metadata and help pass review.'
                            : 'Готовим всё для публикации в App Store: сборку, скриншоты, описания, метаданные и сопровождаем прохождение модерации.'; ?>
                    </p>
                </div>

                <div class="reveal">
                    <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Post-release support' : 'Поддержка после релиза'; ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo $currentLang === 'en'
                            ? 'We monitor metrics, collect feedback and plan updates, keeping the app relevant for new iOS versions and user expectations.'
                            : 'Следим за метриками, собираем обратную связь и планируем обновления, поддерживая актуальность приложения под новые версии iOS и ожидания пользователей.'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Почему Swift и SwiftUI -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Why Swift and SwiftUI'
                        : 'Почему Swift и SwiftUI'; ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                <div class="space-y-6 reveal">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Development speed' : 'Скорость разработки'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'SwiftUI accelerates the creation of interfaces and iterations on MVP, reducing time-to-market for your product.'
                                : 'SwiftUI ускоряет создание интерфейсов и итерации над MVP, сокращая время вывода продукта на рынок.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Native performance' : 'Нативная производительность'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'The app runs on Apple\'s native stack without extra layers, ensuring smooth animations and fast response.'
                                : 'Приложение работает на нативном стеке Apple без лишних прослоек — плавные анимации и быстрый отклик интерфейса.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Security' : 'Безопасность'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Swift\'s type system and memory management reduce the risk of critical bugs and vulnerabilities compared to legacy stacks.'
                                : 'Строгая типизация и управление памятью в Swift снижают риск критических багов и уязвимостей по сравнению со старыми стеками.'; ?>
                        </p>
                    </div>
                </div>

                <div class="space-y-6 reveal">
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Scalability' : 'Масштабируемость'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'MVVM architecture on Swift scales well: you can add modules, split responsibilities and grow the team without rewriting the app.'
                                : 'Архитектура на Swift и MVVM хорошо масштабируется: можно добавлять модули, делить зоны ответственности и наращивать команду без переписывания приложения.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Long-term support' : 'Долгосрочная поддержка'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Apple actively develops Swift and SwiftUI, giving your app a stable foundation for years ahead.'
                                : 'Apple активно развивает Swift и SwiftUI, что дает вашему приложению устойчивую платформу на годы вперед.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Типы приложений -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Types of iOS apps we build'
                        : 'Типы iOS приложений, которые мы разрабатываем'; ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                <div class="space-y-6 reveal">
                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Business apps' : 'Бизнес-приложения'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Client portals, loyalty programs and service apps that improve communication and increase LTV.'
                                : 'Клиентские кабинеты, программы лояльности и сервисные приложения, которые упрощают коммуникацию и повышают LTV.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Marketplaces' : 'Маркетплейсы'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Catalogues, search, cart, orders and reviews — a convenient mobile entry point to your marketplace.'
                                : 'Каталоги, поиск, корзина, заказы и отзывы — удобная мобильная точка входа в ваш маркетплейс.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Delivery and logistics' : 'Доставка и логистика'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Apps for couriers, drivers and operators with routing, statuses, maps and push notifications.'
                                : 'Приложения для курьеров, водителей и операторов с маршрутами, статусами, картами и Push-уведомлениями.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'CRM / ERP' : 'CRM / ERP решения'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Mobile access to CRM/ERP: tasks, deals, reports and internal communications for field teams and management.'
                                : 'Мобильный доступ к CRM/ERP: задачи, сделки, отчеты и внутренние коммуникации для полевых команд и менеджмента.'; ?>
                        </p>
                    </div>
                </div>

                <div class="space-y-6 reveal">
                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Subscriptions and paid content' : 'Подписки и платный контент'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Educational platforms, content services and apps with subscriptions and in-app purchases.'
                                : 'Образовательные платформы, контент-сервисы и приложения с подписками и внутриигровыми покупками.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Fintech and wallets' : 'Финтех и кошельки'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Wallets, bonus programs and payment solutions with special attention to security and compliance.'
                                : 'Кошельки, бонусные программы и платежные решения с особым вниманием к безопасности и требованиям платформ.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Startup products' : 'Приложения для стартапов'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'MVPs and product experiments with fast iterations and transparent roadmaps.'
                                : 'MVP и продуктовые эксперименты с быстрыми итерациями и прозрачной дорожной картой.'; ?>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold mb-2" style="color: var(--color-text);">
                            <?php echo $currentLang === 'en' ? 'Internal apps' : 'Внутренние приложения для компании'; ?>
                        </h3>
                        <p class="text-lg leading-relaxed" style="color: var(--color-text-secondary);">
                            <?php echo $currentLang === 'en'
                                ? 'Tools for employees: training, services, requests and internal communications.'
                                : 'Сервисы для сотрудников: обучение, внутренние сервисы, заявки и корпоративные коммуникации.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Технологии -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Technologies'
                        : 'Технологии, с которыми мы работаем'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'We use a modern and battle-tested stack that ensures stability, scalability and predictable development speed.'
                        : 'Используем современный и проверенный стек, который обеспечивает стабильность, масштабируемость и предсказуемую скорость разработки.'; ?>
                </p>
            </div>

            <div class="reveal">
                <div class="flex flex-wrap gap-3 md:gap-4">
                    <?php
                    $techStack = [
                        'Swift',
                        'SwiftUI',
                        'UIKit',
                        'MVVM',
                        'SwiftData / CoreData',
                        'Firebase (Auth, Firestore, Analytics, Push)',
                        'REST API',
                        'JSON',
                        'Apple Sign In',
                        'Push Notifications',
                        'MapKit',
                        'In‑App Purchases',
                        'Stripe',
                        'CloudPayments',
                        'CI/CD (GitHub Actions)',
                        'TestFlight'
                    ];

                    foreach ($techStack as $tech): ?>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm md:text-base" style="background-color: var(--color-bg); color: var(--color-text-secondary); border: 1px solid var(--color-border);">
                            <?php echo htmlspecialchars($tech); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Этапы разработки -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Development stages'
                        : 'Этапы разработки iOS приложения'; ?>
                </h2>
            </div>

            <div class="space-y-8">
                <?php
                $steps = [
                    [
                        'num' => 1,
                        'title_ru' => 'Бриф',
                        'title_en' => 'Brief',
                        'text_ru' => 'Обсуждаем цели, аудиторию, ключевые сценарии и ограничения по срокам и бюджету. Формируем общее понимание продукта.',
                        'text_en' => 'We discuss goals, audience, key scenarios and constraints in terms of budget and timeline, forming a shared understanding of the product.'
                    ],
                    [
                        'num' => 2,
                        'title_ru' => 'ТЗ',
                        'title_en' => 'Technical specification',
                        'text_ru' => 'Описываем функциональность, роли пользователей, интеграции, сценарии и технические требования. Фиксируем критерии успешного релиза.',
                        'text_en' => 'We describe functionality, user roles, integrations, scenarios and technical requirements, setting clear success criteria.'
                    ],
                    [
                        'num' => 3,
                        'title_ru' => 'Дизайн',
                        'title_en' => 'Design',
                        'text_ru' => 'Создаем прототипы, дизайн-систему и экраны под iOS-гайды. Согласуем ключевые сценарии до начала разработки.',
                        'text_en' => 'We create prototypes, a design system and screens according to iOS guidelines, approving key scenarios before development.'
                    ],
                    [
                        'num' => 4,
                        'title_ru' => 'Разработка MVP',
                        'title_en' => 'MVP development',
                        'text_ru' => 'Реализуем приоритетные сценарии на Swift/SwiftUI, подключаем backend и внешние сервисы. Сдаем промежуточные сборки.',
                        'text_en' => 'We implement priority scenarios on Swift/SwiftUI, connect backend and external services, and deliver intermediate builds.'
                    ],
                    [
                        'num' => 5,
                        'title_ru' => 'Тестирование',
                        'title_en' => 'Testing',
                        'text_ru' => 'Проводим функциональное и UX-тестирование на реальных устройствах и через TestFlight, исправляем найденные баги.',
                        'text_en' => 'We run functional and UX tests on real devices and via TestFlight, fixing all critical issues.'
                    ],
                    [
                        'num' => 6,
                        'title_ru' => 'Релиз',
                        'title_en' => 'Release',
                        'text_ru' => 'Готовим приложение к публикации в App Store, собираем билд, заполняем карточку и сопровождаем модерацию.',
                        'text_en' => 'We prepare the app for App Store publication, build, fill in the listing and assist with review.'
                    ],
                    [
                        'num' => 7,
                        'title_ru' => 'Поддержка',
                        'title_en' => 'Support',
                        'text_ru' => 'Анализируем метрики, собираем обратную связь, планируем обновления и развитие продукта.',
                        'text_en' => 'We analyse metrics, collect feedback and plan updates and product evolution.'
                    ],
                ];

                foreach ($steps as $step):
                    $title = $currentLang === 'en' ? $step['title_en'] : $step['title_ru'];
                    $text = $currentLang === 'en' ? $step['text_en'] : $step['text_ru'];
                ?>
                <div class="reveal">
                    <div class="flex items-start gap-6">
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0 text-xl md:text-2xl font-bold text-white">
                            <?php echo (int) $step['num']; ?>
                        </div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3" style="color: var(--color-text);">
                                <?php echo htmlspecialchars($title); ?>
                            </h3>
                            <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                                <?php echo htmlspecialchars($text); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Стоимость -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Pricing'
                        : 'Стоимость разработки iOS приложения'; ?>
                </h2>
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                    <?php echo $currentLang === 'en'
                        ? 'We do not fix prices without understanding the scope, but we can provide realistic ranges for planning.'
                        : 'Мы не фиксируем цену без понимания объема работ, но даем реалистичные диапазоны, чтобы вы могли планировать бюджет.'; ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                <div class="reveal border rounded-2xl p-6 md:p-8" style="border-color: var(--color-border); background-color: var(--color-bg);">
                    <h3 class="text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'MVP app' : 'MVP приложение'; ?>
                    </h3>
                    <p class="text-base md:text-lg leading-relaxed mb-3" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Essential features for hypothesis validation or pilot launch. Suitable for startups and test launches.'
                            : 'Базовый функционал для проверки гипотезы или пилотного запуска. Подходит для стартапов и тестовых запусков.'; ?>
                    </p>
                    <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Budget depends on number of screens, integrations and design complexity.'
                            : 'Бюджет зависит от количества экранов, интеграций и сложности дизайна.'; ?>
                    </p>
                </div>

                <div class="reveal border-2 rounded-2xl p-6 md:p-8" style="border-color: var(--color-border); background-color: var(--color-bg);">
                    <h3 class="text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Business app' : 'Бизнес-приложение'; ?>
                    </h3>
                    <p class="text-base md:text-lg leading-relaxed mb-3" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'A complete solution for clients or employees with integrations to CRM/ERP, analytics and notifications.'
                            : 'Полноценное решение для клиентов или сотрудников с интеграцией в CRM/ERP, аналитикой и уведомлениями.'; ?>
                    </p>
                    <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'The range is higher than MVP and is calculated after clarifying functionality and integrations.'
                            : 'Диапазон выше, чем у MVP, и рассчитывается после уточнения функционала и интеграций.'; ?>
                    </p>
                </div>

                <div class="reveal border rounded-2xl p-6 md:p-8" style="border-color: var(--color-border); background-color: var(--color-bg);">
                    <h3 class="text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo $currentLang === 'en' ? 'Complex app' : 'Сложное приложение'; ?>
                    </h3>
                    <p class="text-base md:text-lg leading-relaxed mb-3" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'Marketplaces, fintech and high-load B2B/B2C products with multiple roles and custom logic.'
                            : 'Маркетплейсы, финтех и высоконагруженные B2B/B2C решения с несколькими ролями и сложной логикой.'; ?>
                    </p>
                    <p class="text-sm md:text-base leading-relaxed" style="color: var(--color-text-secondary);">
                        <?php echo $currentLang === 'en'
                            ? 'The budget is formed individually after analytics and technical scoping.'
                            : 'Бюджет формируется индивидуально после аналитики и детализации технического объема.'; ?>
                    </p>
                </div>
            </div>

            <div class="mt-8 md:mt-10 reveal">
                <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 70ch;">
                    <?php echo $currentLang === 'en'
                        ? 'Final cost depends on feature scope, design depth, number and complexity of APIs, performance requirements and deadlines. Send us a brief to receive a tailored estimate within 24 hours.'
                        : 'Итоговая стоимость зависит от объема функционала, глубины дизайна, количества и сложности API-интеграций, требований к производительности и срокам. Отправьте краткий бриф — мы подготовим понятный диапазон стоимости в течение 24 часов.'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="reveal-group py-16 md:py-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10 md:mb-14 reveal">
                <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: var(--color-text);">
                    <?php echo $currentLang === 'en'
                        ? 'Frequently Asked Questions'
                        : 'Частые вопросы по iOS разработке'; ?>
                </h2>
            </div>

            <div class="space-y-8">
                <?php
                $faq = [
                    [
                        'q_ru' => 'Сколько стоит iOS приложение?',
                        'q_en' => 'How much does an iOS app cost?',
                        'a_ru' => 'Стоимость зависит от объема функционала, интеграций, дизайна и сроков. После короткого брифа мы даем ориентировочный диапазон и уточняем его по итогам ТЗ.',
                        'a_en' => 'Cost depends on feature scope, integrations, design and timeline. After a short brief we provide an estimated range and refine it after the specification.'
                    ],
                    [
                        'q_ru' => 'Сколько времени занимает разработка?',
                        'q_en' => 'How long does development take?',
                        'a_ru' => 'Простой MVP обычно занимает от 6–8 недель. Более сложные бизнес-приложения и маркетплейсы могут требовать от 3 до 6 месяцев.',
                        'a_en' => 'A simple MVP usually takes 6–8 weeks. More complex business apps and marketplaces can take 3–6 months.'
                    ],
                    [
                        'q_ru' => 'Делаете ли вы дизайн приложения?',
                        'q_en' => 'Do you handle app design?',
                        'a_ru' => 'Да, мы берем на себя полный цикл UI/UX: от прототипов до дизайн-системы и финальных макетов под iOS-гайды.',
                        'a_en' => 'Yes, we handle full UI/UX: from prototypes to the design system and final layouts according to iOS guidelines.'
                    ],
                    [
                        'q_ru' => 'Помогаете ли вы с публикацией в App Store?',
                        'q_en' => 'Do you help with App Store publication?',
                        'a_ru' => 'Да, готовим сборку, описание, скриншоты и сопровождаем приложение до успешного прохождения модерации в App Store.',
                        'a_en' => 'Yes, we prepare the build, description, screenshots and support the app until it passes App Store review.'
                    ],
                    [
                        'q_ru' => 'Можно ли подключить оплату в приложении?',
                        'q_en' => 'Can you add payments to the app?',
                        'a_ru' => 'Да, реализуем In‑App Purchases, интеграции со Stripe, CloudPayments и другими провайдерами с учетом требований Apple к оплатам.',
                        'a_en' => 'Yes, we implement In‑App Purchases and integrate Stripe, CloudPayments and other providers in line with Apple\'s payment policies.'
                    ],
                    [
                        'q_ru' => 'Поддерживаете ли вы приложение после релиза?',
                        'q_en' => 'Do you support the app after release?',
                        'a_ru' => 'Да, предлагаем формат технической поддержки и развития продукта: обновления под новые версии iOS, доработку функционала и оптимизацию метрик.',
                        'a_en' => 'Yes, we offer technical support and product evolution: updates for new iOS versions, feature improvements and metric optimisation.'
                    ],
                    [
                        'q_ru' => 'Можно ли сделать Android версию?',
                        'q_en' => 'Can you also build an Android version?',
                        'a_ru' => 'Да, можем спланировать параллельную или поэтапную разработку Android-версии и выстроить единую продуктовую дорожную карту.',
                        'a_en' => 'Yes, we can plan parallel or phased Android development and build a unified product roadmap.'
                    ],
                    [
                        'q_ru' => 'Делаете ли вы интеграцию с CRM или сайтом?',
                        'q_en' => 'Do you integrate with CRM or website?',
                        'a_ru' => 'Да, подключаем iOS приложение к CRM, сайту, ERP и другим системам через REST API и Webhook-архитектуру.',
                        'a_en' => 'Yes, we connect the iOS app to CRM, website, ERP and other systems via REST APIs and webhooks.'
                    ],
                    [
                        'q_ru' => 'Можете ли вы доработать уже существующее iOS приложение?',
                        'q_en' => 'Can you improve an existing iOS app?',
                        'a_ru' => 'Да, проводим аудит кода, оцениваем целесообразность доработки и либо берем поддержку, либо предлагаем план по рефакторингу или перезапуску.',
                        'a_en' => 'Yes, we audit the codebase, assess feasibility and either take over maintenance or propose a plan for refactoring or relaunch.'
                    ],
                    [
                        'q_ru' => 'Работаете ли вы с клиентами вне Казахстана?',
                        'q_en' => 'Do you work with clients outside Kazakhstan?',
                        'a_ru' => 'Да, работаем с компаниями из Казахстана (Алматы, Астана и другие города) и зарубежными клиентами, выстраивая полностью онлайн-процессы.',
                        'a_en' => 'Yes, we work with companies from Kazakhstan (Almaty, Astana and other cities) and international clients fully online.'
                    ],
                ];

                foreach ($faq as $item):
                    $q = $currentLang === 'en' ? $item['q_en'] : $item['q_ru'];
                    $a = $currentLang === 'en' ? $item['a_en'] : $item['a_ru'];
                ?>
                <div class="reveal border rounded-2xl p-6 md:p-8" style="border-color: var(--color-border); background-color: var(--color-bg-lighter);">
                    <h3 class="text-xl md:text-2xl font-bold mb-3" style="color: var(--color-text);">
                        <?php echo htmlspecialchars($q); ?>
                    </h3>
                    <p class="text-lg md:text-xl leading-relaxed" style="color: var(--color-text-secondary); max-width: 65ch;">
                        <?php echo htmlspecialchars($a); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Финальный CTA -->
<section class="reveal-group py-16 md:py-24 lg:py-32 relative overflow-hidden" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 md:mb-8 lg:mb-10 leading-tight reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en'
                    ? 'Get a free consultation on your iOS project'
                    : 'Получите бесплатную консультацию по вашему iOS‑проекту'; ?>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 md:mb-10 lg:mb-12 leading-relaxed reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en'
                    ? 'We will assess your idea, estimate the scope and prepare a roadmap and budget within 24 hours.'
                    : 'Оценим идею, прикинем объем работ и подготовим roadmap и диапазон бюджета в течение 24 часов.'; ?>
            </p>
            <div class="reveal">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="group relative inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg transition-all duration-300 min-h-[48px] md:min-h-[56px] shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10">
                        <?php echo $currentLang === 'en' ? 'Discuss the project' : 'Оценить проект и сроки'; ?>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Schema.org JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Service",
      "@id": "https://novacreator.studio/ios-razrabotka-swift-swiftui#service",
      "name": "iOS разработка на Swift / SwiftUI",
      "description": "Разработка нативных iOS приложений на Swift и SwiftUI для бизнеса: аналитика, дизайн, архитектура MVVM, интеграции с Firebase, REST API, платежами и публикация в App Store.",
      "serviceType": "iOS App Development",
      "provider": {
        "@type": "Organization",
        "name": "NovaCreator Studio",
        "url": "https://novacreator.studio"
      },
      "areaServed": [
        "Kazakhstan",
        "Almaty",
        "Astana",
        "Worldwide"
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Пакеты iOS разработки",
        "itemListElement": [
          {
            "@type": "Offer",
            "name": "MVP iOS приложение",
            "description": "Базовый функционал для проверки гипотезы и пилотного запуска."
          },
          {
            "@type": "Offer",
            "name": "Бизнес-приложение",
            "description": "Полнофункциональное iOS приложение для клиентов или сотрудников с интеграциями и аналитикой."
          },
          {
            "@type": "Offer",
            "name": "Сложное решение",
            "description": "Маркетплейсы, финтех и высоконагруженные iOS сервисы с кастомной логикой."
          }
        ]
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "27",
        "bestRating": "5",
        "worstRating": "1"
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://novacreator.studio/ios-razrabotka-swift-swiftui#faq",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Сколько стоит iOS приложение?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Стоимость зависит от объема функционала, интеграций, дизайна и сроков. После короткого брифа мы даем ориентировочный диапазон и уточняем его по итогам ТЗ."
          }
        },
        {
          "@type": "Question",
          "name": "Сколько времени занимает разработка?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Простой MVP обычно занимает от 6–8 недель. Более сложные бизнес-приложения и маркетплейсы могут требовать от 3 до 6 месяцев."
          }
        },
        {
          "@type": "Question",
          "name": "Делаете ли вы дизайн приложения?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, мы берем на себя полный цикл UI/UX: от прототипов до дизайн-системы и финальных макетов под iOS-гайды."
          }
        },
        {
          "@type": "Question",
          "name": "Помогаете ли вы с публикацией в App Store?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, готовим сборку, описание, скриншоты и сопровождаем приложение до успешного прохождения модерации в App Store."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли подключить оплату в приложении?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, реализуем In‑App Purchases, интеграции со Stripe, CloudPayments и другими провайдерами с учетом требований Apple к платежам."
          }
        },
        {
          "@type": "Question",
          "name": "Поддерживаете ли вы приложение после релиза?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, предлагаем формат технической поддержки и развития продукта: обновления под новые версии iOS, доработка функционала, A/B‑тесты и оптимизация метрик."
          }
        },
        {
          "@type": "Question",
          "name": "Можно ли сделать Android версию?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, можем спланировать параллельную или поэтапную разработку Android‑версии и выстроить единую продуктовую дорожную карту."
          }
        },
        {
          "@type": "Question",
          "name": "Делаете ли вы интеграцию с CRM или сайтом?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, подключаем iOS приложение к CRM, сайту, ERP и другим системам через REST API и Webhook‑архитектуру, согласуя протоколы обмена данными."
          }
        },
        {
          "@type": "Question",
          "name": "Можете ли вы доработать уже существующее iOS приложение?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, проводим аудит кода, оцениваем целесообразность доработки и либо берем поддержку, либо предлагаем план по рефакторингу или перезапуску."
          }
        },
        {
          "@type": "Question",
          "name": "Работаете ли вы с клиентами вне Казахстана?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Да, мы работаем с компаниями из Казахстана (Алматы, Астана и другие города) и зарубежными клиентами, выстраивая полностью онлайн‑процессы."
          }
        }
      ]
    }
  ]
}
</script>

<?php include 'includes/footer.php'; ?>

