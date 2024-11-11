<!doctype html>
<html class="fixed has-top-menu has-left-sidebar-half" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? $siteSetting->app_name); ?></title>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <link href="<?php echo e(asset('app').'/'.$siteSetting->favicon); ?>" rel="icon">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">


    <?php echo $__env->make('layouts.pages.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body style="background-color: rgba(10,6,6,0.26)">
<!-- Preloader -->
<?php if (isset($component)) { $__componentOriginalaaab4f175774de3814d3e8eb165c626d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaaab4f175774de3814d3e8eb165c626d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-loader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('application-loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaaab4f175774de3814d3e8eb165c626d)): ?>
<?php $attributes = $__attributesOriginalaaab4f175774de3814d3e8eb165c626d; ?>
<?php unset($__attributesOriginalaaab4f175774de3814d3e8eb165c626d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaaab4f175774de3814d3e8eb165c626d)): ?>
<?php $component = $__componentOriginalaaab4f175774de3814d3e8eb165c626d; ?>
<?php unset($__componentOriginalaaab4f175774de3814d3e8eb165c626d); ?>
<?php endif; ?>
<section class="body">


    <?php echo $__env->make('components.offline', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.pages.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.pages.sub-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="inner-wrapper">
        <?php echo $__env->make('layouts.pages.asidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section role="main" class="content-body pb-0" >
            <?php echo e($slot); ?>

            <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
        </section>
    </div>
</section>
<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('password-update-livewire-component', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1850603710-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

</body>

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

<?php echo $__env->make('layouts.pages.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    // You can also initialize by yourself, like:
    $('.loading-overlay').loadingOverlay({
        "startShowing": false, // defaults to false
        "hideOnWindowLoad": true, // defaults to false
        "css": {} // object container css stuff, defaults to match backgroundColor and border-radius
    });

    //available options via data-overlay-options or passing object via javascript initialization
    // {
    // 	"startShowing": true | false, // defaults to false
    // 	"hideOnWindowLoad": true | false, // defaults to false
    // 	"css": {} // object container css stuff, defaults to match backgroundColor and border-radius
    // }

    $(document).ready(function () {
        $('.preloader').css('height', 0);
        setTimeout(function () {
            $('.preloader').children().hide();
        }, 200);
    })

    function onlyNumberKey(event, input) {
        return input.value = input.value.replace(/[^0-9]/g, '')
    }

    // if ($preloader) {
    //     $preloader.css('height', 0);
    //     setTimeout(function () {
    //         $preloader.children().hide();
    //     }, 200);
    // }

    jQuery(function () {

        $('.select2').each(function () {
            $(this).select2({
                theme: "bootstrap-5",
                dropdownParent: $(this).parent(), // fix select2 search input focus bug
            })
        })

        // fix select2 bootstrap modal scroll bug
        $(document).on('select2:close', '.select2', function (e) {
            var evt = "scroll.select2"
            $(e.target).parents().off(evt)
            $(window).off(evt)
        })

    })

</script>
</html>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/layouts/app.blade.php ENDPATH**/ ?>