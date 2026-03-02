@extends('layouts.filament-admin')

@section('title', 'Daftar Pesanan - Admin Pempek Bunda 75')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-slate-800">Daftar Pesanan</h2>
    <button onclick="window.location.href='{{ url('/admin/orders/create') }}'" class="filament-btn filament-btn-primary flex items-center gap-2">
        <i class="fas fa-plus"></i>
        Tambah Pesanan Manual
    </button>
</div>

<!-- Filters -->
<div class="flex flex-col gap-6">
    <div class="flex justify-center">
        <div class="bg-white p-1 rounded-xl border border-slate-100 flex gap-1 shadow-sm flex-wrap">
            <button onclick="filterOrders('all')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all bg-[#C06044] text-white shadow-md" data-filter="all">
                Semua
            </button>
            <button onclick="filterOrders('pending')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-slate-400 hover:bg-slate-50" data-filter="pending">
                <i class="fas fa-clock"></i>
                Menunggu
            </button>
            <button onclick="filterOrders('paid')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-slate-400 hover:bg-slate-50" data-filter="paid">
                <i class="fas fa-check-circle"></i>
                Dibayar
            </button>
            <button onclick="filterOrders('processed')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-slate-400 hover:bg-slate-50" data-filter="processed">
                <i class="fas fa-sync-alt"></i>
                Diproses
            </button>
            <button onclick="filterOrders('shipped')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-slate-400 hover:bg-slate-50" data-filter="shipped">
                <i class="fas fa-truck"></i>
                Dikirim
            </button>
            <button onclick="filterOrders('completed')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-slate-400 hover:bg-slate-50" data-filter="completed">
                <i class="fas fa-check"></i>
                Selesai
            </button>
            <button onclick="filterOrders('cancelled')" class="filter-btn flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all text-slate-400 hover:bg-slate-50" data-filter="cancelled">
                <i class="fas fa-times-circle"></i>
                Dibatalkan
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden filament-table">
        <!-- Table Header Actions -->
        <div class="p-4 border-b border-slate-50 flex items-center justify-between gap-4 flex-wrap">
            <div class="relative flex-1 max-w-md">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="Cari ID Pesanan atau Nama Customer..."
                    class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-lg text-sm focus:ring-2 focus:ring-[#C06044]/20 transition-all filament-input"
                    onkeyup="searchOrders()"
                >
            </div>
            <div class="flex items-center gap-2">
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors relative">
                    <i class="fas fa-filter"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-[#C06044] rounded-full border-2 border-white"></span>
                </button>
                <button class="p-2 text-slate-400 hover:bg-slate-50 rounded-lg transition-colors">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="ordersTable">
                <thead>
                    <tr class="bg-slate-50/50 text-[11px] uppercase tracking-wider text-slate-400 font-bold">
                        <th class="px-6 py-4 w-12">
                            <input type="checkbox" class="rounded border-slate-300 text-[#C06044] focus:ring-[#C06044]" id="selectAll">
                        </th>
                        <th class="px-6 py-4">ID Pesanan</th>
                        <th class="px-6 py-4">Nama Customer</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4 text-center">Items</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Pembayaran</th>
                        <th class="px-6 py-4">Pengiriman</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="ordersTableBody">
                    @forelse($orders as $order)
                        @php
                            $statusColors = [
                                'pending' => 'bg-orange-100 text-orange-600',
                                'paid' => 'bg-blue-100 text-blue-600',
                                'processed' => 'bg-purple-100 text-purple-600',
                                'shipped' => 'bg-indigo-100 text-indigo-600',
                                'completed' => 'bg-green-100 text-green-600',
                                'cancelled' => 'bg-red-100 text-red-600'
                            ];

                            $statusLabels = [
                                'pending' => 'Menunggu',
                                'paid' => 'Dibayar',
                                'processed' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan'
                            ];
                            
                            $customer = is_string($order->customer) ? json_decode($order->customer, true) : (is_array($order->customer) ? $order->customer : []);
                            $delivery = is_string($order->delivery) ? json_decode($order->delivery, true) : (is_array($order->delivery) ? $order->delivery : []);
                            $items = is_string($order->items) ? json_decode($order->items, true) : (is_array($order->items) ? $order->items : []);
                            $itemsCount = count($items);
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-colors group order-row" data-status="{{ $order->status_pesanan }}" data-id="{{ $order->kode_pesanan }}" data-name="{{ $customer['nama'] ?? '' }}">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="row-checkbox rounded border-slate-300 text-[#C06044] focus:ring-[#C06044]">
                            </td>
                            <td class="px-6 py-4 font-bold text-[#C06044] text-sm">{{ $order->kode_pesanan }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-slate-700">{{ $customer['nama'] ?? '-' }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $customer['telepon'] ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 max-w-[200px]">
                                <p class="text-xs text-slate-500 truncate" title="{{ $customer['alamat'] ?? '-' }}">
                                    {{ $customer['alamat'] ?? '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 bg-slate-100 text-slate-500 rounded text-[10px] font-bold">
                                    {{ $itemsCount }} item
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-[#10B981]">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-badge {{ $statusColors[$order->status_pesanan] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $statusLabels[$order->status_pesanan] ?? ucfirst($order->status_pesanan) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold {{ ($order->status_pembayaran ?? 'belum_bayar') == 'sudah_bayar' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                    {{ ($order->status_pembayaran ?? 'belum_bayar') == 'sudah_bayar' ? 'Sudah Bayar' : 'Belum Bayar' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-orange-50 text-orange-600 rounded text-[10px] font-bold">
                                    {{ $delivery['metode'] ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[11px] text-slate-500">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('order.invoice', ['invoice' => $order->kode_pesanan]) }}" target="_blank" 
                                       class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-md transition-colors flex items-center gap-1 text-[10px] font-bold">
                                        <i class="fas fa-eye"></i>
                                        Detail
                                    </a>
                                    <button onclick="openStatusModal('{{ $order->kode_pesanan }}', '{{ $customer['nama'] ?? '' }}', '{{ $order->status_pesanan }}')" 
                                            class="p-1.5 text-orange-500 hover:bg-orange-50 rounded-md transition-colors flex items-center gap-1 text-[10px] font-bold">
                                        <i class="fas fa-sync-alt"></i>
                                        Update
                                    </button>
                                    <a href="https://wa.me/{{ $customer['telepon'] ?? '' }}" target="_blank" 
                                       class="p-1.5 text-green-500 hover:bg-green-50 rounded-md transition-colors">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center text-slate-400">
                                <i class="fas fa-box-open text-4xl mb-2"></i>
                                <p>Tidak ada pesanan ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="p-4 bg-slate-50/50 border-t border-slate-50 flex items-center justify-between text-xs text-slate-400">
            <p>Showing <span id="showingCount">{{ count($orders) }}</span> result</p>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <span>Per page</span>
                    <select class="bg-white border border-slate-200 rounded px-2 py-1 text-slate-600 focus:ring-0">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STATUS UPDATE MODAL -->
<div id="statusModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeStatusModal()"></div>
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden animate-fade-in-up">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Update Status Pesanan</h3>
            <span id="modalOrderId" class="text-xs font-bold text-[#C06044]"></span>
        </div>
        
        <div class="p-6 space-y-4">
            <p class="text-sm text-slate-500 mb-4">
                Pilih status terbaru untuk pesanan <span id="modalCustomerName" class="font-bold text-slate-700"></span>:
            </p>
            
            <div class="grid grid-cols-1 gap-2">
                @foreach($statusLabels as $statusKey => $statusLabel)
                    @php
                        $statusIcons = [
                            'pending' => 'fa-clock',
                            'paid' => 'fa-credit-card',
                            'processed' => 'fa-sync-alt',
                            'shipped' => 'fa-truck',
                            'completed' => 'fa-check',
                            'cancelled' => 'fa-times-circle'
                        ];
                        
                        $allStatusColors = [
                            'pending' => 'bg-orange-100 text-orange-600',
                            'paid' => 'bg-blue-100 text-blue-600',
                            'processed' => 'bg-purple-100 text-purple-600',
                            'shipped' => 'bg-indigo-100 text-indigo-600',
                            'completed' => 'bg-green-100 text-green-600',
                            'cancelled' => 'bg-red-100 text-red-600'
                        ];
                    @endphp
                    <button
                        onclick="updateOrderStatus('{{ $statusKey }}')"
                        class="status-option flex items-center justify-between p-4 rounded-2xl border-2 transition-all hover:border-slate-200"
                        data-status="{{ $statusKey }}"
                    >
                        <div class="flex items-center gap-3">
                            <div class="p-2 rounded-lg {{ $allStatusColors[$statusKey] ?? 'bg-gray-100 text-gray-600' }}">
                                <i class="fas {{ $statusIcons[$statusKey] ?? 'fa-circle' }}"></i>
                            </div>
                            <span class="font-bold text-slate-700">{{ $statusLabel }}</span>
                        </div>
                        <i class="fas fa-check-circle text-[#C06044] hidden status-check"></i>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="p-6 bg-slate-50 flex gap-3">
            <button onclick="closeStatusModal()" class="flex-1 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                Batal
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // State
    let currentOrderId = '';
    let currentFilter = 'all';
    
    // ==================== FILTER & SEARCH ====================
    function filterOrders(status) {
        currentFilter = status;
        
        // Update active button styling
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-[#C06044]', 'text-white', 'shadow-md');
            btn.classList.add('text-slate-400', 'hover:bg-slate-50');
        });
        
        const activeBtn = document.querySelector(`.filter-btn[data-filter="${status}"]`);
        if (activeBtn) {
            activeBtn.classList.remove('text-slate-400', 'hover:bg-slate-50');
            activeBtn.classList.add('bg-[#C06044]', 'text-white', 'shadow-md');
        }
        
        applyFilters();
    }
    
    function searchOrders() {
        applyFilters();
    }
    
    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.order-row');
        let visibleCount = 0;
        
        rows.forEach(row => {
            const status = row.dataset.status;
            const id = row.dataset.id.toLowerCase();
            const name = row.dataset.name.toLowerCase();
            
            const matchesFilter = currentFilter === 'all' || status === currentFilter;
            const matchesSearch = searchTerm === '' || id.includes(searchTerm) || name.includes(searchTerm);
            
            if (matchesFilter && matchesSearch) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        document.getElementById('showingCount').textContent = visibleCount;
    }
    
    // ==================== STATUS MODAL ====================
    function openStatusModal(orderId, customerName, currentStatus) {
        currentOrderId = orderId;
        document.getElementById('modalOrderId').textContent = orderId;
        document.getElementById('modalCustomerName').textContent = customerName;
        
        // Highlight current status
        document.querySelectorAll('.status-option').forEach(btn => {
            const status = btn.dataset.status;
            const checkIcon = btn.querySelector('.status-check');
            
            if (status === currentStatus) {
                btn.classList.add('border-[#C06044]', 'bg-orange-50');
                btn.classList.remove('border-slate-50', 'hover:border-slate-200');
                checkIcon.classList.remove('hidden');
            } else {
                btn.classList.remove('border-[#C06044]', 'bg-orange-50');
                btn.classList.add('border-slate-50', 'hover:border-slate-200');
                checkIcon.classList.add('hidden');
            }
        });
        
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');
    }
    
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusModal').classList.remove('flex');
    }
    
    // ==================== UPDATE STATUS ====================
    function updateOrderStatus(newStatus) {
        if (!currentOrderId) return;
        
        fetch(`/admin/orders/${currentOrderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update row status
                const row = document.querySelector(`.order-row[data-id="${currentOrderId}"]`);
                if (row) {
                    // Update status cell
                    const statusCell = row.querySelector('td:nth-child(7)');
                    if (statusCell) {
                        const statusColors = @json($statusColors);
                        const statusLabels = @json($statusLabels);
                        
                        statusCell.innerHTML = `<span class="status-badge ${statusColors[newStatus]}">${statusLabels[newStatus]}</span>`;
                    }
                    
                    // Update data-status attribute
                    row.dataset.status = newStatus;
                }
                
                closeStatusModal();
                applyFilters();
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // ==================== SELECT ALL CHECKBOX ====================
    document.getElementById('selectAll')?.addEventListener('change', function(e) {
        document.querySelectorAll('.row-checkbox').forEach(cb => {
            cb.checked = e.target.checked;
        });
    });
    
    // ==================== INIT ====================
    document.addEventListener('DOMContentLoaded', function() {
        // Set active filter
        filterOrders('all');
        
        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('statusModal');
            if (e.target === modal) {
                closeStatusModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeStatusModal();
            }
        });
    });
</script>
@endpush