<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'fullHeight' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'fullHeight' => false,
]); ?>
<?php foreach (array_filter(([
    'fullHeight' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    // JANGAN panggil method yang tidak ada
    // Cek dulu apakah method exists, baru panggil
    
    $widgetData = [];
    if (method_exists($this, 'getWidgetData')) {
        $widgetData = $this->getWidgetData();
    }
?>

<div
    <?php echo e($attributes->class([
            'fi-page',
            'h-full' => $fullHeight,
        ])); ?>

>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($this, 'getRenderHookScopes')): ?>
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::page.start', scopes: $this->getRenderHookScopes())); ?>

    <?php else: ?>
        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::page.start')); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <section
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'flex flex-col gap-y-8 py-8',
            'h-full' => $fullHeight,
        ]); ?>"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($this, 'getHeader') && ($header = $this->getHeader())): ?>
            <?php echo e($header); ?>

        <?php elseif(method_exists($this, 'getHeading') && ($heading = $this->getHeading())): ?>
            <?php if (isset($component)) { $__componentOriginal4af1e0a8ab5c0dda93279f6800da3911 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.header.index','data' => ['actions' => method_exists($this, 'getCachedHeaderActions') ? $this->getCachedHeaderActions() : [],'breadcrumbs' => filament()->hasBreadcrumbs() && method_exists($this, 'getBreadcrumbs') ? $this->getBreadcrumbs() : [],'heading' => $heading,'subheading' => method_exists($this, 'getSubheading') ? $this->getSubheading() : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(method_exists($this, 'getCachedHeaderActions') ? $this->getCachedHeaderActions() : []),'breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filament()->hasBreadcrumbs() && method_exists($this, 'getBreadcrumbs') ? $this->getBreadcrumbs() : []),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'subheading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(method_exists($this, 'getSubheading') ? $this->getSubheading() : null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911)): ?>
<?php $attributes = $__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911; ?>
<?php unset($__attributesOriginal4af1e0a8ab5c0dda93279f6800da3911); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4af1e0a8ab5c0dda93279f6800da3911)): ?>
<?php $component = $__componentOriginal4af1e0a8ab5c0dda93279f6800da3911; ?>
<?php unset($__componentOriginal4af1e0a8ab5c0dda93279f6800da3911); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <?php echo e($slot); ?>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($this, 'getRenderHookScopes')): ?>
            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::page.end', scopes: $this->getRenderHookScopes())); ?>

        <?php else: ?>
            <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::page.end')); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
</div><?php /**PATH C:\laragon\www\pempekbunda75\resources\views/vendor/filament-panels/components/page/index.blade.php ENDPATH**/ ?>