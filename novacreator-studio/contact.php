<?php
/**
 * Страница контактов
 * Форма обратной связи и контактная информация
 */
require_once __DIR__ . '/includes/i18n.php';
$currentLang = getCurrentLanguage();

$pageTitle = t('pages.contact.breadcrumb');
$pageMetaTitle = t('seo.pages.contact.title');
$pageMetaDescription = t('seo.pages.contact.description');
$pageMetaKeywords = t('seo.pages.contact.keywords');
include 'includes/header.php';
?>

<!-- Hero секция -->
<section class="pt-32 pb-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center animate-on-scroll">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6">
                <span class="text-gradient"><?php echo htmlspecialchars(t('pages.contact.title')); ?></span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-12">
                <?php echo htmlspecialchars(t('pages.contact.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Контакты и форма -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Контактная информация -->
            <div class="animate-on-scroll">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 md:mb-8 text-gradient"><?php echo htmlspecialchars(t('pages.contact.contactInfo')); ?></h2>
                
                <div class="space-y-6 md:space-y-8 mb-8 md:mb-12">
                    <!-- Email -->
                    <div class="flex items-start space-x-3 md:space-x-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center flex-shrink-0 min-w-[40px] md:min-w-[48px]">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-bold mb-1 md:mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.contact.email')); ?></h3>
                            <a href="mailto:contact@novacreatorstudio.com" class="text-sm md:text-base text-gray-400 hover:text-neon-purple transition-colors break-all">
                                contact@novacreatorstudio.com
                            </a>
                        </div>
                    </div>
                    
                    <!-- Телефон -->
                    <div class="flex items-start space-x-3 md:space-x-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-r from-neon-blue to-neon-purple rounded-lg flex items-center justify-center flex-shrink-0 min-w-[40px] md:min-w-[48px]">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-bold mb-1 md:mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.contact.phone')); ?></h3>
                            <a href="tel:+77066063921" class="text-sm md:text-base text-gray-400 hover:text-neon-purple transition-colors touch-manipulation">
                                +7 706 606 39 21
                            </a>
                        </div>
                    </div>
                    
                    <!-- Время работы -->
                    <div class="flex items-start space-x-3 md:space-x-4">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center flex-shrink-0 min-w-[40px] md:min-w-[48px]">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg md:text-xl font-bold mb-1 md:mb-2 text-gradient"><?php echo htmlspecialchars(t('pages.contact.workingHours')); ?></h3>
                            <p class="text-sm md:text-base text-gray-400">
                                <?php echo htmlspecialchars(t('pages.contact.workingHoursText')); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Социальные сети -->
                <div>
                    <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4 text-gradient"><?php echo htmlspecialchars(t('pages.contact.social')); ?></h3>
                    <div class="flex space-x-3 md:space-x-4">
                        <a href="https://www.instagram.com/novacreatorstudio.iv?igsh=cGsxcjRxbnIweGN6&utm_source=qr" target="_blank" rel="noopener noreferrer" class="w-10 h-10 md:w-12 md:h-12 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300 min-w-[40px] md:min-w-[48px] touch-manipulation">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 md:w-12 md:h-12 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300 min-w-[40px] md:min-w-[48px] touch-manipulation">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 md:w-12 md:h-12 bg-dark-surface border border-dark-border rounded-lg flex items-center justify-center hover:border-neon-purple hover:text-neon-purple transition-all duration-300 min-w-[40px] md:min-w-[48px] touch-manipulation">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.246 1.805-.413 2.227-.217.562-.477.96-.896 1.382-.42.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.246-2.236-.413-.569-.224-.96-.479-1.379-.896-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.817.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Форма обратной связи -->
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="bg-dark-surface border border-dark-border rounded-2xl p-4 md:p-6 lg:p-8">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-6 md:mb-8 text-gradient"><?php echo htmlspecialchars(t('pages.contact.form.title')); ?></h2>
                    
                    <form class="contact-form space-y-6" method="POST" action="/backend/send.php">
                        <!-- Скрытые поля для определения типа заявки -->
                        <input type="hidden" id="form_type" name="type" value="contact">
                        <input type="hidden" id="form_vacancy" name="vacancy" value="">
                        <input type="hidden" name="form_name" value="<?php echo htmlspecialchars(t('pages.contact.form.title')); ?>">
                        
                        <!-- Honeypot поле для защиты от спама (должно быть скрыто и пусто) -->
                        <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">
                        
                        <!-- Имя -->
                        <div>
                            <label for="name" class="block text-gray-300 mb-2 font-medium">
                                <?php echo htmlspecialchars(t('pages.contact.form.name')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-input" 
                                placeholder="<?php echo htmlspecialchars(t('pages.contact.form.namePlaceholder')); ?>"
                                required
                            >
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-300 mb-2 font-medium">
                                <?php echo htmlspecialchars(t('pages.contact.form.email')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-input" 
                                placeholder="<?php echo htmlspecialchars(t('pages.contact.form.emailPlaceholder')); ?>"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                required
                                autocomplete="email"
                            >
                            <p class="text-xs text-gray-500 mt-1 hidden" id="email-error">Введите корректный email адрес (например: example@mail.com)</p>
                        </div>
                        
                        <!-- Телефон -->
                        <div>
                            <label for="phone" class="block text-gray-300 mb-2 font-medium">
                                <?php echo htmlspecialchars(t('pages.contact.form.phone')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="form-input" 
                                placeholder="+7 (700) 123-45-67"
                                pattern="^(\+7|7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$"
                                required
                                autocomplete="tel"
                                maxlength="18"
                            >
                            <p class="text-xs text-gray-500 mt-1 hidden" id="phone-error">Введите корректный номер телефона (например: +7 700 123 45 67)</p>
                        </div>
                        
                        <!-- Услуга / Вакансия -->
                        <div id="service_field">
                            <label for="service" class="block text-gray-300 mb-2 font-medium">
                                <span id="service_label"><?php echo htmlspecialchars(t('pages.contact.form.service')); ?></span>
                            </label>
                            <select 
                                id="service" 
                                name="service" 
                                class="form-input"
                            >
                                <option value=""><?php echo htmlspecialchars(t('pages.contact.form.servicePlaceholder')); ?></option>
                                <option value="<?php echo htmlspecialchars(t('pages.services.seo.title')); ?>"><?php echo htmlspecialchars(t('pages.services.seo.title')); ?></option>
                                <option value="<?php echo htmlspecialchars(t('pages.services.development.title')); ?>"><?php echo htmlspecialchars(t('pages.services.development.title')); ?></option>
                                <option value="<?php echo htmlspecialchars(t('pages.services.ads.title')); ?>"><?php echo htmlspecialchars(t('pages.services.ads.title')); ?></option>
                                <option value="<?php echo htmlspecialchars(t('pages.services.marketing.title')); ?>"><?php echo htmlspecialchars(t('pages.services.marketing.title')); ?></option>
                                <option value="<?php echo htmlspecialchars(t('pages.services.analytics.title')); ?>"><?php echo htmlspecialchars(t('pages.services.analytics.title')); ?></option>
                            </select>
                        </div>
                        
                        <!-- Сообщение -->
                        <div>
                            <label for="message" class="block text-gray-300 mb-2 font-medium">
                                <span id="message_label"><?php echo htmlspecialchars(t('pages.contact.form.message')); ?></span> <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5" 
                                class="form-textarea" 
                                placeholder="<?php echo htmlspecialchars(t('pages.contact.form.messagePlaceholder')); ?>"
                                required
                            ></textarea>
                        </div>
                        
                        <!-- Кнопка отправки -->
                        <button type="submit" class="btn-neon w-full" id="submit_btn">
                            <?php echo htmlspecialchars(t('pages.contact.form.send')); ?>
                        </button>
                        
                        <p class="text-sm text-gray-500 text-center">
                            <?php echo htmlspecialchars(t('pages.contact.form.privacy')); ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ секция -->
<section class="py-20 bg-dark-surface">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.title')); ?></h2>
                <p class="text-xl text-gray-400">
                    <?php echo htmlspecialchars(t('pages.contact.faq.subtitle')); ?>
                </p>
            </div>
            
            <div class="space-y-6">
                <!-- FAQ 1 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.response.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.response.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 2 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.1s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.consultation.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.consultation.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 3 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.2s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.small.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.small.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 4 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.remote.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.remote.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 5 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.4s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.experience.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.experience.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 6 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.5s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.services.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.services.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 7 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.6s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.price.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.price.answer')); ?>
                    </p>
                </div>
                
                <!-- FAQ 8 -->
                <div class="bg-dark-bg border border-dark-border rounded-xl p-6 animate-on-scroll" style="animation-delay: 0.7s;">
                    <h3 class="text-xl font-bold mb-3 text-gradient"><?php echo htmlspecialchars(t('pages.contact.faq.items.start.question')); ?></h3>
                    <p class="text-gray-400">
                        <?php echo htmlspecialchars(t('pages.contact.faq.items.start.answer')); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Скрипт для валидации формы и обработки параметров URL -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Элементы формы
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const emailError = document.getElementById('email-error');
    const phoneError = document.getElementById('phone-error');
    const form = document.querySelector('.contact-form');
    
    // Функция валидации email
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }
    
    // Функция валидации телефона (российский формат)
    function validatePhone(phone) {
        // Убираем все пробелы, дефисы и скобки для проверки
        const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');
        // Проверяем формат: +7 или 7 или 8, затем 10 цифр
        const phoneRegex = /^(\+?7|8)?[0-9]{10}$/;
        return phoneRegex.test(cleanPhone) && cleanPhone.length >= 10;
    }
    
    // Функция форматирования телефона
    function formatPhone(value) {
        // Убираем все нецифровые символы кроме +
        let cleaned = value.replace(/[^\d+]/g, '');
        
        // Если начинается с 8, заменяем на +7
        if (cleaned.startsWith('8')) {
            cleaned = '+7' + cleaned.substring(1);
        }
        // Если начинается с 7 без +, добавляем +
        else if (cleaned.startsWith('7') && !cleaned.startsWith('+7')) {
            cleaned = '+7' + cleaned.substring(1);
        }
        // Если не начинается с +7, добавляем
        else if (!cleaned.startsWith('+7')) {
            cleaned = '+7' + cleaned;
        }
        
        // Ограничиваем длину (максимум 12 символов: +7XXXXXXXXXX)
        cleaned = cleaned.substring(0, 12);
        
        // Форматируем: +7 (XXX) XXX-XX-XX
        if (cleaned.length > 2) {
            let formatted = cleaned.substring(0, 2) + ' '; // +7 
            if (cleaned.length > 2) {
                formatted += '(' + cleaned.substring(2, 5); // (XXX
            }
            if (cleaned.length > 5) {
                formatted += ') ' + cleaned.substring(5, 8); // ) XXX
            }
            if (cleaned.length > 8) {
                formatted += '-' + cleaned.substring(8, 10); // -XX
            }
            if (cleaned.length > 10) {
                formatted += '-' + cleaned.substring(10, 12); // -XX
            }
            return formatted;
        }
        
        return cleaned;
    }
    
    // Валидация email в реальном времени
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const email = emailInput.value.trim();
            if (email && !validateEmail(email)) {
                emailInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                emailInput.classList.remove('border-dark-border', 'focus:border-neon-purple', 'focus:ring-neon-purple/20');
                if (emailError) {
                    emailError.classList.remove('hidden');
                    emailError.classList.add('text-red-400');
                }
            } else {
                emailInput.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                emailInput.classList.add('border-dark-border', 'focus:border-neon-purple', 'focus:ring-neon-purple/20');
                if (emailError) {
                    emailError.classList.add('hidden');
                }
            }
        });
        
        emailInput.addEventListener('input', function() {
            if (emailInput.classList.contains('border-red-500')) {
                const email = emailInput.value.trim();
                if (validateEmail(email) || !email) {
                    emailInput.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                    emailInput.classList.add('border-dark-border', 'focus:border-neon-purple', 'focus:ring-neon-purple/20');
                    if (emailError) {
                        emailError.classList.add('hidden');
                    }
                }
            }
        });
    }
    
    // Маска и валидация телефона в реальном времени
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            const cursorPosition = e.target.selectionStart;
            const oldValue = e.target.value;
            const newValue = formatPhone(e.target.value);
            
            e.target.value = newValue;
            
            // Восстанавливаем позицию курсора
            const lengthDiff = newValue.length - oldValue.length;
            e.target.setSelectionRange(cursorPosition + lengthDiff, cursorPosition + lengthDiff);
            
            // Валидация
            const phone = e.target.value.trim();
            if (phone && !validatePhone(phone)) {
                phoneInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                phoneInput.classList.remove('border-dark-border', 'focus:border-neon-purple', 'focus:ring-neon-purple/20');
                if (phoneError) {
                    phoneError.classList.remove('hidden');
                    phoneError.classList.add('text-red-400');
                }
            } else {
                phoneInput.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                phoneInput.classList.add('border-dark-border', 'focus:border-neon-purple', 'focus:ring-neon-purple/20');
                if (phoneError) {
                    phoneError.classList.add('hidden');
                }
            }
        });
        
        phoneInput.addEventListener('blur', function() {
            const phone = phoneInput.value.trim();
            if (phone && !validatePhone(phone)) {
                phoneInput.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/20');
                phoneInput.classList.remove('border-dark-border', 'focus:border-neon-purple', 'focus:ring-neon-purple/20');
                if (phoneError) {
                    phoneError.classList.remove('hidden');
                    phoneError.classList.add('text-red-400');
                }
            }
        });
        
        // Обработка вставки текста
        phoneInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const formatted = formatPhone(pastedText);
            phoneInput.value = formatted;
            phoneInput.dispatchEvent(new Event('input'));
        });
    }
    
    // Валидация перед отправкой формы
    if (form) {
        form.addEventListener('submit', function(e) {
            const email = emailInput ? emailInput.value.trim() : '';
            const phone = phoneInput ? phoneInput.value.trim() : '';
            
            let isValid = true;
            
            // Проверка email
            if (email && !validateEmail(email)) {
                isValid = false;
                if (emailInput) {
                    emailInput.classList.add('border-red-500');
                    emailInput.focus();
                }
                if (emailError) {
                    emailError.classList.remove('hidden');
                    emailError.classList.add('text-red-400');
                }
            }
            
            // Проверка телефона
            if (phone && !validatePhone(phone)) {
                isValid = false;
                if (phoneInput) {
                    phoneInput.classList.add('border-red-500');
                    if (!email || validateEmail(email)) {
                        phoneInput.focus();
                    }
                }
                if (phoneError) {
                    phoneError.classList.remove('hidden');
                    phoneError.classList.add('text-red-400');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    }
    
    // Получаем параметры из URL
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    const vacancy = urlParams.get('vacancy');
    
    // Если это отклик на вакансию
    if (type === 'vacancy' && vacancy) {
        // Устанавливаем скрытые поля
        document.getElementById('form_type').value = 'vacancy';
        document.getElementById('form_vacancy').value = decodeURIComponent(vacancy);
        
        // Устанавливаем название формы
        const formNameInput = document.querySelector('input[name="form_name"]');
        if (formNameInput) {
            formNameInput.value = 'Отклик на вакансию: ' + decodeURIComponent(vacancy);
        }
        
        // Меняем интерфейс формы
        const serviceField = document.getElementById('service_field');
        const serviceLabel = document.getElementById('service_label');
        const messageLabel = document.getElementById('message_label');
        const messageTextarea = document.getElementById('message');
        const submitBtn = document.getElementById('submit_btn');
        
        // Скрываем поле услуги и показываем вакансию
        serviceField.style.display = 'none';
        
        // Меняем текст
        messageLabel.textContent = 'Сообщение / Резюме';
        messageTextarea.placeholder = 'Расскажите о себе, приложите ссылку на резюме или опишите свой опыт...';
        submitBtn.textContent = 'Откликнуться на вакансию';
        
        // Добавляем информацию о вакансии перед формой
        const vacancyInfo = document.createElement('div');
        vacancyInfo.className = 'bg-neon-purple/20 border border-neon-purple rounded-lg p-4 mb-6';
        vacancyInfo.innerHTML = `
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-neon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <div>
                    <p class="text-sm text-gray-400">Отклик на вакансию:</p>
                    <p class="text-lg font-bold text-neon-purple">${decodeURIComponent(vacancy)}</p>
                </div>
            </div>
        `;
        form.insertBefore(vacancyInfo, form.firstChild);
    }
});
</script>

<?php include 'includes/footer.php'; ?>

