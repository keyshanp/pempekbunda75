<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// 🏠 PUBLIC ROUTES (Tanpa Auth)
// ============================================

Route::get('/', function () {
    try {
        if (class_exists('App\Models\Produk')) {
            // 🔥 URUTKAN PRODUK SESUAI KEBUTUHAN:
            // 1. Tekwan di paling depan
            // 2. Paket A (50rb & 100rb)
            // 3. Paket B (50rb & 100rb) 
            // 4. Paket C (50rb & 100rb)
            $featuredProducts = \App\Models\Produk::where('status', true)
                ->where('stok', '>', 0)
                ->orderByRaw("
                    CASE 
                        WHEN nama_produk = 'Tekwan' THEN 1
                        WHEN nama_produk LIKE 'Paket A%' THEN 2
                        WHEN nama_produk LIKE 'Paket B%' THEN 3
                        WHEN nama_produk LIKE 'Paket C%' THEN 4
                        ELSE 5
                    END
                ")
                ->orderByRaw("
                    CASE 
                        WHEN nama_produk LIKE '%50rb' THEN 1
                        WHEN nama_produk LIKE '%100rb' THEN 2
                        ELSE 3
                    END
                ")
                ->get(); // 🔥 AMBIL SEMUA PRODUK (BUKAN TAKE 6)
        } else {
            $featuredProducts = collect();
        }
    } catch (\Exception $e) {
        $featuredProducts = collect();
    }
    
    // Ambil 5 feedback terbaru dengan rating tertinggi
    $topFeedbacks = collect();
    try {
        if (class_exists('App\Models\Feedback')) {
            $topFeedbacks = \App\Models\Feedback::orderBy('rating', 'desc')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }
    } catch (\Exception $e) {
        $topFeedbacks = collect();
    }

    return view('welcome', [
        'title'            => 'PempekBunda 75 - Home',
        'featuredProducts' => $featuredProducts,
        'topFeedbacks'     => $topFeedbacks,
    ]);
})->name('home');

// ============================================
// 🔐 Route untuk Filament Logout
// ============================================

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect('/admin/login');
})->name('filament.admin.auth.logout');

// ============================================
// 🧪 TEST & DEBUG ROUTES
// ============================================




// 🔥 TEST FEEDBACK ROUTE
Route::get('/test-feedback', function() {
    echo "<h1>Feedback Test</h1>";
    
    try {
        $feedbacks = \App\Models\Feedback::with('user')->latest()->take(10)->get();
        if ($feedbacks->count() > 0) {
            echo "<p style='color:green'>✅ Found " . $feedbacks->count() . " feedback(s)</p>";
            foreach ($feedbacks as $fb) {
                echo "<div style='border:1px solid #ccc; margin:10px; padding:10px; border-radius:5px;'>";
                echo "<p><strong>Order:</strong> {$fb->kode_pesanan}</p>";
                echo "<p><strong>Customer:</strong> {$fb->user_name} ({$fb->user_email})</p>";
                echo "<p><strong>Rating:</strong> " . str_repeat('⭐', $fb->rating) . " ({$fb->rating}/5)</p>";
                echo "<p><strong>Tags:</strong> " . implode(', ', $fb->tags ?? []) . "</p>";
                echo "<p><strong>Review:</strong> {$fb->review}</p>";
                echo "<p><strong>Date:</strong> {$fb->created_at->format('d M Y H:i')}</p>";
                echo "<p><a href='/admin/feedback/{$fb->id}'>Lihat Detail</a></p>";
                echo "</div>";
            }
        } else {
            echo "<p style='color:orange'>⚠️ No feedback found. Submit from invoice first!</p>";
        }
    } catch (\Exception $e) {
        echo "<p style='color:red'>❌ Error: " . $e->getMessage() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
    
    echo "<hr><a href='/admin/feedback' target='_blank'>Go to Admin Feedback</a>";
});

// ============================================
// 🔐 AUTH ROUTES (User Authentication) - FIX
// ============================================

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::post('/register', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'consent' => 'required|accepted',
        ], [
            'consent.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'consent.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);
        
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);
        
        Auth::login($user);
        
        // 🔥 SETELAH REGISTER, LANGSUNG KE CART
        return redirect()->route('order.cart')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    });
    
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // 🔥 CEK APAKAH ADA PARAMETER REDIRECT
            if ($request->has('redirect')) {
                return redirect($request->redirect);
            }
            
            // 🔥 CEK APAKAH USER ADALAH ADMIN
            if (isset($user->is_admin) && $user->is_admin) {
                return redirect('/admin');
            }
            
            // 🔥 JIKA USER BIASA, REDIRECT KE CART
            return redirect()->route('order.cart')
                ->with('success', 'Login berhasil! Selamat datang kembali.');
        }
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    });
});

