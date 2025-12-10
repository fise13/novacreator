/**
 * Premium Staggered Reveal Animations
 * GPU-optimized animations with alternating left-right reveals
 * Similar to holymedia.kz section animations
 * 
 * Features:
 * - Alternating fade-left/fade-right animations
 * - Progressive stagger delays (0ms, 120ms, 240ms, etc.)
 * - GPU-friendly transforms only (translateX + opacity)
 * - Single animation trigger on viewport entry
 * - Respects prefers-reduced-motion
 * 
 * Usage:
 * 
 * 1. Add the 'reveal' class to elements you want to animate:
 *    <div class="reveal">First element (slides from left)</div>
 *    <div class="reveal">Second element (slides from right)</div>
 *    <div class="reveal">Third element (slides from left)</div>
 * 
 * 2. Wrap elements in a container with 'reveal-group' class (optional):
 *    <section class="reveal-group">
 *      <div class="reveal">Item 1</div>
 *      <div class="reveal">Item 2</div>
 *      <div class="reveal">Item 3</div>
 *    </section>
 * 
 * 3. Or use standalone reveal elements:
 *    <div class="reveal">Standalone element</div>
 * 
 * The script automatically:
 * - Detects when elements enter the viewport
 * - Assigns alternating fade-left/fade-right classes
 * - Applies progressive delays (0ms, 120ms, 240ms, etc.)
 * - Animates only once per element
 * - Uses GPU-accelerated transforms (translateX + opacity)
 * 
 * Animation timing:
 * - Duration: 800ms (0.8s)
 * - Stagger delay: 120ms between elements
 * - Easing: cubic-bezier(0.25, 0.1, 0.25, 1)
 * - Transform distance: 40px
 */

(function() {
    'use strict';

    // Check for reduced motion preference
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Animation configuration
    const CONFIG = {
        staggerDelay: 120, // Delay between each element in ms
        duration: 800, // Animation duration in ms (0.8s)
        threshold: 0.1, // IntersectionObserver threshold
        rootMargin: '0px 0px -50px 0px', // Trigger animation slightly before element enters viewport
        translateDistance: 40, // Distance to translate (px)
    };

    /**
     * Initialize staggered reveal animations
     */
    function initStaggeredReveal() {
        // Skip if user prefers reduced motion
        if (prefersReducedMotion) {
            // Show all elements immediately without animation
            document.querySelectorAll('.reveal').forEach(el => {
                el.style.opacity = '1';
                el.style.transform = 'translate3d(0, 0, 0)';
            });
            return;
        }

        // Find all reveal containers (sections or containers with .reveal-group)
        const revealGroups = document.querySelectorAll('.reveal-group, section');
        
        revealGroups.forEach(group => {
            // Get all .reveal elements within this group
            const revealElements = group.querySelectorAll('.reveal');
            
            if (revealElements.length === 0) return;

            // Create IntersectionObserver for this group
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Get all reveal elements in this group
                        const elements = entry.target.querySelectorAll('.reveal');
                        
                        elements.forEach((element, index) => {
                            // Skip if already animated
                            if (element.classList.contains('reveal-animated')) return;
                            
                            // Mark as animated
                            element.classList.add('reveal-animated');
                            
                            // Set initial state (hidden)
                            element.style.opacity = '0';
                            element.style.willChange = 'transform, opacity';
                            
                            // Determine animation direction based on index (alternating)
                            const isEven = index % 2 === 0;
                            const animationClass = isEven ? 'animate-fade-left' : 'animate-fade-right';
                            
                            // Calculate stagger delay
                            const delay = index * CONFIG.staggerDelay;
                            
                            // Apply animation with delay
                            setTimeout(() => {
                                element.classList.add(animationClass);
                                element.style.opacity = '1';
                                
                                // Remove will-change after animation completes
                                setTimeout(() => {
                                    element.style.willChange = 'auto';
                                }, CONFIG.duration);
                            }, delay);
                        });
                        
                        // Stop observing this group after animation triggers
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: CONFIG.threshold,
                rootMargin: CONFIG.rootMargin
            });

            // Start observing the group
            observer.observe(group);
        });

        // Also handle standalone .reveal elements (not in groups)
        const standaloneReveals = document.querySelectorAll('.reveal:not(.reveal-group .reveal)');
        
        if (standaloneReveals.length > 0) {
            const standaloneObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        
                        // Skip if already animated
                        if (element.classList.contains('reveal-animated')) return;
                        
                        element.classList.add('reveal-animated');
                        
                        // Set initial state
                        element.style.opacity = '0';
                        element.style.willChange = 'transform, opacity';
                        
                        // Determine animation direction (alternating)
                        const isEven = index % 2 === 0;
                        const animationClass = isEven ? 'animate-fade-left' : 'animate-fade-right';
                        
                        // Calculate delay
                        const delay = index * CONFIG.staggerDelay;
                        
                        setTimeout(() => {
                            element.classList.add(animationClass);
                            element.style.opacity = '1';
                            
                            setTimeout(() => {
                                element.style.willChange = 'auto';
                            }, CONFIG.duration);
                        }, delay);
                        
                        standaloneObserver.unobserve(element);
                    }
                });
            }, {
                threshold: CONFIG.threshold,
                rootMargin: CONFIG.rootMargin
            });

            standaloneReveals.forEach(el => standaloneObserver.observe(el));
        }
    }

    /**
     * Initialize on DOM ready
     */
    function init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }

        initStaggeredReveal();
    }

    // Export for manual initialization if needed
    window.RevealAnimations = {
        init: initStaggeredReveal,
        CONFIG
    };

    // Auto-initialize
    init();
})();

