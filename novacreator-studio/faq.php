<?php
/**
 * Страница FAQ - Часто задаваемые вопросы
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.faq.breadcrumb');
$pageMetaTitle = t('seo.pages.faq.title');
$pageMetaDescription = t('seo.pages.faq.description');
$pageMetaKeywords = t('seo.pages.faq.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <div class="w-24 h-24 bg-gradient-to-r from-neon-purple to-neon-blue rounded-2xl flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.faq.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.faq.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- FAQ секция с Schema.org разметкой -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto animate-on-scroll">
            <div itemscope itemtype="https://schema.org/FAQPage" class="space-y-6">
                
                <!-- SEO вопросы -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <?php echo htmlspecialchars(t('pages.faq.sections.seo.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.seo.q1.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.seo.q1.answer')); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.seo.q2.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.seo.q2.answer')); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 3 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.seo.q3.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.seo.q3.answer')); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Разработка сайтов -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                        <?php echo htmlspecialchars(t('pages.faq.sections.development.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.development.q1.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.development.q1.answer')); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.development.q2.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.development.q2.answer')); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Google Ads -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                        <?php echo htmlspecialchars(t('pages.faq.sections.ads.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.ads.q1.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.ads.q1.answer')); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.ads.q2.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.ads.q2.answer')); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Общие вопросы -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-8 text-gradient flex items-center">
                        <svg class="w-8 h-8 mr-3 text-neon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <?php echo htmlspecialchars(t('pages.faq.sections.general.title')); ?>
                    </h2>
                    <div class="space-y-6">
                        <!-- Вопрос 1 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.general.q1.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.general.q1.answer')); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 2 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.general.q2.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.general.q2.answer')); ?>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Вопрос 3 -->
                        <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="bg-dark-surface border border-dark-border rounded-xl p-5 md:p-8 hover:border-neon-purple transition-all duration-300 active:scale-[0.98]">
                            <h3 itemprop="name" class="text-lg md:text-2xl font-bold mb-3 md:mb-4 text-gradient cursor-pointer flex items-center justify-between group min-h-[48px] touch-manipulation" onclick="toggleFAQ(this)">
                                <span class="group-hover:text-neon-purple transition-colors duration-300 pr-4 flex-1 text-left"><?php echo htmlspecialchars(t('pages.faq.sections.general.q3.question')); ?></span>
                                <svg class="w-6 h-6 md:w-7 md:h-7 transform transition-transform duration-500 ease-in-out text-neon-purple flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="faq-answer overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                                <p itemprop="text" class="text-gray-400 leading-relaxed pt-0">
                                    <?php echo htmlspecialchars(t('pages.faq.sections.general.q3.answer')); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA -->
            <div class="mt-16 text-center">
                <p class="text-xl text-gray-400 mb-8">
                    <?php echo htmlspecialchars(t('pages.faq.cta.text')); ?>
                </p>
                <a href="<?php echo getLocalizedUrl($currentLang, '/contact'); ?>" class="btn-neon inline-block">
                    <?php echo htmlspecialchars(t('pages.faq.cta.button')); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('svg');
    const isOpen = answer.classList.contains('max-h-0');
    
    if (isOpen) {
        // Открываем
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.classList.remove('max-h-0', 'opacity-0');
        answer.classList.add('opacity-100', 'pt-4');
        icon.classList.add('rotate-180');
        
        // Убираем max-height после завершения анимации для возможности дальнейшего изменения размера
        setTimeout(() => {
            answer.style.maxHeight = 'none';
        }, 500);
    } else {
        // Закрываем
        answer.style.maxHeight = answer.scrollHeight + 'px';
        // Небольшая задержка для начала анимации
        setTimeout(() => {
            answer.style.maxHeight = '0px';
            answer.classList.remove('opacity-100', 'pt-4');
            answer.classList.add('opacity-0');
        }, 10);
        icon.classList.remove('rotate-180');
        
        // Убираем классы после завершения анимации
        setTimeout(() => {
            answer.classList.add('max-h-0');
        }, 500);
    }
}
</script>

<?php include 'includes/footer.php'; ?>

