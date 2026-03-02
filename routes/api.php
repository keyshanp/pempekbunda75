<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FeedbackController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ============================================
// 🔥 FEEDBACK API - TANPA PREFIX 'feedback' DI DALAMNYA
// ============================================

// Route POST untuk menyimpan feedback (dari invoice)
Route::post('/feedback', [FeedbackController::class, 'store'])->name('api.feedback.store');

// Route GET untuk mengambil semua feedback
Route::get('/feedback', [FeedbackController::class, 'index'])->name('api.feedback.index');

// ============================================
// 📊 STATS API - UNTUK CHART DAN ANALYTICS
// ============================================

// Statistik per bulan
Route::get('/stats/monthly', [FeedbackController::class, 'monthlyStats'])->name('api.stats.monthly');

// Statistik per tag
Route::get('/stats/tags', [FeedbackController::class, 'tagStats'])->name('api.stats.tags');

// Statistik per rating
Route::get('/stats/ratings', [FeedbackController::class, 'ratingStats'])->name('api.stats.ratings');