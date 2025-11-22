<?php
/**
 * Страница портфолио
 * Пока пустая, так как мы только открылись
 */
$pageTitle = 'Портфолио';
$pageMetaTitle = 'Портфолио проектов | NovaCreator Studio';
$pageMetaDescription = 'NovaCreator Studio - новая компания с большим опытом команды. Портфолио будет пополняться по мере работы с клиентами.';
$pageMetaKeywords = 'портфолио digital агентства, примеры работ, кейсы продвижения';
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient">Портфолио</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                Мы только открылись, но у нашей команды большой опыт работы. 
                Портфолио будет пополняться по мере работы с новыми клиентами.
            </p>
        </div>
    </div>
</section>

<!-- Сообщение о портфолио -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-dark-surface border border-dark-border rounded-2xl p-8 md:p-12 text-center animate-on-scroll">
                <div class="w-24 h-24 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gradient">
                    Портфолио скоро появится
                </h2>
                <p class="text-lg md:text-xl text-gray-400 mb-8 leading-relaxed">
                    Мы новая компания, но у нашей команды более 10 лет опыта в digital-маркетинге. 
                    Мы работали над проектом <strong class="text-white">motorland.kz</strong> и другими успешными кейсами.
                </p>
                <p class="text-base md:text-lg text-gray-400 mb-8">
                    Портфолио будет пополняться по мере работы с новыми клиентами. 
                    Станьте нашим первым клиентом и получите <strong class="text-neon-blue">6 месяцев бесплатной поддержки</strong>!
                </p>
                <a href="contact.php" class="btn-neon inline-block">
                    Стать первым клиентом
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA секция -->
<section class="py-32 bg-gradient-to-r from-neon-purple/20 to-neon-blue/20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Готовы начать работу?
            </h2>
            <p class="text-xl text-gray-300 mb-12">
                Свяжитесь с нами и обсудим ваш проект
            </p>
            <a href="contact.php" class="btn-neon inline-block">
                Обсудить проект
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

