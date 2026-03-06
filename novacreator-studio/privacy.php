<?php
/**
 * Privacy Policy — для App Store Connect и сайта NovaCreator Studio
 * URL: https://novacreatorstudio.com/privacy.php
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = $currentLang === 'en' ? 'Privacy Policy' : 'Политика конфиденциальности';
$pageMetaTitle = ($currentLang === 'en' ? 'Privacy Policy' : 'Политика конфиденциальности') . ' - ' . t('site.name');
$pageMetaDescription = $currentLang === 'en'
    ? 'Privacy policy for NovaCreator Studio website and iOS apps. How we collect, use and protect your data.'
    : 'Политика конфиденциальности NovaCreator Studio. Как мы собираем, используем и защищаем ваши данные.';
$pageMetaKeywords = $currentLang === 'en'
    ? 'privacy policy, data protection, NovaCreator Studio'
    : 'политика конфиденциальности, защита данных, NovaCreator Studio';
include 'includes/header.php';
?>

<main id="main-content">
<!-- Hero -->
<section class="reveal-group relative pt-24 md:pt-32 pb-12 md:pb-16 overflow-hidden" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 reveal" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Privacy Policy' : 'Политика конфиденциальности'; ?>
            </h1>
            <p class="text-lg md:text-xl reveal" style="color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' ? 'Last updated: ' . date('F j, Y') : 'Обновлено: ' . date('d.m.Y'); ?>
            </p>
        </div>
    </div>
</section>

<!-- Content -->
<section class="reveal-group py-12 md:py-20" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto prose prose-lg" style="color: var(--color-text-secondary);">
            <?php if ($currentLang === 'en'): ?>
            <div class="space-y-8 reveal">
                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">1. Introduction</h2>
                    <p>NovaCreator Studio ("we", "our") respects your privacy. This policy describes how we collect, use, and protect information when you use our website (novacreatorstudio.com) and our iOS applications (including AutoCore Accounting and other apps published through our developer account).</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">2. Information We Collect</h2>
                    <p><strong>Website:</strong> When you visit our site, we may collect your IP address, browser type, cookies, and data you voluntarily provide (contact forms, email).</p>
                    <p><strong>iOS Apps:</strong> Our apps may collect:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li>Account data (email, name) when you sign in with Apple or Google</li>
                        <li>Financial data you enter (cash balance, transactions, categories) — stored in your account and synced securely</li>
                        <li>Device identifiers for app functionality</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">3. How We Use Your Data</h2>
                    <p>We use your data to provide services, improve our products, process transactions, and communicate with you. We do not sell your personal information to third parties.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">4. Data Storage & Security</h2>
                    <p>Data is stored on secure servers (Firebase, cloud providers). We use encryption and industry-standard security practices.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">5. Third-Party Services</h2>
                    <p>We use Firebase (Google) for authentication and data sync, Google Analytics for website analytics, and Apple/Google services for sign-in. These providers have their own privacy policies.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">6. Your Rights</h2>
                    <p>You can request access, correction, or deletion of your data. Contact us at privacy@novacreatorstudio.com. For EU users, GDPR applies.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">7. Contact</h2>
                    <p>NovaCreator Studio<br>
                    Email: <a href="mailto:contact@novacreatorstudio.com" class="underline" style="color: var(--color-text);">contact@novacreatorstudio.com</a><br>
                    <?php echo $currentLang === 'en' ? 'Privacy: ' : 'Приватность: '; ?><a href="mailto:privacy@novacreatorstudio.com" class="underline" style="color: var(--color-text);">privacy@novacreatorstudio.com</a></p>
                </div>
            </div>
            <?php else: ?>
            <div class="space-y-8 reveal">
                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">1. Введение</h2>
                    <p>NovaCreator Studio («мы») уважает вашу конфиденциальность. Данная политика описывает, как мы собираем, используем и защищаем информацию при использовании нашего сайта (novacreatorstudio.com) и мобильных приложений (включая AutoCore Accounting и другие приложения).</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">2. Собираемые данные</h2>
                    <p><strong>Сайт:</strong> При посещении мы можем собирать IP-адрес, тип браузера, cookies и данные, которые вы добровольно указываете (формы, email).</p>
                    <p><strong>iOS-приложения:</strong> Наши приложения могут собирать:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li>Данные аккаунта (email, имя) при входе через Apple или Google</li>
                        <li>Финансовые данные, которые вы вводите (баланс, операции, категории) — хранятся в вашем аккаунте и синхронизируются в облаке</li>
                        <li>Идентификаторы устройства для работы приложения</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">3. Использование данных</h2>
                    <p>Мы используем данные для предоставления услуг, улучшения продуктов, обработки операций и связи с вами. Мы не продаём персональные данные третьим лицам.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">4. Хранение и безопасность</h2>
                    <p>Данные хранятся на защищённых серверах (Firebase, облачные провайдеры). Мы используем шифрование и стандартные практики безопасности.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">5. Сторонние сервисы</h2>
                    <p>Мы используем Firebase (Google) для аутентификации и синхронизации, Google Analytics для аналитики сайта, Apple/Google для входа. У этих провайдеров свои политики конфиденциальности.</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">6. Ваши права</h2>
                    <p>Вы можете запросить доступ, исправление или удаление данных. Для пользователей ЕС применяется GDPR. Свяжитесь с нами: privacy@novacreatorstudio.com</p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold mb-4" style="color: var(--color-text);">7. Контакты</h2>
                    <p>NovaCreator Studio<br>
                    Email: <a href="mailto:contact@novacreatorstudio.com" class="underline" style="color: var(--color-text);">contact@novacreatorstudio.com</a><br>
                    Приватность: <a href="mailto:privacy@novacreatorstudio.com" class="underline" style="color: var(--color-text);">privacy@novacreatorstudio.com</a></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</main>

<?php include 'includes/footer.php'; ?>
