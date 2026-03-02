<x-filament-panels::page>
    @if($record)
    <div class="space-y-6">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">📋 Informasi Customer</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm font-medium text-gray-500">Nama Customer</p>
                    <p class="mt-1 text-lg font-bold text-gray-900">{{ $record->user_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Email</p>
                    <p class="mt-1 text-gray-900">{{ $record->user_email ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Order Code</p>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $record->kode_pesanan ?? '-' }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Rating</p>
                    <p class="mt-1 text-lg text-yellow-500">
                        @php $rating = (int)($record->rating ?? 0); @endphp
                        {{ str_repeat('⭐', $rating) }} ({{ $rating }}/5)
                    </p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Dikirim Pada</p>
                    <p class="mt-1 text-gray-900">{{ $record->created_at ? $record->created_at->format('d M Y H:i') : '-' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Feedback ID</p>
                    <p class="mt-1 text-gray-900">#{{ $record->id ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Tags Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">🏷️ Button yang Dipencet</h2>
                <p class="text-sm text-gray-500">Tag yang dipilih customer</p>
            </div>
            <div class="p-6">
                @php
                    $tags = $record->tags;
                    if (is_string($tags)) {
                        $tags = json_decode($tags, true) ?? [];
                    }
                @endphp
                
                @if(empty($tags) || !is_array($tags) || count($tags) == 0)
                    <p class="text-gray-400 italic">Tidak ada tag yang dipilih</p>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium border border-green-200">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Review Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">💬 Review Customer</h2>
                <p class="text-sm text-gray-500">Kata-kata yang ditulis customer</p>
            </div>
            <div class="p-6">
                @if(empty($record->review))
                    <p class="text-gray-400 italic">Customer tidak menulis review</p>
                @else
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <p class="text-lg italic text-gray-700 leading-relaxed">"{{ $record->review }}"</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Order Details Section -->
        @if($record->order)
        @php
            $order = $record->order;
            $items = is_string($order->items) ? json_decode($order->items, true) : $order->items;
            $payment = is_string($order->payment) ? json_decode($order->payment, true) : $order->payment;
            $delivery = is_string($order->delivery) ? json_decode($order->delivery, true) : $order->delivery;
        @endphp
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">📦 Detail Order</h2>
                <p class="text-sm text-gray-500">Informasi pesanan terkait</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Order Code</p>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $order->kode_pesanan ?? '-' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status Order</p>
                        @php
                            $status = $order->status_pesanan ?? '';
                            $statusColor = match($status) {
                                'completed', 'selesai', 'delivered' => 'bg-green-100 text-green-800',
                                'processing', 'processed', 'diproses' => 'bg-yellow-100 text-yellow-800',
                                'shipped', 'dikirim' => 'bg-blue-100 text-blue-800',
                                'pending' => 'bg-gray-100 text-gray-800',
                                'cancelled', 'dibatalkan' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <p class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucfirst($status ?: 'Unknown') }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Subtotal</p>
                        <p class="mt-1 text-gray-900">Rp {{ number_format($order->subtotal ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Ongkos Kirim</p>
                        <p class="mt-1 text-gray-900">
                            @if(($delivery['shipping_cost'] ?? 0) == 0)
                                <span class="text-green-600 font-semibold">GRATIS</span>
                            @else
                                Rp {{ number_format($delivery['shipping_cost'] ?? 0, 0, ',', '.') }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total</p>
                        <p class="mt-1 text-lg font-bold text-red-600">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Metode Pembayaran</p>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ strtoupper($payment['metode'] ?? 'QRIS') }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Metode Pengiriman</p>
                        <p class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ ucfirst($delivery['metode'] ?? 'Pickup') }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Items -->
                @if(!empty($items) && is_array($items))
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <h3 class="text-md font-semibold text-gray-900 mb-4">🛒 Items yang Dipesan</h3>
                    <div class="space-y-3">
                        @foreach($items as $index => $item)
                            @php
                                $name = $item['name'] ?? 'Unknown';
                                $qty = $item['quantity'] ?? 0;
                                $price = $item['price'] ?? 0;
                                $total = $qty * $price;
                                $bgColor = $index % 2 == 0 ? 'bg-white' : 'bg-gray-50';
                            @endphp
                            <div class="flex justify-between items-center p-4 {{ $bgColor }} rounded-lg border border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center text-orange-600 font-bold">
                                        {{ substr($name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="font-medium">{{ $name }}</span>
                                        <span class="text-sm text-gray-500 ml-2">x{{ $qty }}</span>
                                    </div>
                                </div>
                                <span class="font-bold text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @else
        <!-- No Order Info -->
        <div class="bg-yellow-50 rounded-xl border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Feedback ini tidak terhubung dengan order manapun. Mungkin merupakan feedback manual atau data test.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-500">Feedback tidak ditemukan.</p>
    </div>
    @endif
</x-filament-panels::page>