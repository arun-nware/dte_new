<header class="sub-header header-nav-menu">
    <div class="logo-container">
        <!-- start: header nav menu -->
        <div class="header-nav collapse">
            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
                <nav>
                    <ul class="nav nav-pills" id="mainNav">
                        <li class="<?php if(request()->routeIs('dashboard')): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                                Home
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle <?php if(request()->routeIs('guidelines')): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('guidelines')); ?>">
                                Guidelines
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle <?php if(request()->routeIs('download-formats')): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('download-formats')); ?>">
                                Download Formats
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle <?php if(request()->routeIs('notification')): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('notifications')); ?>">
                                Notifications
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle <?php if(request()->routeIs('contact-us')): ?> active <?php endif; ?>">
                            <a class="nav-link" href="<?php echo e(route('contact-us')); ?>">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- end: header nav menu -->
    </div>

    <!-- start: search & user box -->
    <div class="header-right">

        

        <span class="separator"></span>
        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="<?php echo e(asset("assets/img/!logged-user.png")); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                         class="rounded-circle" data-lock-picture="img/!logged-user.png"/>
                </figure>
                <div class="profile-info" data-lock-name="<?php echo e(Auth::user()->name); ?>"
                     data-lock-email="<?php echo e(Auth::user()->email); ?>">
                    <span class="name"><?php echo e(Auth::user()->name); ?></span>
                    <span class="role"><?php echo e(Auth::user()->roles->pluck('name')->implode(', ')); ?></span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['role' => 'menuitem','tabindex' => '-1','href' => route('profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['role' => 'menuitem','tabindex' => '-1','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit'))]); ?><i
                                class="bx bx-user-circle"></i>
                            <?php echo e(__('Profile')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                    </li>

                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['role' => 'menuitem','tabindex' => '-1','href' => route('logout'),'onclick' => 'event.preventDefault();
														this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['role' => 'menuitem','tabindex' => '-1','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault();
														this.closest(\'form\').submit();']); ?>
                                <i class="bx bx-power-off"></i><?php echo e(__('Log Out')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/layouts/pages/sub-header.blade.php ENDPATH**/ ?>