<div>
    <?php
        use Carbon\Carbon;
    ?>
    <main>
        <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => ['title' => 'Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard']); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

        <section class="card">
            <!-- start: page -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-xl-6">
                            <section class="card card-featured-left card-featured-warning mb-3">
                                <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-warning">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total received amount (in month)</h4>
                                                <div class="info">
                                                    <strong
                                                        class="amount"><?php echo e($totalAdult + $totalChild); ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-6">
                            <section class="card card-featured-left card-featured-success">
                                <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total amount credited into Hospital account no. </h4>
                                                <div class="info">
                                                    <strong class="amount">₹ <?php echo e($totalIncome); ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6">
                            <section class="card card-featured-left card-featured-warning">
                                <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-warning">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total amount credited into Employees account no. </h4>
                                                <div class="info">
                                                    <strong class="amount">₹ <?php echo e($totalIncome); ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-6">
                            <section class="card card-featured-left card-featured-success mb-3">
                                <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total rejected amount </h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo e($totalAdult); ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xl-6">
                            <section class="card card-featured-left card-featured-warning">
                                <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-warning">
                                                <i class="fa-solid fa-person"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Total registered employee. </h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo e($totalChild); ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-6">
                            <section class="card card-featured-left card-featured-success">
                                <div class="card-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-success">
                                                <i class="fa-solid fa-building-columns"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Send to Bank (H2H pending amount) </h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo e($totalChild); ?></strong>
                                                </div>
                                            </div>
                                            <div class="summary-footer">
                                                <p>0</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                
                <!-- end: page -->
            </div>
        </section>
    </main>
</div>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/livewire/dashboard-livewire-component.blade.php ENDPATH**/ ?>