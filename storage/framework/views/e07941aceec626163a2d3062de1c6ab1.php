<?php $__env->startSection('title', 'Update Status Pesanan - ' . $order->kode_pesanan); ?>

<?php $__env->startSection('content'); ?>
<div class="p-8">
    <!-- Header dengan judul dan tombol kembali -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Update Status Pesanan</h2>
        <a href="<?php echo e(route('filament.admin.resources.orders.index')); ?>" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Info Order Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-6 bg-gradient-to-r from-orange-50 to-amber-50 border-b border-slate-100">
            <div class="flex flex-wrap items-center gap-6">
                <div>
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">ID Pesanan</span>
                    <p class="text-xl font-bold text-[#C06044] font-mono"><?php echo e($order->kode_pesanan); ?></p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div>
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Customer</span>
                    <p class="text-base font-medium text-slate-800"><?php echo e($order->customer['nama'] ?? '-'); ?></p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div>
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total</span>
                    <p class="text-base font-medium text-slate-800">Rp <?php echo e(number_format($order->total, 0, ',', '.')); ?></p>
                </div>
                <div class="w-px h-8 bg-slate-200"></div>
                <div>
                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Status Saat Ini</span>
                    <?php
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
                    ?>
                    <p class="mt-1">
                        <span class="status-badge <?php echo e($statusColors[$order->status_pesanan] ?? 'bg-gray-100 text-gray-600'); ?>">
                            <?php echo e($statusLabels[$order->status_pesanan] ?? ucfirst($order->status_pesanan)); ?>

                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Update Status -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-gradient-to-r from-slate-50 to-white">
            <h3 class="font-medium text-slate-700">Form Update Status</h3>
        </div>

        <div class="p-6">
            <form method="POST" action="<?php echo e(route('admin.orders.update-status', $order->kode_pesanan)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="space-y-6">
                    <!-- Status Pesanan -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Status Pesanan <span class="text-red-500">*</span>
                        </label>
                        <select name="status_pesanan" required 
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#C06044]/20 focus:border-[#C06044] transition-all">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value); ?>" <?php echo e($order->status_pesanan == $value ? 'selected' : ''); ?>>
                                    <?php echo e($label); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['status_pesanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Catatan Admin -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Catatan Admin
                        </label>
                        <textarea name="catatan_admin" rows="4" 
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#C06044]/20 focus:border-[#C06044] transition-all"
                                  placeholder="Tambahkan catatan internal untuk pesanan ini..."><?php echo e($order->catatan_admin); ?></textarea>
                        <p class="mt-2 text-xs text-slate-400">
                            <i class="fas fa-info-circle mr-1"></i> Catatan hanya terlihat oleh admin
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="<?php echo e(route('filament.admin.resources.orders.view', $order->kode_pesanan)); ?>" 
                           class="px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-[#C06044] border border-transparent rounded-lg text-sm font-medium text-white hover:bg-[#b04d3a] transition-colors">
                            Update Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Riwayat Status -->
    <div class="mt-6 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-50 bg-gradient-to-r from-slate-50 to-white">
            <h3 class="font-medium text-slate-700">Riwayat Status</h3>
        </div>
        <div class="p-6">
            <div class="relative pl-8">
                <!-- Timeline line -->
                <div class="absolute left-3 top-0 bottom-0 w-0.5 bg-slate-200"></div>
                
                <!-- Current Status -->
                <div class="relative mb-6">
                    <div class="absolute left-[-1.65rem] top-1 w-4 h-4 rounded-full bg-[#C06044] border-2 border-white shadow"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-800">
                            Status saat ini: 
                            <span class="status-badge <?php echo e($statusColors[$order->status_pesanan] ?? 'bg-gray-100 text-gray-600'); ?> ml-2">
                                <?php echo e($statusLabels[$order->status_pesanan] ?? ucfirst($order->status_pesanan)); ?>

                            </span>
                        </p>
                        <p class="text-xs text-slate-400 mt-1">
                            <i class="far fa-calendar-alt mr-1"></i> <?php echo e($order->updated_at->format('d M Y H:i')); ?>

                        </p>
                    </div>
                </div>
                
                <!-- Created Status -->
                <div class="relative">
                    <div class="absolute left-[-1.65rem] top-1 w-4 h-4 rounded-full bg-slate-300 border-2 border-white"></div>
                    <div>
                        <p class="text-sm font-medium text-slate-600">Pesanan dibuat</p>
                        <p class="text-xs text-slate-400"><?php echo e($order->created_at->format('d M Y H:i')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filament-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\keand\OneDrive\Desktop\Sekolah\Kelas 12\pempekbunda75\resources\views/admin/orders/status.blade.php ENDPATH**/ ?>