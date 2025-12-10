<?php
/**
 * Страница FAQ
 * Минималистичный дизайн в стиле holymedia.kz
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.faq.breadcrumb');
$pageMetaTitle = t('seo.pages.faq.title');
$pageMetaDescription = t('seo.pages.faq.description');
$pageMetaKeywords = t('seo.pages.faq.keywords');
include 'includes/header.php';
?>

<!-- Hero секция - Apple минималистичный дизайн на весь экран -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 md:pt-24" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-extrabold mb-6 md:mb-8 lg:mb-10 leading-[0.85] tracking-tighter animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.faq.title')); ?>
            </h1>
            <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl mb-8 md:mb-10 lg:mb-12 max-w-5xl mx-auto leading-relaxed font-light animate-on-scroll px-2" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo htmlspecialchars(t('pages.faq.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- FAQ секция -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div itemscope itemtype="https://schema.org/FAQPage" class="space-y-8">
                <!-- SEO вопросы -->
                <div class="mb-16 animate-on-scroll">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-8" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.faq.sections.seo.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <?php
                        // Вопросы SEO
                        for ($i = 1; $i <= 3; $i++) {
                            $questionKey = 'pages.faq.sections.seo.q' . $i . '.question';
                            $answerKey = 'pages.faq.sections.seo.q' . $i . '.answer';
                            if (t($questionKey) !== $questionKey) {
                                echo '<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="border-b pb-6 animate-on-scroll" style="animation-delay: ' . ($i * 0.1) . 's; border-color: var(--color-border);">';
                                echo '<h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 cursor-pointer" style="color: var(--color-text);" onclick="toggleFAQ(this)">';
                                echo htmlspecialchars(t($questionKey));
                                echo '<svg class="w-5 h-5 inline-block ml-2 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                                echo '</h3>';
                                echo '<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 max-h-0 opacity-0">';
                                echo '<p itemprop="text" class="text-lg md:text-xl leading-relaxed pt-0" style="color: var(--color-text-secondary);">';
                                echo htmlspecialchars(t($answerKey));
                                echo '</p></div></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="mb-16 animate-on-scroll" style="animation-delay: 0.2s;">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-8" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.faq.sections.development.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                            $questionKey = 'pages.faq.sections.development.q' . $i . '.question';
                            $answerKey = 'pages.faq.sections.development.q' . $i . '.answer';
                            if (t($questionKey) !== $questionKey) {
                                echo '<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="border-b pb-6 animate-on-scroll" style="animation-delay: ' . ($i * 0.1) . 's; border-color: var(--color-border);">';
                                echo '<h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 cursor-pointer" style="color: var(--color-text);" onclick="toggleFAQ(this)">';
                                echo htmlspecialchars(t($questionKey));
                                echo '<svg class="w-5 h-5 inline-block ml-2 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                                echo '</h3>';
                                echo '<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 max-h-0 opacity-0">';
                                echo '<p itemprop="text" class="text-lg md:text-xl leading-relaxed pt-0" style="color: var(--color-text-secondary);">';
                                echo htmlspecialchars(t($answerKey));
                                echo '</p></div></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                
                <!-- Общие вопросы -->
                <div class="mb-16 animate-on-scroll" style="animation-delay: 0.3s;">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-8" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.faq.sections.general.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <?php
                        for ($i = 1; $i <= 3; $i++) {
                            $questionKey = 'pages.faq.sections.general.q' . $i . '.question';
                            $answerKey = 'pages.faq.sections.general.q' . $i . '.answer';
                            if (t($questionKey) !== $questionKey) {
                                echo '<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="border-b pb-6 animate-on-scroll" style="animation-delay: ' . ($i * 0.1) . 's; border-color: var(--color-border);">';
                                echo '<h3 itemprop="name" class="text-xl md:text-2xl font-bold mb-4 cursor-pointer" style="color: var(--color-text);" onclick="toggleFAQ(this)">';
                                echo htmlspecialchars(t($questionKey));
                                echo '<svg class="w-5 h-5 inline-block ml-2 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
                                echo '</h3>';
                                echo '<div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 max-h-0 opacity-0">';
                                echo '<p itemprop="text" class="text-lg md:text-xl leading-relaxed pt-0" style="color: var(--color-text-secondary);">';
                                echo htmlspecialchars(t($answerKey));
                                echo '</p></div></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-20 md:py-32" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo $currentLang === 'en' ? 'Still have questions?' : 'Остались вопросы?'; ?>
            </h2>
            <p class="text-xl md:text-2xl mb-10 md:mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary);">
                <?php echo $currentLang === 'en' ? 'Contact us and we will answer all your questions' : 'Свяжитесь с нами, и мы ответим на все ваши вопросы'; ?>
            </p>
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="inline-block px-10 py-5 md:px-12 md:py-6 bg-black text-white text-lg md:text-xl font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px]">
                    <?php echo htmlspecialchars(t('nav.contact')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('svg');
    
    if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
        answer.style.maxHeight = '0px';
        answer.style.opacity = '0';
        answer.style.paddingTop = '0';
        if (icon) icon.style.transform = 'rotate(0deg)';
    } else {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.style.opacity = '1';
        answer.style.paddingTop = '1rem';
        if (icon) icon.style.transform = 'rotate(180deg)';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -80px 0px' });
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        scrollObserver.observe(el);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
