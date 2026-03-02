<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix untuk Alpine.js error di Filament
        Blade::directive('alpineFix', function () {
            return <<<'HTML'
            <script>
                document.addEventListener('alpine:init', () => {
                    // Override untuk handle undefined events
                    const originalDirective = Alpine.directive('on');
                    
                    Alpine.directive('on', (el, { value, expression, modifiers }, { evaluate, cleanup }) => {
                        // Jika expression mengandung $event.detail
                        if (expression.includes('$event.detail')) {
                            const handler = (e) => {
                                try {
                                    evaluate(expression, { '$event': e || {} });
                                } catch (error) {
                                    console.warn('Alpine handler error:', error);
                                }
                            };
                            
                            el.addEventListener(value, handler);
                            
                            cleanup(() => {
                                el.removeEventListener(value, handler);
                            });
                            
                            return;
                        }
                        
                        // Gunakan original untuk yang lain
                        return originalDirective(el, { value, expression, modifiers }, { evaluate, cleanup });
                    });
                });
            </script>
            HTML;
        });
    }
}