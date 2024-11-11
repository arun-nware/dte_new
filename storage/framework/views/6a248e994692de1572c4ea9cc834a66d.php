<div class="preloader flex-column justify-content-center align-items-center">
    <?php if(isset($siteSetting->favicon) && $siteSetting->favicon != ''): ?>
        <img class="animation__shake" src="<?php echo e(asset('app').'/'.$siteSetting->favicon ?? asset('assets/img/favicon.png')); ?>" alt="<?php echo e($siteSetting->favicon ?? config('app.APP_NAME')); ?>" height="60"
             width="60">
    <?php else: ?>
        <div class="loading-overlay">
            <div class="bounce-loader">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/components/application-loader.blade.php ENDPATH**/ ?>