<!-- Vendor -->
<script src="{{ asset("assets/vendor/jquery/jquery.js") }}"></script>
<script src="{{ asset("assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js") }}"></script>
<script src="{{ asset("assets/vendor/popper/umd/popper.min.js") }}"></script>
<script src="{{ asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
{{--		<script src="{{ asset("assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js") }}"></script>--}}
{{--        <script src="{{ asset("assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js") }}"></script>--}}
<script src="{{ asset("assets/vendor/common/common.js") }}"></script>
<script src="{{ asset("assets/vendor/nanoscroller/nanoscroller.js") }}"></script>
<script src="{{ asset("assets/vendor/magnific-popup/jquery.magnific-popup.js") }}"></script>
<script src="{{ asset("assets/vendor/jquery-placeholder/jquery.placeholder.js") }}"></script>

<!-- Specific Page Vendor -->
<script src="{{ asset("assets/vendor/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("assets/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js") }}"></script>
<script src="{{ asset("assets/vendor/jquery-appear/jquery.appear.js") }}"></script>
<script src="{{ asset("assets/vendor/bootstrap-multiselect/js/bootstrap-multiselect.js") }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset("assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.js") }}"></script>
<script src="{{ asset("assets/vendor/flot/jquery.flot.js") }}"></script>
<script src="{{ asset("assets/vendor/flot.tooltip/jquery.flot.tooltip.js") }}"></script>
<script src="{{ asset("assets/vendor/flot/jquery.flot.pie.js") }}"></script>
<script src="{{ asset("assets/vendor/flot/jquery.flot.categories.js") }}"></script>
<script src="{{ asset("assets/vendor/flot/jquery.flot.resize.js") }}"></script>
<script src="{{ asset("assets/vendor/jquery-sparkline/jquery.sparkline.js") }}"></script>
<script src="{{ asset("assets/vendor/raphael/raphael.js") }}"></script>
<script src="{{ asset("assets/vendor/morris/morris.js") }}"></script>
<script src="{{ asset("assets/vendor/gauge/gauge.js") }}"></script>
{{--		<script src="{{ asset("assets/vendor/snap.svg/snap.svg.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/liquid-meter/liquid.meter.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/jquery.vmap.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/data/jquery.vmap.sampledata.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/jquery.vmap.world.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js") }}"></script>--}}
{{--		<script src="{{ asset("assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js") }}"></script>--}}

<!-- Theme Base, Components and Settings -->
<script src="{{ asset("assets/js/theme.js") }}"></script>

<!-- Theme Custom -->
<script src="{{ asset("assets/js/custom.js") }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset("assets/js/theme.init.js") }}"></script>

<!-- Examples -->
<script src="{{ asset("assets/js/examples/examples.dashboard.js") }}"></script>
<script src="{{ asset("assets/js/examples/examples.charts.js") }}"></script>

<script src="{{ asset("assets/vendor/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("assets/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js") }}"></script>
<script src="{{ asset("assets/vendor/moment/moment.js") }}"></script>
<script src="{{ asset("assets/vendor/fullcalendar/index.global.min.js") }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset("assets/js/pikaday.js") }}"></script>
<x-livewire-alert::scripts/>
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
@stack('scripts')
