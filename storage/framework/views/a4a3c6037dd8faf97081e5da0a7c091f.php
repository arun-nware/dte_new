<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
'title',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
'title',
]); ?>
<?php foreach (array_filter(([
'title',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<main>
    <header class="page-header">
        <h2><?php echo e($title); ?></h2>
        <div class="right-wrapper text-end mx-2">

            <ol class="breadcrumbs">
                <?php echo e($slot); ?>

                <li>
                    <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-purple text-light"><i class="fa fa-reply mr5"></i> Back</a>
                </li>
            </ol>
        </div>
    </header>
</main>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/components/header.blade.php ENDPATH**/ ?>