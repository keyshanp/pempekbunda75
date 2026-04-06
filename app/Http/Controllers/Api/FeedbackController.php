<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedback.
     */
    public function index()
    {
        try {
            $feedback = Feedback::orderBy('created_at', 'desc')->get();
            
            return response()->json($feedback);
        } catch (\Exception $e) {
            Log::error('Error fetching feedback: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch feedback'], 500);
        }
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        // Log semua request untuk debugging
        Log::info('📝 Feedback received:', $request->all());

        // Validasi data - SESUAIKAN DENGAN YANG DIKIRIM INVOICE
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|between:1,5',
            'tags' => 'nullable|array',
            'review' => 'nullable|string',
            'comment' => 'nullable|string',
            'order_code' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'error' => 'Validation failed', 
                'details' => $validator->errors()
            ], 422);
        }

        try {
            // Handle tags - invoice mengirim 'selectedTags' sebagai 'tags'
            $tags = $request->tags ?? [];
            
            // Handle review text - invoice mengirim 'reviewText' sebagai 'review'
            $reviewText = $request->review ?? $request->comment ?? '';
            
            // Generate order code jika tidak ada
            $orderCode = $request->order_code ?? 'INV-' . time();
            
            // Cari user_id berdasarkan email
            $userId = null;
            if ($request->email) {
                $user = \App\Models\User::where('email', $request->email)->first();
                $userId = $user?->id;
            }

            $data = [
                'kode_pesanan' => $orderCode,
                'user_id'      => $userId,
                'user_name'    => $request->name,
                'user_email'   => $request->email,
                'rating'       => $request->rating,
                'tags'         => $tags,
                'review'       => $reviewText,
            ];

            // Cek apakah sudah ada feedback untuk order ini
            $existingFeedback = Feedback::where('kode_pesanan', $orderCode)->first();
            
            if ($existingFeedback) {
                $existingFeedback->update($data);
                $feedback = $existingFeedback;
                $message = 'Feedback updated successfully';
                Log::info('✅ Feedback updated:', $feedback->toArray());
            } else {
                $feedback = Feedback::create($data);
                $message = 'Feedback created successfully';
                Log::info('✅ Feedback created:', $feedback->toArray());
            }

            return response()->json([
                'success' => true,
                'id' => $feedback->id,
                'message' => $message,
                'data' => $feedback
            ], 201);

        } catch (\Exception $e) {
            Log::error('❌ Error saving feedback: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to save feedback',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}