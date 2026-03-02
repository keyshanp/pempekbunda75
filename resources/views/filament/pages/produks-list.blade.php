@extends('filament::layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">📦 Daftar Produk</h2>
    
    <div class="mb-4">
        <a href="{{ route('filament.admin.resources.produks.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 focus:bg-primary-700 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
           ➕ Tambah Produk
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($produks as $produk)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $produk->nama_produk }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $produk->stok }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($produk->status)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('filament.admin.resources.produks.edit', $produk) }}" 
                           class="text-indigo-600 hover:text-indigo-900 mr-3">✏️ Edit</a>
                        <form action="{{ route('filament.admin.resources.produks.destroy', $produk) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection