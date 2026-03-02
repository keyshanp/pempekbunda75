// Fix untuk Alpine.js error di Filament
document.addEventListener('alpine:init', () => {
    // Override default event listener untuk handle undefined $event
    Alpine.directive('on', (el, { value, expression, modifiers }, { evaluate }) => {
        const handler = (e) => {
            try {
                if (e && typeof e.detail !== 'undefined') {
                    evaluate(expression, { '$event': e });
                }
            } catch (error) {
                console.warn('Alpine event handler error:', error);
            }
        };

        el.addEventListener(value, handler);

        // Cleanup
        el._x_cleanups = el._x_cleanups || [];
        el._x_cleanups.push(() => {
            el.removeEventListener(value, handler);
        });
    });
});