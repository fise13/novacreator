<?php
/**
 * Страница контактов
 * Минималистичный дизайн в стиле holymedia.kz
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
<section class="pt-24 md:pt-32 pb-16 md:pb-20" style="background-color: var(--color-bg);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold mb-8 md:mb-12 leading-tight animate-on-scroll" style="color: var(--color-text);">
                <?php echo htmlspecialchars(t('pages.contact.title')); ?>
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl mb-12 leading-relaxed animate-on-scroll" style="animation-delay: 0.1s; color: var(--color-text-secondary); max-width: 65ch;">
                <?php echo htmlspecialchars(t('pages.contact.subtitle')); ?>
            </p>
        </div>
    </div>
</section>

<!-- Контакты и форма -->
<section class="py-16 md:py-24" style="background-color: var(--color-bg-lighter);">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-16">
                <!-- Контактная информация -->
                <div class="animate-on-scroll">
                    <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-8 md:mb-12 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.contact.contactInfo')); ?>
                    </h2>
                    
                    <div class="space-y-8 mb-12">
                        <!-- Email -->
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-2" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.contact.email')); ?>
                            </h3>
                            <a href="mailto:contact@novacreatorstudio.com" class="text-lg md:text-xl hover:underline" style="color: var(--color-text-secondary);">
                                contact@novacreatorstudio.com
                            </a>
                        </div>
                        
                        <!-- Телефон -->
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-2" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.contact.phone')); ?>
                            </h3>
                            <a href="tel:+77066063921" class="text-lg md:text-xl hover:underline" style="color: var(--color-text-secondary);">
                                +7 706 606 39 21
                            </a>
                        </div>
                        
                        <!-- Время работы -->
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold mb-2" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.contact.workingHours')); ?>
                            </h3>
                            <p class="text-lg md:text-xl" style="color: var(--color-text-secondary);">
                                <?php echo htmlspecialchars(t('pages.contact.workingHoursText')); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Форма обратной связи -->
                <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                    <h2 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-8 md:mb-12 leading-tight" style="color: var(--color-text);">
                        <?php echo htmlspecialchars(t('pages.contact.form.title')); ?>
                    </h2>
                    
                    <form class="contact-form space-y-6" method="POST" action="/backend/send.php">
                        <!-- Скрытые поля -->
                        <input type="hidden" id="form_type" name="type" value="contact">
                        <input type="hidden" id="form_vacancy" name="vacancy" value="">
                        <input type="hidden" name="form_name" value="<?php echo htmlspecialchars(t('pages.contact.form.title')); ?>">
                        <input type="text" name="website" tabindex="-1" autocomplete="off" style="position: absolute; left: -9999px;" aria-hidden="true">
                        
                        <!-- Имя -->
                        <div>
                            <label for="name" class="block mb-2 font-semibold" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.contact.form.name')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" 
                                style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                                placeholder="<?php echo htmlspecialchars(t('pages.contact.form.namePlaceholder')); ?>"
                                required
                            >
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block mb-2 font-semibold" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.contact.form.email')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" 
                                style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                                placeholder="<?php echo htmlspecialchars(t('pages.contact.form.emailPlaceholder')); ?>"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                required
                                autocomplete="email"
                            >
                            <p class="text-sm mt-1 hidden" id="email-error" style="color: var(--color-text-secondary);">Введите корректный email адрес</p>
                        </div>
                        
                        <!-- Телефон -->
                        <div>
                            <label for="phone" class="block mb-2 font-semibold" style="color: var(--color-text);">
                                <?php echo htmlspecialchars(t('pages.contact.form.phone')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone" 
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors" 
                                style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                                placeholder="+7 (700) 123-45-67"
                                pattern="^(\+7|7|8)?[\s\-]?\(?[0-9]{3}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$"
                                required
                                autocomplete="tel"
                                maxlength="18"
                            >
                            <p class="text-sm mt-1 hidden" id="phone-error" style="color: var(--color-text-secondary);">Введите корректный номер телефона</p>
                        </div>
                        
                        <!-- Услуга -->
                        <div id="service_field">
                            <label for="service" class="block mb-2 font-semibold" style="color: var(--color-text);">
                                <span id="service_label"><?php echo htmlspecialchars(t('pages.contact.form.service')); ?></span>
                            </label>
                            <select 
                                id="service" 
                                name="service" 
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors"
                                style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
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
                            <label for="message" class="block mb-2 font-semibold" style="color: var(--color-text);">
                                <span id="message_label"><?php echo htmlspecialchars(t('pages.contact.form.message')); ?></span> <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5" 
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:ring-2 transition-colors resize-none"
                                style="background-color: var(--color-bg); border-color: var(--color-border); color: var(--color-text);"
                                placeholder="<?php echo htmlspecialchars(t('pages.contact.form.messagePlaceholder')); ?>"
                                required
                            ></textarea>
                        </div>
                        
                        <!-- Кнопка отправки -->
                        <button type="submit" class="w-full px-10 py-5 bg-black text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-colors duration-200 min-h-[56px]" id="submit_btn">
                            <?php echo htmlspecialchars(t('pages.contact.form.send')); ?>
                        </button>
                        
                        <p class="text-sm text-center" style="color: var(--color-text-secondary);">
                            <?php echo htmlspecialchars(t('pages.contact.form.privacy')); ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Скрипт для валидации формы -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const emailError = document.getElementById('email-error');
    const phoneError = document.getElementById('phone-error');
    const form = document.querySelector('.contact-form');
    
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }
    
    function validatePhone(phone) {
        const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');
        const phoneRegex = /^(\+?7|8)?[0-9]{10}$/;
        return phoneRegex.test(cleanPhone) && cleanPhone.length >= 10;
    }
    
    function formatPhone(value) {
        let cleaned = value.replace(/[^\d+]/g, '');
        if (cleaned.startsWith('8')) {
            cleaned = '+7' + cleaned.substring(1);
        } else if (cleaned.startsWith('7') && !cleaned.startsWith('+7')) {
            cleaned = '+7' + cleaned.substring(1);
        } else if (!cleaned.startsWith('+7')) {
            cleaned = '+7' + cleaned;
        }
        cleaned = cleaned.substring(0, 12);
        if (cleaned.length > 2) {
            let formatted = cleaned.substring(0, 2) + ' ';
            if (cleaned.length > 2) {
                formatted += '(' + cleaned.substring(2, 5);
            }
            if (cleaned.length > 5) {
                formatted += ') ' + cleaned.substring(5, 8);
            }
            if (cleaned.length > 8) {
                formatted += '-' + cleaned.substring(8, 10);
            }
            if (cleaned.length > 10) {
                formatted += '-' + cleaned.substring(10, 12);
            }
            return formatted;
        }
        return cleaned;
    }
    
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const email = emailInput.value.trim();
            if (email && !validateEmail(email)) {
                emailInput.style.borderColor = '#ef4444';
                if (emailError) {
                    emailError.classList.remove('hidden');
                }
            } else {
                emailInput.style.borderColor = '';
                if (emailError) {
                    emailError.classList.add('hidden');
                }
            }
        });
    }
    
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            e.target.value = formatPhone(e.target.value);
            const phone = e.target.value.trim();
            if (phone && !validatePhone(phone)) {
                phoneInput.style.borderColor = '#ef4444';
                if (phoneError) {
                    phoneError.classList.remove('hidden');
                }
            } else {
                phoneInput.style.borderColor = '';
                if (phoneError) {
                    phoneError.classList.add('hidden');
                }
            }
        });
        
        phoneInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            phoneInput.value = formatPhone(pastedText);
            phoneInput.dispatchEvent(new Event('input'));
        });
    }
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const email = emailInput ? emailInput.value.trim() : '';
            const phone = phoneInput ? phoneInput.value.trim() : '';
            let isValid = true;
            
            if (email && !validateEmail(email)) {
                isValid = false;
                if (emailInput) {
                    emailInput.style.borderColor = '#ef4444';
                    emailInput.focus();
                }
                if (emailError) {
                    emailError.classList.remove('hidden');
                }
            }
            
            if (phone && !validatePhone(phone)) {
                isValid = false;
                if (phoneInput) {
                    phoneInput.style.borderColor = '#ef4444';
                    if (!email || validateEmail(email)) {
                        phoneInput.focus();
                    }
                }
                if (phoneError) {
                    phoneError.classList.remove('hidden');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    }
    
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get('type');
    const vacancy = urlParams.get('vacancy');
    
    if (type === 'vacancy' && vacancy) {
        document.getElementById('form_type').value = 'vacancy';
        document.getElementById('form_vacancy').value = decodeURIComponent(vacancy);
        const formNameInput = document.querySelector('input[name="form_name"]');
        if (formNameInput) {
            formNameInput.value = 'Отклик на вакансию: ' + decodeURIComponent(vacancy);
        }
        const serviceField = document.getElementById('service_field');
        const messageLabel = document.getElementById('message_label');
        const messageTextarea = document.getElementById('message');
        const submitBtn = document.getElementById('submit_btn');
        serviceField.style.display = 'none';
        messageLabel.textContent = 'Сообщение / Резюме';
        messageTextarea.placeholder = 'Расскажите о себе, приложите ссылку на резюме или опишите свой опыт...';
        submitBtn.textContent = 'Откликнуться на вакансию';
    }
    
    // Анимация появления
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
