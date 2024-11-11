
<!doctype html>
<html class="fixed" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e($title ?? $siteSetting->app_name); ?></title>
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link href="<?php echo e(asset('app').'/'.$siteSetting->favicon); ?>" rel="icon">
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<?php echo $__env->make('layouts.pages.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
	</head>
	<body class="login-page-body-content">
		<?php echo e($slot); ?>

	</body>
	<?php echo $__env->make('layouts.pages.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/layouts/guest.blade.php ENDPATH**/ ?>