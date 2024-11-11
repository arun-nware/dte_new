<div>
    @php
        use Carbon\Carbon;
    @endphp
    <main>
        <x-header title="Dashboard">
        </x-header>

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
                                                        class="amount">{{ $totalAdult + $totalChild }}</strong>
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
                                                    <strong class="amount">₹ {{ $totalIncome }}</strong>
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
                                                    <strong class="amount">₹ {{ $totalIncome }}</strong>
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
                                                    <strong class="amount">{{ $totalAdult }}</strong>
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
                                                    <strong class="amount">{{ $totalChild }}</strong>
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
                                                    <strong class="amount">{{ $totalChild }}</strong>
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
                {{--<div class="row">
                    <div class="col-lg-12 mb-3">
                        <section class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="chart-data-selector" id="salesSelectorWrapper">
                                            <h2>
                                                Today Upload:
                                                <strong>
                                                    <select class="form-control" id="salesSelector">
                                                        <option value="child">Child</option>
                                                        <option value="adult">Adult</option>
                                                        <option value="both" selected>Both</option>
                                                    </select>
                                                </strong>
                                            </h2>

                                            <div id="salesSelectorItems" class="chart-data-selector-items mt-3">
                                                <!-- Flot: Sales Porto Admin -->
                                                <div class="chart chart-sm" data-sales-rel="child"
                                                     id="flotDashSales1"
                                                     class="chart-active" style="height: 203px;"></div>
                                                <script>
                                                    var childData = @json($childGraphCount)

                                                    var flotDashSales1Data = [{
                                                        data: childData,
                                                        color: "#0088cc"
                                                    }];

                                                    // See: js/examples/examples.dashboard.js for more settings.

                                                </script>

                                                <!-- Flot: Sales Porto Drupal -->
                                                <div class="chart chart-sm" data-sales-rel="adult"
                                                     id="flotDashSales2"
                                                     class="chart-hidden"></div>
                                                <script>
                                                    let adultData = @json($adultGraphCount)

                                                    var flotDashSales2Data = [{
                                                        data: adultData,
                                                        color: "#2baab1"
                                                    }];

                                                    // See: js/examples/examples.dashboard.js for more settings.

                                                </script>

                                                <!-- Flot: Sales Porto Wordpress -->
                                                <div class="chart chart-sm" data-sales-rel="both"
                                                     id="flotDashSales3"
                                                     class="chart-hidden"></div>
                                                <script>
                                                    let bothData = @json($bothGraphCount)

                                                    var flotDashSales3Data = [{
                                                        data: bothData,
                                                        color: "#734ba9"
                                                    }];

                                                    // See: js/examples/examples.dashboard.js for more settings.

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <section class="card">
                            <header class="card-header">
                                <div class="card-actions">
                                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                </div>

                                <h2 class="card-title">Total Income</h2>
                                <p class="card-subtitle">Last 7 Days</p>
                            </header>
                            <div class="card-body">

                                <!-- Morris: Bar -->
                                <div class="chart chart-md" id="morrisBar"></div>
                                <script type="text/javascript">
                                    let barData = @json($lastSevenDaysIncome)

                                    var morrisBarData = barData;

                                    // See: js/examples/examples.charts.js for more settings.

                                </script>

                            </div>
                        </section>
                    </div>
                    <div class="col-lg-6">
                        <section class="card">
                            <header class="card-header">
                                <div class="card-actions">
                                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                                </div>

                                <h2 class="card-title">Visitors</h2>
                                <p class="card-subtitle">Today Only</p>
                            </header>
                            <div class="card-body">

                                <!-- Morris: Donut -->
                                <div class="chart chart-md" id="morrisDonut"></div>
                                <script type="text/javascript">
                                    let adult = "{{ $totalAdult }}"
                                    let child = "{{ $totalChild }}"
                                    let both = "{{ $totalAdult + $totalChild }}";
                                    var morrisDonutData = [{
                                        label: "Both",
                                        value: both
                                    }, {
                                        label: "Adult",
                                        value: adult
                                    }, {
                                        label: "Child",
                                        value: child
                                    }];

                                    // See: js/examples/examples.charts.js for more settings.

                                </script>

                            </div>
                        </section>
                    </div>
                </div>--}}
                <!-- end: page -->
            </div>
        </section>
    </main>
</div>