// ============================================
// 👤 PROTECTED ROUTES (User Sudah Login)
// ============================================

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'user' => Auth::user(),
            'title' => 'Dashboard User'
        ]);
    })->name('dashboard');
    
    Route::get('/profile', function () {
        return view('profile', [
            'user' => Auth::user()
        ]);
    })->name('profile');
    
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')
            ->with('success', 'Anda telah logout.');
    })->name('logout');
    
    // 🔥 HISTORI TRANSAKSI USER
    Route::get('/transaksi/history', function () {
        $transaksis = \App\Models\Transaksi::whereHas('order', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('order')
            ->latest()
            ->paginate(10);
            
        return view('transaksi.history', [
            'transaksis' => $transaksis,
            'title' => 'Histori Transaksi - PempekBunda 75'
        ]);
    })->name('transaksi.history');
    
    // 🔥 CUSTOMER REVIEWS - Lihat review mereka sendiri
    Route::get('/my-reviews', function () {
        $feedbacks = \App\Models\Feedback::where('user_id', auth()->id())
            ->with('order')
            ->latest()
            ->get();
            
        return view('feedback.my-reviews', [
            'feedbacks' => $feedbacks,
            'title' => 'Review Saya - PempekBunda 75'
        ]);
    })->name('my-reviews');
    
    // 🔥 LIHAT DETAIL REVIEW CUSTOMER
    Route::get('/review/{id}', function ($id) {
        $feedback = \App\Models\Feedback::with('order')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        return view('feedback.show', [
            'feedback' => $feedback,
            'title' => 'Detail Review - PempekBunda 75'
        ]);
    })->name('review.show');
});

// ============================================
// 🛍️ PUBLIC PRODUCT ROUTES (Untuk Customer)
// ============================================

Route::prefix('produk')->name('produk.')->group(function () {
    Route::get('/', function () {
        try {
            $produks = \App\Models\Produk::where('status', true)
                ->orderBy('created_at', 'desc')
                ->get();
                
            return view('produk.index', [
                'produks' => $produks,
                'title' => 'Daftar Produk - PempekBunda 75'
            ]);
        } catch (\Exception $e) {
            return view('produk.index', [
                'produks' => collect(),
                'title' => 'Daftar Produk',
                'error' => $e->getMessage()
            ]);
        }
    })->name('index');
    
    Route::get('/{id}', function ($id) {
        try {
            $produk = \App\Models\Produk::findOrFail($id);
            
            if (!$produk->status) {
                abort(404, 'Produk tidak tersedia');
            }
            
            return view('produk.show', [
                'produk' => $produk,
                'title' => $produk->nama_produk . ' - PempekBunda 75'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Produk tidak ditemukan');
        } catch (\Exception $e) {
            abort(500, 'Terjadi kesalahan: ' . $e->getMessage());
        }
    })->name('show');
});

// ============================================
// 📞 CONTACT & ABOUT ROUTES
// ============================================

Route::get('/tentang-kami', function () {
    return view('about', ['title' => 'Tentang Kami - PempekBunda 75']);
})->name('about');

Route::get('/kontak', function () {
    return view('contact', ['title' => 'Kontak - PempekBunda 75']);
})->name('contact');

// ============================================
// 🌟 PUBLIC REVIEWS PAGE
// ============================================

Route::get('/reviews', function () {
    $feedbacks = \App\Models\Feedback::with('user')
        ->latest()
        ->paginate(10);
    
    $totalReviews = \App\Models\Feedback::count();
    $averageRating = \App\Models\Feedback::avg('rating') ?? 0;
    
    // Hitung distribusi rating
    $ratingCounts = [];
    for ($i = 1; $i <= 5; $i++) {
        $ratingCounts[$i] = \App\Models\Feedback::where('rating', $i)->count();
    }
    
    return view('feedback.reviews', [
        'feedbacks' => $feedbacks,
        'totalReviews' => $totalReviews,
        'averageRating' => $averageRating,
        'ratingCounts' => $ratingCounts,
        'title' => 'Review Pelanggan - PempekBunda 75'
    ]);
})->name('reviews');

// ============================================
// 📄 LEGAL PAGES
// ============================================

Route::get('/syarat-dan-ketentuan', function () {
    return view('legal.terms', ['title' => 'Syarat & Ketentuan']);
})->name('terms');

Route::get('/kebijakan-privasi', function () {
    return view('legal.privacy', ['title' => 'Kebijakan Privasi']);
})->name('privacy');

// ============================================
// 🛠️ UTILITY ROUTES
// ============================================

Route::get('/create-admin', function() {
    if (!app()->environment('local')) {
        abort(403);
    }
    
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'admin@pempekbunda75.com'],
        [
            'name' => 'Admin Pempek',
            'password' => Hash::make('Admin123!'),
            'is_admin' => true,
        ]
    );
    
    return "Admin user created/updated!<br>" .
           "Email: admin@pempekbunda75.com<br>" .
           "Password: Admin123!<br>" .
           "<a href='/admin'>Go to Admin</a>";
});

