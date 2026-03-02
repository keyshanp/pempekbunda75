@props([
    'record',
])

<div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
    <div class="flex items-start gap-4">
        <!-- Gambar -->
        <div class="flex-shrink-0">
            @if($record->gambar)
                <img src="{{ asset('storage/' . $record->gambar) }}" 
                     alt="{{ $record->nama_produk }}"
                     class="w-16 h-16 rounded-lg object-cover border border-gray-200">
            @else
                <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>
        
        <!-- Info -->
        <div class="flex-1">
            <h3 class="font-semibold text-gray-900 text-sm">{{ $record->nama_produk }}</h3>
            @if($record->deskripsi)
                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $record->deskripsi }}</p>
            @endif
            
            <div class="flex items-center gap-4 mt-3 text-xs">
                <span class="font-medium text-green-600">Rp {{ number_format($record->harga, 0, ',', '.') }}</span>
                <span class="font-medium {{ $record->stok < 10 ? 'text-red-500' : 'text-gray-700' }}">
                    {{ $record->stok }} pcs
                </span>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $record->status ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $record->status ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="flex-shrink-0">
            <div class="flex items-center gap-1">
                <a href="{{ route('filament.admin.resources.produks.edit', $record->id) }}" 
                   class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                   title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                <a href="{{ route('produk.hapus.manual', $record->id) }}" 
                   onclick="return confirm('Yakin hapus {{ addslashes($record->nama_produk) }}?')"
                   class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                   title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>