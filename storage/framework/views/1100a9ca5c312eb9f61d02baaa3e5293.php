<!-- start: header -->
<header class="header header-nav-menu">
    <div class="logo-container">
        <?php $appName = explode("|", $siteSetting->app_name) ?>
        <a href="<?php echo e(route('dashboard')); ?>" class="float-start" >
            <img src="<?php echo e(asset('app').'/'.$siteSetting->logo); ?>" width="70" height="70"
                 alt="<?php if(isset($appName[0])): ?><?php echo e($appName[0]); ?><?php endif; ?>"/>
        </a>
        <div class=" text-white inline align-items-center py-3 mx-3">
                <span class="text-md"><?php if(isset($appName[0])): ?>
                        <?php echo e($appName[0]); ?>

                    <?php endif; ?></span>
            <br>
            <span style="font-size: 16px"><?php if(isset($appName[1])): ?>
                    <?php echo e($appName[1]); ?>

                <?php endif; ?></span>
        </div>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
             data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>

    </div>

    <!-- start: search & user box -->
    <div class="header-right">
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/layouts/pages/header.blade.php ENDPATH**/ ?>