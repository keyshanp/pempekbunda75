<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'alpineValid' => null,
    'valid' => true,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'alpineValid' => null,
    'valid' => true,
]); ?>
<?php foreach (array_filter(([
    'alpineValid' => null,
    'valid' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $hasAlpineValidClasses = filled($alpineValid);

    $validInputClasses = 'text-primary-600 ring-gray-950/10 focus:ring-primary-600 checked:focus:ring-primary-500/50';
    $invalidInputClasses = 'fi-invalid text-danger-600 ring-danger-600 focus:ring-danger-600 checked:focus:ring-danger-500/50';
?>

<input
    type="checkbox"
    <?php if($hasAlpineValidClasses): ?>
        x-bind:class="{
            <?php echo \Illuminate\Support\Js::from($validInputClasses)->toHtml() ?>: <?php echo e($alpineValid); ?>,
            <?php echo \Illuminate\Support\Js::from($invalidInputClasses)->toHtml() ?>: <?php echo e("(! {$alpineValid})"); ?>,
        }"
    <?php endif; ?>
    <?php echo e($attributes
            ->class([
                'fi-checkbox-input rounded border-none bg-white shadow-sm ring-1 transition duration-75 checked:ring-0 focus:ring-2 focus:ring-offset-0 disabled:pointer-events-none disabled:bg-gray-50 disabled:text-gray-50 disabled:checked:bg-current disabled:checked:text-gray-400',
                $validInputClasses => (! $hasAlpineValidClasses) && $valid,
                $invalidInputClasses => (! $hasAlpineValidClasses) && (! $valid),
            ])); ?>

/>
<?php /**PATH C:\laragon\www\2maretpempekbundacode\pempekbunda75\resources\views/vendor/filament/components/input/checkbox.blade.php ENDPATH**/ ?>