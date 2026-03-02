@php
    $produk = $getRecord();
    $gambarPath = $produk->gambar;
    
    if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
        $gambarUrl = Storage::disk('public')->url($gambarPath);
    } else {
        $gambarUrl = 'https://placehold.co/50x50/e0e0e0/666?text=No+Img';
    }
@endphp

<img src="{{ $gambarUrl }}" 
     alt="Gambar Produk" 
     width="50" 
     height="50" 
     style="object-fit: cover; border-radius: 4px;"
     onerror="this.src='https://placehold.co/50x50/e0e0e0/666?text=Error'">