// ============================================
// 🗑️ ADMIN PRODUCT DELETE ROUTES
// ============================================

Route::prefix('admin/filament/produk')->name('filament.produk.')->group(function () {
    Route::get('/confirm-delete/{id}', function($id) {
        $produk = \App\Models\Produk::find($id);
        
        if (!$produk) {
            return redirect('/admin/produks')->with('error', 'Produk tidak ditemukan');
        }
        
        return view('produk.delete-confirm', [
            'produk' => $produk,
            'title' => 'Konfirmasi Hapus Produk - ' . $produk->nama_produk,
            'is_filament' => true
        ]);
    })->name('confirm-delete');
    
    Route::delete('/delete/{id}', function($id) {
        $produk = \App\Models\Produk::findOrFail($id);
        $nama = $produk->nama_produk;
        
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }
        
        $produk->delete();
        
        return redirect('/admin/produks')
            ->with('success', "Produk '$nama' berhasil dihapus");
    })->name('execute-delete');
    
    Route::get('/bulk-confirm-delete/{ids}', function($ids) {
        $idArray = explode(',', $ids);
        $produks = \App\Models\Produk::whereIn('id', $idArray)->get();
        
        if ($produks->isEmpty()) {
            return redirect('/admin/produks')->with('error', 'Tidak ada produk yang dipilih');
        }
        
        return view('produk.bulk-delete-confirm', [
            'produks' => $produks,
            'ids' => $ids,
            'title' => 'Konfirmasi Hapus Massal Produk',
            'is_filament' => true
        ]);
    })->name('bulk-confirm-delete');
    
    Route::delete('/bulk-delete', function(Request $request) {
        $ids = explode(',', $request->ids);
        $deletedCount = 0;
        
        foreach ($ids as $id) {
            $produk = \App\Models\Produk::find($id);
            
            if ($produk) {
                if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                    Storage::disk('public')->delete($produk->gambar);
                }
                
                $produk->delete();
                $deletedCount++;
            }
        }
        
        return redirect('/admin/produks')
            ->with('success', "{$deletedCount} produk berhasil dihapus");
    })->name('bulk-execute-delete');
});

// ============================================
// 👑 ADMIN ORDER STATUS UPDATE (CUSTOM PAGE)
// ============================================
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders/{id}/status', [App\Http\Controllers\OrderController::class, 'editStatus'])->name('orders.edit-status');
    Route::put('/orders/{id}/status', [App\Http\Controllers\OrderController::class, 'updateStatus'])->name('orders.update-status');
});

// 🔥 ADMIN FEEDBACK ROUTES (Untuk preview langsung)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/feedback/{id}', function ($id) {
        $feedback = \App\Models\Feedback::with('user', 'order')->findOrFail($id);
        return view('feedback.admin-show', [
            'feedback' => $feedback,
            'title' => 'Detail Feedback - Admin'
        ]);
    })->name('feedback.show');
});

// ============================================
// 🛒 ORDER SYSTEM ROUTES - LENGKAP DENGAN PAYMENT & INVOICE
// ============================================

