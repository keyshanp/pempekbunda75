// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Cart System Function
window.cartSystem = function() {
  return {
    cart: [],
    cartCount: 0,
    cartTotal: 0,
    cartDrawerOpen: false,
    modalOpen: false,
    selectedProduct: {},
    quantity: 1,
    
    init() {
      console.log('Cart System Initialized');
      this.initCart();
    },
    
    initCart() {
      try {
        const saved = localStorage.getItem('cart');
        this.cart = saved ? JSON.parse(saved) : [];
        this.updateCartSummary();
        console.log('Cart loaded:', this.cart);
      } catch (e) {
        console.error('Cart error:', e);
        this.cart = [];
        this.updateCartSummary();
      }
    },
    
    updateCartSummary() {
      this.cartCount = this.cart?.reduce((sum, item) => sum + (item?.quantity || 0), 0) || 0;
      this.cartTotal = this.cart?.reduce((sum, item) => sum + ((item?.price || 0) * (item?.quantity || 0)), 0) || 0;
      localStorage.setItem('cart', JSON.stringify(this.cart || []));
      console.log('Cart updated:', this.cartCount, 'items, total:', this.cartTotal);
    },
    
    formatRupiah(value) {
      if (!value && value !== 0) return 'Rp 0';
      return 'Rp ' + value.toLocaleString('id-ID');
    },
    
    toggleCartDrawer() {
      this.cartDrawerOpen = !this.cartDrawerOpen;
      console.log('Drawer toggled:', this.cartDrawerOpen);
    },
    
    /**
     * UPDATE CART QUANTITY - Jika quantity 0, item otomatis dihapus
     * @param {number} index - Index item di array cart
     * @param {number} newQuantity - Quantity baru
     */
    updateCartQuantity(index, newQuantity) {
      // Validasi input
      if (newQuantity < 0) return; // Quantity tidak boleh negatif
      
      if (newQuantity === 0) {
        // Jika quantity = 0, HAPUS ITEM DARI KERANJANG
        const itemName = this.cart[index].name;
        this.cart.splice(index, 1);
        this.showNotification(`🛒 ${itemName} dihapus dari keranjang`);
      } else {
        // Update quantity
        this.cart[index].quantity = newQuantity;
      }
      
      // Update summary setelah perubahan
      this.updateCartSummary();
    },
    
    /**
     * TAMBAH KE KERANJANG (dari card produk)
     */
    addToCart(id, name, price, image) {
      if (!id || !price) {
        console.error('Invalid product');
        return;
      }
      
      const existing = this.cart?.find(item => item.id === id);
      
      if (existing) {
        existing.quantity = (existing.quantity || 0) + 1;
        this.showNotification(`✅ ${name} +1 (total: ${existing.quantity})`);
      } else {
        this.cart.push({
          id, name, price, image,
          quantity: 1
        });
        this.showNotification(`✅ ${name} ditambahkan ke keranjang!`);
      }
      
      this.updateCartSummary();
      this.cartDrawerOpen = true;
    },
    
    /**
     * TAMBAH KE KERANJANG (dari modal)
     */
    addToCartFromModal() {
      if (!this.selectedProduct || !this.selectedProduct.id) {
        console.error('No product selected');
        return;
      }
      
      const existing = this.cart?.find(item => item.id === this.selectedProduct.id);
      const productName = this.selectedProduct.name;
      
      if (existing) {
        existing.quantity += this.quantity;
        this.showNotification(`✅ ${productName} +${this.quantity} (total: ${existing.quantity})`);
      } else {
        this.cart.push({
          id: this.selectedProduct.id,
          name: productName,
          price: this.selectedProduct.price,
          image: this.selectedProduct.image,
          quantity: this.quantity
        });
        this.showNotification(`✅ ${productName} (${this.quantity} item) ditambahkan!`);
      }
      
      this.updateCartSummary();
      this.closeModal();
      this.cartDrawerOpen = true;
    },
    
    /**
     * HAPUS ITEM SECARA LANGSUNG (tombol hapus)
     * @param {number} index - Index item di array cart
     */
    removeItem(index) {
      const itemName = this.cart[index].name;
      this.cart.splice(index, 1);
      this.showNotification(`🗑️ ${itemName} dihapus dari keranjang`);
      this.updateCartSummary();
    },
    
    /**
     * KOSONGKAN KERANJANG
     */
    clearCart() {
      if (this.cart.length === 0) return;
      
      this.cart = [];
      this.updateCartSummary();
      this.showNotification('🔄 Keranjang dikosongkan');
      this.cartDrawerOpen = false;
    },
    
    showProductModal(productId) {
      console.log('Showing modal for product:', productId);
      // Data produk akan diisi dari server
      // Fungsi ini akan di-override di blade
    },
    
    closeModal() {
      this.modalOpen = false;
      this.quantity = 1;
    },
    
    showNotification(message) {
      if (!message) return;
      
      const notif = document.createElement('div');
      notif.className = 'fixed top-4 right-4 bg-[#6B8E23] text-white px-6 py-3 rounded-full font-fredoka z-[100000] shadow-lg animate-bounce flex items-center gap-2';
      notif.innerHTML = message;
      document.body.appendChild(notif);
      
      setTimeout(() => notif.remove(), 2000);
    }
  }
}

Alpine.start();