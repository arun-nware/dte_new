<!-- Vendor -->
<script src="<?php echo e(asset("assets/vendor/jquery/jquery.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/popper/umd/popper.min.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")); ?>"></script>


<script src="<?php echo e(asset("assets/vendor/common/common.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/nanoscroller/nanoscroller.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/magnific-popup/jquery.magnific-popup.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/jquery-placeholder/jquery.placeholder.js")); ?>"></script>

<!-- Specific Page Vendor -->
<script src="<?php echo e(asset("assets/vendor/jquery-ui/jquery-ui.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/jquery-appear/jquery.appear.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/bootstrap-multiselect/js/bootstrap-multiselect.js")); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo e(asset("assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/flot/jquery.flot.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/flot.tooltip/jquery.flot.tooltip.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/flot/jquery.flot.pie.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/flot/jquery.flot.categories.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/flot/jquery.flot.resize.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/jquery-sparkline/jquery.sparkline.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/raphael/raphael.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/morris/morris.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/gauge/gauge.js")); ?>"></script>












<!-- Theme Base, Components and Settings -->
<script src="<?php echo e(asset("assets/js/theme.js")); ?>"></script>

<!-- Theme Custom -->
<script src="<?php echo e(asset("assets/js/custom.js")); ?>"></script>

<!-- Theme Initialization Files -->
<script src="<?php echo e(asset("assets/js/theme.init.js")); ?>"></script>

<!-- Examples -->
<script src="<?php echo e(asset("assets/js/examples/examples.dashboard.js")); ?>"></script>
<script src="<?php echo e(asset("assets/js/examples/examples.charts.js")); ?>"></script>

<script src="<?php echo e(asset("assets/vendor/jquery-ui/jquery-ui.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/moment/moment.js")); ?>"></script>
<script src="<?php echo e(asset("assets/vendor/fullcalendar/index.global.min.js")); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="<?php echo e(asset("assets/js/pikaday.js")); ?>"></script>
<?php if (isset($component)) { $__componentOriginal8344cca362e924d63cb0780eb5ae3ae6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-alert::components.scripts','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-alert::scripts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6)): ?>
<?php $attributes = $__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6; ?>
<?php unset($__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8344cca362e924d63cb0780eb5ae3ae6)): ?>
<?php $component = $__componentOriginal8344cca362e924d63cb0780eb5ae3ae6; ?>
<?php unset($__componentOriginal8344cca362e924d63cb0780eb5ae3ae6); ?>
<?php endif; ?>
<script>
    function getDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        if (month.toString().length == 1) {
            month = '0' + month;
        }
        if (day.toString().length == 1) {
            day = '0' + day;
        }
        if (hour.toString().length == 1) {
            hour = '0' + hour;
        }
        if (minute.toString().length == 1) {
            minute = '0' + minute;
        }
        if (second.toString().length == 1) {
            second = '0' + second;
        }
        const weekday = ["Sun","Mon","Tue","Wed","Thur","Fri","Sat"];

        const dateTime = weekday[now.getDay()]+ ', ' +day + '-' + month + '-' + year + ' ' + hour + ':' + minute + ':' + second;
        return dateTime;
    }

    // example usage: realtime clock
    setInterval(function () {
        const currentTime = getDateTime();
        document.getElementById("digital-clock").innerHTML = currentTime;
    }, 1000);

    function toggleListView(button, id) {
        const listView = document.getElementById("list-view-" + id);
        ;
        console.log(listView)
        listView.classList.toggle('hidden');
        var icon = document.getElementsByClassName("icon_" + id);
        if (button.firstElementChild.classList.contains('fa-circle-plus')) {
            button.firstElementChild.classList.remove('fa-circle-plus');
            button.firstElementChild.classList.toggle('fa-circle-minus');
        } else {
            button.firstElementChild.classList.remove('fa-circle-minus');
            button.firstElementChild.classList.toggle('fa-circle-plus');
        }
    }


</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/layouts/pages/script.blade.php ENDPATH**/ ?>