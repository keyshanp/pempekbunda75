@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('my-reviews') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Review</a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-200">
        <h1 class="text-3xl font-bold mb-6">Detail Review</h1>
        
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="font-semibold text-gray-600 mb-2">Informasi Order</h3>
                <p><span class="font-medium">Order Code:</span> {{ $feedback->kode_pesanan }}</p>
                <p><span class="font-medium">Tanggal:</span> {{ $feedback->created_at->format('d M Y H:i') }}</p>
                @if($feedback->order)
                    <p><span class="font-medium">Status Order:</span> 
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                            {{ $feedback->order->status_pesanan }}
                        </span>
                    </p>
                @endif
            </div>
            
            <div>
                <h3 class="font-semibold text-gray-600 mb-2">Rating</h3>
                <div class="text-2xl text-yellow-500">
                    {{ str_repeat('⭐', $feedback->rating) }}
                    <span class="text-gray-500 text-lg ml-2">({{ $feedback->rating }}/5)</span>
                </div>
            </div>
        </div>
        
        <div class="mb-8">
            <h3 class="font-semibold text-gray-600 mb-2">Tags yang Dipilih</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($feedback->tags ?? [] as $tag)
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        
        <div>
            <h3 class="font-semibold text-gray-600 mb-2">Review</h3>
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <p class="text-gray-700 italic leading-relaxed">"{{ $feedback->review }}"</p>
            </div>
        </div>
        
        @if($feedback->order && $feedback->order->items)
        <div class="mt-8 pt-8 border-t border-gray-200">
            <h3 class="font-semibold text-gray-600 mb-4">Detail Pesanan</h3>
            <div class="space-y-3">
                @foreach(json_decode($feedback->order->items, true) as $item)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <span class="font-medium">{{ $item['name'] }}</span>
                            <span class="text-sm text-gray-500 ml-2">x{{ $item['quantity'] }}</span>
                        </div>
                        <span class="font-bold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 text-right">
                <p class="text-lg font-bold">Total: Rp {{ number_format($feedback->order->total, 0, ',', '.') }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection