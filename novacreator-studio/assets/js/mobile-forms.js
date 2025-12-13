/**
 * Оптимизация форм для мобильных устройств
 * - Улучшенные input типы для мобильных клавиатур
 * - Предотвращение zoom на iOS
 * - Улучшенная валидация в реальном времени
 * - Автозаполнение и подсказки
 */

(function() {
    'use strict';
    
    const isMobile = window.innerWidth < 768 || 'ontouchstart' in window;
    if (!isMobile) return;
    
    // ============================================
    // 1. Оптимизация input типов для мобильных клавиатур
    // ============================================
    function optimizeInputTypes() {
        const forms = document.querySelectorAll('form, .contact-form');
        
        forms.forEach(form => {
            // Email поля
            const emailInputs = form.querySelectorAll('input[type="email"], input[name="email"]');
            emailInputs.forEach(input => {
                if (input.type !== 'email') {
                    input.type = 'email';
                }
                input.setAttribute('autocomplete', 'email');
                input.setAttribute('inputmode', 'email');
                input.setAttribute('spellcheck', 'false');
            });
            
            // Телефонные поля
            const telInputs = form.querySelectorAll('input[type="tel"], input[name="phone"], input[name="telephone"]');
            telInputs.forEach(input => {
                if (input.type !== 'tel') {
                    input.type = 'tel';
                }
                input.setAttribute('autocomplete', 'tel');
                input.setAttribute('inputmode', 'tel');
                input.setAttribute('pattern', '[0-9+\\s\\-\\(\\)]*');
            });
            
            // Имя
            const nameInputs = form.querySelectorAll('input[name="name"], input[placeholder*="имя" i], input[placeholder*="name" i]');
            nameInputs.forEach(input => {
                input.setAttribute('autocomplete', 'name');
                input.setAttribute('autocapitalize', 'words');
            });
            
            // URL поля
            const urlInputs = form.querySelectorAll('input[type="url"], input[name="url"], input[name="website"]');
            urlInputs.forEach(input => {
                input.setAttribute('autocomplete', 'url');
                input.setAttribute('inputmode', 'url');
            });
            
            // Числовые поля
            const numberInputs = form.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                input.setAttribute('inputmode', 'numeric');
            });
        });
    }
    
    // ============================================
    // 2. Предотвращение zoom на iOS при фокусе
    // ============================================
    function preventIOSZoom() {
        const textInputs = document.querySelectorAll('input, textarea, select');
        
        textInputs.forEach(input => {
            // Проверяем размер шрифта
            const computedStyle = window.getComputedStyle(input);
            const fontSize = parseFloat(computedStyle.fontSize);
            
            // Если размер меньше 16px, увеличиваем до 16px для предотвращения zoom на iOS
            if (fontSize < 16) {
                input.style.fontSize = '16px';
            }
            
            // Добавляем обработчик focus для дополнительной защиты
            input.addEventListener('focus', function() {
                if (this.style.fontSize === '' || parseFloat(this.style.fontSize) < 16) {
                    this.style.fontSize = '16px';
                }
            }, { passive: true });
        });
    }
    
    // ============================================
    // 3. Улучшенная валидация в реальном времени
    // ============================================
    function enhanceRealTimeValidation() {
        const forms = document.querySelectorAll('form, .contact-form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Удаляем старые индикаторы ошибок
                function removeError() {
                    const errorMsg = input.parentElement.querySelector('.mobile-error-message');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                    input.classList.remove('mobile-error');
                    input.style.borderColor = '';
                }
                
                // Показываем ошибку
                function showError(message) {
                    removeError();
                    input.classList.add('mobile-error');
                    input.style.borderColor = '#ef4444';
                    
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'mobile-error-message';
                    errorDiv.style.cssText = 'color: #ef4444; font-size: 12px; margin-top: 4px; padding-left: 4px;';
                    errorDiv.textContent = message;
                    input.parentElement.appendChild(errorDiv);
                }
                
                // Валидация при blur
                input.addEventListener('blur', function() {
                    if (!this.hasAttribute('required')) return;
                    
                    const value = this.value.trim();
                    
                    // Email валидация
                    if (this.type === 'email' || this.name === 'email') {
                        if (value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                            showError('Введите корректный email');
                            return;
                        }
                    }
                    
                    // Телефон валидация
                    if (this.type === 'tel' || this.name === 'phone' || this.name === 'telephone') {
                        const phoneDigits = value.replace(/[\s\-\(\)]/g, '');
                        if (value && (!/^(\+?7|8)?[0-9]{10}$/.test(phoneDigits) || phoneDigits.length < 10)) {
                            showError('Введите корректный номер телефона');
                            return;
                        }
                    }
                    
                    // Обязательное поле
                    if (this.hasAttribute('required') && !value) {
                        showError('Это поле обязательно для заполнения');
                        return;
                    }
                    
                    // Минимальная длина
                    const minLength = this.getAttribute('minlength');
                    if (minLength && value.length < parseInt(minLength)) {
                        showError(`Минимум ${minLength} символов`);
                        return;
                    }
                    
                    // Если все хорошо, убираем ошибку
                    removeError();
                    input.style.borderColor = '#10b981';
                    
                    setTimeout(() => {
                        input.style.borderColor = '';
                    }, 2000);
                }, { passive: true });
                
                // Убираем ошибку при вводе
                input.addEventListener('input', function() {
                    if (this.classList.contains('mobile-error')) {
                        const errorMsg = this.parentElement.querySelector('.mobile-error-message');
                        if (errorMsg && errorMsg.textContent !== 'Это поле обязательно для заполнения') {
                            removeError();
                        }
                    }
                }, { passive: true });
            });
        });
    }
    
    // ============================================
    // 4. Улучшенное автозаполнение
    // ============================================
    function enhanceAutocomplete() {
        const forms = document.querySelectorAll('form, .contact-form');
        
        forms.forEach(form => {
            // Добавляем атрибуты для лучшего автозаполнения
            const nameInput = form.querySelector('input[name="name"]');
            if (nameInput) {
                nameInput.setAttribute('autocomplete', 'name');
            }
            
            const emailInput = form.querySelector('input[type="email"], input[name="email"]');
            if (emailInput) {
                emailInput.setAttribute('autocomplete', 'email');
            }
            
            const phoneInput = form.querySelector('input[type="tel"], input[name="phone"]');
            if (phoneInput) {
                phoneInput.setAttribute('autocomplete', 'tel');
            }
            
            const messageInput = form.querySelector('textarea[name="message"]');
            if (messageInput) {
                messageInput.setAttribute('autocomplete', 'off');
            }
        });
    }
    
    // ============================================
    // 5. Улучшенный UX для мобильных форм
    // ============================================
    function enhanceMobileUX() {
        const forms = document.querySelectorAll('form, .contact-form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach((input, index) => {
                // Улучшенные размеры для touch
                if (input.tagName !== 'SELECT') {
                    input.style.minHeight = '44px';
                    input.style.padding = '12px 16px';
                }
                
                // Добавляем визуальную обратную связь
                input.addEventListener('focus', function() {
                    this.style.transition = 'all 0.2s ease';
                    this.style.transform = 'scale(1.02)';
                    this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                    
                    // Haptic feedback
                    if ('vibrate' in navigator) {
                        navigator.vibrate(5);
                    }
                }, { passive: true });
                
                input.addEventListener('blur', function() {
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = '';
                }, { passive: true });
                
                // Enter для перехода к следующему полю
                if (input.tagName !== 'TEXTAREA' && input.tagName !== 'SELECT') {
                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            const nextInput = inputs[index + 1];
                            if (nextInput) {
                                nextInput.focus();
                            } else {
                                // Если это последнее поле, фокусируемся на кнопке отправки
                                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                                if (submitBtn) {
                                    submitBtn.focus();
                                }
                            }
                        }
                    }, { passive: false });
                }
            });
            
            // Улучшаем кнопку отправки
            const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn) {
                submitBtn.style.minHeight = '48px';
                submitBtn.style.fontSize = '16px';
                submitBtn.style.fontWeight = '600';
            }
        });
    }
    
    // ============================================
    // 6. Оптимизация для виртуальных клавиатур
    // ============================================
    function optimizeForVirtualKeyboard() {
        // Предотвращаем скролл при открытии клавиатуры
        let activeInput = null;
        
        document.addEventListener('focusin', function(e) {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                activeInput = e.target;
                
                // Прокручиваем к активному полю
                setTimeout(() => {
                    if (activeInput) {
                        activeInput.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center',
                            inline: 'nearest'
                        });
                    }
                }, 300);
            }
        }, { passive: true });
        
        document.addEventListener('focusout', function(e) {
            if (e.target === activeInput) {
                activeInput = null;
            }
        }, { passive: true });
    }
    
    // Инициализация
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            optimizeInputTypes();
            preventIOSZoom();
            enhanceRealTimeValidation();
            enhanceAutocomplete();
            enhanceMobileUX();
            optimizeForVirtualKeyboard();
        });
    } else {
        optimizeInputTypes();
        preventIOSZoom();
        enhanceRealTimeValidation();
        enhanceAutocomplete();
        enhanceMobileUX();
        optimizeForVirtualKeyboard();
    }
})();

