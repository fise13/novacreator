/**
 * Улучшения для демо-проектов
 * - Плавные анимации переходов между секциями
 * - Переключатель мобильной/десктопной версии
 * - Режим сравнения до/после
 */

(function() {
    'use strict';
    
    // ============================================
    // 1. Плавные анимации переходов между секциями
    // ============================================
    function initSmoothScrollAnimations() {
        // Добавляем плавный скролл для всех якорных ссылок
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || !href) return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    // Анимация fade-out текущей секции
                    const currentSection = document.elementFromPoint(
                        window.innerWidth / 2,
                        window.scrollY + window.innerHeight / 2
                    )?.closest('section');
                    
                    if (currentSection) {
                        currentSection.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        currentSection.style.opacity = '0.7';
                        currentSection.style.transform = 'translateY(-10px)';
                    }
                    
                    // Плавный скролл к целевой секции
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - 80;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Анимация fade-in целевой секции
                    setTimeout(() => {
                        target.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                        target.style.opacity = '0';
                        target.style.transform = 'translateY(20px)';
                        
                        requestAnimationFrame(() => {
                            target.style.opacity = '1';
                            target.style.transform = 'translateY(0)';
                        });
                        
                        // Восстанавливаем текущую секцию
                        if (currentSection) {
                            setTimeout(() => {
                                currentSection.style.opacity = '1';
                                currentSection.style.transform = 'translateY(0)';
                            }, 300);
                        }
                    }, 100);
                }
            });
        });
        
        // Intersection Observer для анимации секций при скролле
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        // Применяем начальные стили и наблюдаем за секциями
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0.8';
            section.style.transform = 'translateY(20px)';
            sectionObserver.observe(section);
        });
    }
    
    // ============================================
    // 2. Переключатель мобильной/десктопной версии
    // ============================================
    function initResponsiveToggle() {
        // Создаем переключатель только если его еще нет
        if (document.getElementById('responsive-toggle')) return;
        
        const toggle = document.createElement('div');
        toggle.id = 'responsive-toggle';
        toggle.innerHTML = `
            <div style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; display: flex; gap: 8px; background: rgba(0,0,0,0.8); backdrop-filter: blur(10px); padding: 8px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                <button id="toggle-mobile" class="responsive-btn" data-view="mobile" style="padding: 8px 12px; border: none; border-radius: 8px; background: #3b82f6; color: white; cursor: pointer; font-size: 12px; font-weight: 600; transition: all 0.2s;">
                    📱 Mobile
                </button>
                <button id="toggle-desktop" class="responsive-btn active" data-view="desktop" style="padding: 8px 12px; border: none; border-radius: 8px; background: #10b981; color: white; cursor: pointer; font-size: 12px; font-weight: 600; transition: all 0.2s;">
                    💻 Desktop
                </button>
            </div>
        `;
        document.body.appendChild(toggle);
        
        const container = document.querySelector('.container') || document.querySelector('main');
        if (!container) return;
        
        let currentView = 'desktop';
        
        function setView(view) {
            currentView = view;
            const buttons = document.querySelectorAll('.responsive-btn');
            
            buttons.forEach(btn => {
                if (btn.dataset.view === view) {
                    btn.classList.add('active');
                    btn.style.opacity = '1';
                    btn.style.transform = 'scale(1.05)';
                } else {
                    btn.classList.remove('active');
                    btn.style.opacity = '0.7';
                    btn.style.transform = 'scale(1)';
                }
            });
            
            if (view === 'mobile') {
                container.style.maxWidth = '375px';
                container.style.margin = '0 auto';
                container.style.padding = '20px 16px';
                container.style.transition = 'all 0.3s ease';
                document.body.style.background = '#f5f5f5';
            } else {
                container.style.maxWidth = '';
                container.style.margin = '';
                container.style.padding = '';
                document.body.style.background = '';
            }
        }
        
        document.getElementById('toggle-mobile').addEventListener('click', () => setView('mobile'));
        document.getElementById('toggle-desktop').addEventListener('click', () => setView('desktop'));
    }
    
    // ============================================
    // 3. Режим сравнения до/после
    // ============================================
    function initBeforeAfterMode() {
        // Ищем секции с классом или data-атрибутом для сравнения
        const comparisonSections = document.querySelectorAll('[data-comparison], .comparison-section');
        
        if (comparisonSections.length === 0) return;
        
        comparisonSections.forEach(section => {
            const beforeContent = section.querySelector('[data-before]') || section.querySelector('.before-content');
            const afterContent = section.querySelector('[data-after]') || section.querySelector('.after-content');
            
            if (!beforeContent || !afterContent) return;
            
            // Создаем переключатель для этой секции
            const toggle = document.createElement('div');
            toggle.className = 'comparison-toggle';
            toggle.innerHTML = `
                <div style="display: flex; gap: 8px; margin-bottom: 20px; background: rgba(0,0,0,0.05); padding: 4px; border-radius: 8px;">
                    <button class="comparison-btn active" data-show="before" style="flex: 1; padding: 8px 16px; border: none; border-radius: 6px; background: #ef4444; color: white; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                        До
                    </button>
                    <button class="comparison-btn" data-show="after" style="flex: 1; padding: 8px 16px; border: none; border-radius: 6px; background: #10b981; color: white; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                        После
                    </button>
                    <button class="comparison-btn" data-show="both" style="flex: 1; padding: 8px 16px; border: none; border-radius: 6px; background: #3b82f6; color: white; cursor: pointer; font-weight: 600; transition: all 0.2s;">
                        Оба
                    </button>
                </div>
            `;
            
            section.insertBefore(toggle, section.firstChild);
            
            const buttons = toggle.querySelectorAll('.comparison-btn');
            let currentView = 'before';
            
            // Начальное состояние
            beforeContent.style.display = 'block';
            afterContent.style.display = 'none';
            beforeContent.style.opacity = '1';
            afterContent.style.opacity = '0';
            
            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const view = btn.dataset.show;
                    currentView = view;
                    
                    buttons.forEach(b => {
                        if (b === btn) {
                            b.classList.add('active');
                            b.style.opacity = '1';
                            b.style.transform = 'scale(1.05)';
                        } else {
                            b.classList.remove('active');
                            b.style.opacity = '0.8';
                            b.style.transform = 'scale(1)';
                        }
                    });
                    
                    // Плавное переключение
                    if (view === 'before') {
                        beforeContent.style.transition = 'opacity 0.3s ease';
                        afterContent.style.transition = 'opacity 0.3s ease';
                        beforeContent.style.display = 'block';
                        beforeContent.style.opacity = '1';
                        afterContent.style.opacity = '0';
                        setTimeout(() => {
                            afterContent.style.display = 'none';
                        }, 300);
                    } else if (view === 'after') {
                        beforeContent.style.transition = 'opacity 0.3s ease';
                        afterContent.style.transition = 'opacity 0.3s ease';
                        afterContent.style.display = 'block';
                        beforeContent.style.opacity = '0';
                        afterContent.style.opacity = '1';
                        setTimeout(() => {
                            beforeContent.style.display = 'none';
                        }, 300);
                    } else {
                        beforeContent.style.transition = 'opacity 0.3s ease';
                        afterContent.style.transition = 'opacity 0.3s ease';
                        beforeContent.style.display = 'block';
                        afterContent.style.display = 'block';
                        beforeContent.style.opacity = '1';
                        afterContent.style.opacity = '1';
                    }
                });
            });
        });
    }
    
    // Инициализация при загрузке DOM
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initSmoothScrollAnimations();
            initResponsiveToggle();
            initBeforeAfterMode();
        });
    } else {
        initSmoothScrollAnimations();
        initResponsiveToggle();
        initBeforeAfterMode();
    }
})();

