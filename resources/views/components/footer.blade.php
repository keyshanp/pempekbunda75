<footer class="w-full bg-terracotta text-white py-8 md:py-12 px-6 md:px-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-8 md:gap-0">
        
        <!-- Left: Social Media -->
        <div class="flex flex-col gap-3 md:gap-4">
            <h3 class="text-xl md:text-2xl reenie-beanie tracking-wide mb-2">Find us on</h3>
            
            <div class="flex flex-col gap-2">
                <a href="https://instagram.com/pempekbunda75" target="_blank" 
                   class="text-lg md:text-xl reenie-beanie hover:text-gray-200 transition-colors flex items-center gap-3">
                    <i class="fab fa-instagram text-xl"></i>
                    <span>Instagram</span>
                </a>
                <a href="https://tiktok.com/@pempekbunda75" target="_blank" 
                   class="text-lg md:text-xl reenie-beanie hover:text-gray-200 transition-colors flex items-center gap-3">
                    <i class="fab fa-tiktok text-xl"></i>
                    <span>Tiktok</span>
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" 
                   class="text-lg md:text-xl reenie-beanie hover:text-gray-200 transition-colors flex items-center gap-3">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>Whatsapp</span>
                </a>
            </div>
        </div>

        <!-- Center: Quick Links -->
        <div class="hidden md:flex flex-col gap-3">
            <h3 class="text-xl reenie-beanie tracking-wide mb-2">Quick Links</h3>
            <a href="{{ route('home') }}" class="text-lg reenie-beanie hover:text-gray-200 transition-colors">
                Home
            </a>
            <a href="{{ route('produk.index') }}" class="text-lg reenie-beanie hover:text-gray-200 transition-colors">
                Produk
            </a>
            <a href="{{ route('order.index') }}" class="text-lg reenie-beanie hover:text-gray-200 transition-colors">
                Order
            </a>
            <a href="#location" class="text-lg reenie-beanie hover:text-gray-200 transition-colors">
                Location
            </a>
        </div>

        <!-- Right: Copyright -->
        <div class="flex items-center gap-2 text-xl md:text-2xl reenie-beanie">
            <span>&copy;</span>
            <span>{{ date('Y') }} Pempek Bunda 75</span>
        </div>

    </div>
    
    <!-- Decorative Stars -->
    <div class="absolute top-4 left-4 opacity-20">
        <i class="fas fa-star text-lg"></i>
    </div>
    <div class="absolute bottom-4 right-4 opacity-20">
        <i class="fas fa-star text-lg"></i>
    </div>
</footer>