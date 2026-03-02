@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Review Saya</h1>
    
    @if($feedbacks->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4">
            <p>Anda belum memiliki review. Silakan order terlebih dahulu!</p>
        </div>
    @else
        <div class="grid gap-6">
            @foreach($feedbacks as $fb)
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-bold text-lg">Order: {{ $fb->kode_pesanan }}</h3>
                            <p class="text-sm text-gray-500">{{ $fb->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-yellow-500">
                            {{ str_repeat('⭐', $fb->rating) }}
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($fb->tags ?? [] as $tag)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <p class="text-gray-700 italic">"{{ $fb->review }}"</p>
                    </div>
                    
                    <a href="{{ route('review.show', $fb->id) }}" class="text-blue-600 hover:text-blue-800">
                        Lihat Detail →
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection