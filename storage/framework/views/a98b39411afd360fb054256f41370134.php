<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['active' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['active' => false]); ?>
<?php foreach (array_filter((['active' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<button <?php echo e($attributes->merge(['type' => 'submit', 'class' => 'btn'])); ?> wire:loading.remove>
    <?php echo e($slot); ?>

    <?php if($active): ?>
        <button <?php echo e($attributes->merge(['class' => 'btn'])); ?> type="button" disabled="" wire:loading>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <?php echo e($slot); ?>

        </button>
    <?php endif; ?>
</button>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/components/primary-button.blade.php ENDPATH**/ ?>