Route::prefix('order')->name('order.')->group(function () {
    // Order page - Menggunakan OrderController
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/process', [OrderController::class, 'process'])->name('order.process');
    Route::get('/invoice/{invoice}', [OrderController::class, 'invoice'])->name('invoice');
    
    // 🔥 ROUTE MY ORDERS (YANG DIMINTA)
    Route::middleware('auth')->get('/my-orders', function () {
        // Ambil orders dari database berdasarkan user yang login
        $orders = \App\Models\Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('order.my-orders', [
            'orders' => $orders,
            'title' => 'Pesanan Saya - PempekBunda 75'
        ]);
    })->name('my-orders');
    
    // ROUTE SYNC CART
    Route::post('/sync-cart', function (Request $request) {
        try {
            $cart = $request->input('cart', []);
            if (!is_array($cart)) {
                return response()->json(['success' => false, 'error' => 'Invalid cart data'], 400);
            }
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    })->name('sync-cart');
    
    // Cart system
    Route::get('/cart', function () {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return view('order.cart', [
                'cart' => [],
                'subtotal' => 0,
                'shipping' => 0,
                'total' => 0,
                'title' => 'Keranjang Belanja - PempekBunda 75'
            ]);
        }
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shipping = 0;
        $total = $subtotal + $shipping;
        
        return view('order.cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'title' => 'Keranjang Belanja - PempekBunda 75'
        ]);
    })->name('cart');
    
    // ROUTE PAYMENT
    Route::get('/payment', function () {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu');
        }
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('order.cart')
                ->with('error', 'Keranjang belanja masih kosong');
        }
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        return view('order.payment', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'title' => 'Pembayaran - PempekBunda 75'
        ]);
    })->middleware('auth')->name('payment');
    
    // ROUTE HITUNG ONGKIR
    Route::post('/calculate-shipping', function (Request $request) {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'shipping_method' => 'required|in:instant,sameday'
        ]);
        
        $storeLat = -2.9911503;
        $storeLng = 104.7532176;
        
        $customerLat = $request->lat;
        $customerLng = $request->lng;
        
        $distance = calculateDistance($storeLat, $storeLng, $customerLat, $customerLng);
        
        $rate = $request->shipping_method === 'instant' ? 2500 : 1200;
        $shippingCost = ceil($distance * $rate);
        
        if ($shippingCost < 10000) {
            $shippingCost = 10000;
        }
        
        return response()->json([
            'success' => true,
            'distance' => round($distance, 2),
            'shipping_cost' => $shippingCost,
            'formatted_distance' => round($distance, 2) . ' km',
            'formatted_cost' => 'Rp ' . number_format($shippingCost, 0, ',', '.')
        ]);
    })->name('calculate-shipping');
    
    // ROUTE PAYMENT PROCESS - SIMPAN DATA KE SESSION
    Route::post('/payment/process', function (Request $request) {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return response()->json(['success' => false, 'error' => 'Keranjang kosong'], 400);
        }
        
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'alamat' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'jarak' => 'required|numeric',
            'shipping_method' => 'required|in:pickup,instant,sameday',
            'shipping_cost' => 'required|numeric',
            'metode_pembayaran' => 'required|in:qris',
            'nama_pengirim' => 'required|string'
        ]);
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shippingCost = $request->shipping_method === 'pickup' ? 0 : (float) $request->shipping_cost;
        $total = $subtotal + $shippingCost;
        
        // Simpan data ke session
        session()->put('payment_data', [
            'customer' => [
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'lat' => (float) $request->lat,
                'lng' => (float) $request->lng,
                'jarak' => (float) $request->jarak
            ],
            'delivery' => [
                'metode' => $request->shipping_method,
                'shipping_cost' => (float) $shippingCost
            ],
            'payment' => [
                'metode' => $request->metode_pembayaran,
                'nama_pengirim' => $request->nama_pengirim
            ],
            'subtotal' => (float) $subtotal,
            'total' => (float) $total
        ]);
        
        return response()->json(['success' => true]);
    })->name('payment.process');
    
    // ===== API ENDPOINTS UNTUK CART =====
    Route::post('/add-to-cart', function (Request $request) {
        $produk = \App\Models\Produk::find($request->product_id);
        
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }
        
        if ($produk->stok < $request->quantity) {
            return response()->json(['error' => 'Stok tidak cukup'], 400);
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$produk->id])) {
            $cart[$produk->id]['quantity'] += $request->quantity;
        } else {
            $cart[$produk->id] = [
                'id' => $produk->id,
                'name' => $produk->nama_produk,
                'price' => $produk->harga,
                'quantity' => $request->quantity,
                'image' => $produk->gambar ? asset('storage/' . $produk->gambar) : asset('assets/images/pempekbunda5.png'),
                'stok' => $produk->stok,
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'message' => $produk->nama_produk . ' ditambahkan'
        ]);
    })->name('add-to-cart');
    
    Route::post('/update-cart', function (Request $request) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return response()->json(['success' => true]);
    })->name('update-cart');
    
    Route::post('/remove-from-cart', function (Request $request) {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }
        
        return response()->json(['success' => true]);
    })->name('remove-from-cart');
    
    Route::get('/cart-count', function () {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        
        return response()->json(['count' => $count]);
    })->name('cart-count');
});

// Fungsi hitung jarak Haversine
if (!function_exists('calculateDistance')) {
    function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371;
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        
        $c = 2 * asin(sqrt($a));
        $distance = $earthRadius * $c;
        
        return $distance;
    }
}

// ============================================
// 🚨 ERROR PAGES
// ============================================

Route::get('/coming-soon', function () {
    return view('errors.coming-soon', [
        'title' => 'Halaman Sedang Dalam Proses - PempekBunda 75'
    ]);
})->name('coming-soon');

Route::fallback(function () {
    return response()->view('errors.404', [
        'title' => 'Halaman Tidak Ditemukan'
    ], 404);
});
