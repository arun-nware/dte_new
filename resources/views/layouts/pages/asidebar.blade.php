<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title text-light" id="digital-clock">

        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html"
             data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    @if(auth()->user()->hasRole([\App\Enums\RoleEnum::SuperAdmin->value, \App\Enums\RoleEnum::Admin->value, \App\Enums\RoleEnum::Administrator->value]))
                        @foreach($navigations as $navigation)
                            @if(empty($navigation['nav']) && $navigation['nav_type'] === 'main')
                                @can($navigation['nav_permission'])
                                    @php                $route = route($navigation['nav_route']) @endphp
                                    <li class="@if(request()->routeIs($navigation['nav_route'])) nav-active @endif">
                                        <x-responsive-nav-link :href="$route" class="nav-link">
                                            {!! $navigation['nav_icon'] !!}
                                            <span>{{ __($navigation['nav_name']) }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                @endcan
                            @else
                                <li class="nav-parent nav-parent-main">
                                    <a class="nav-link" href="#">
                                        {!! $navigation['nav_icon'] !!}
                                        <span>{{ __($navigation['nav_name']) }}</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        @foreach($navigation['nav'] as $nav)

                                            @if(empty($nav['sub']))
                                                @can($nav['nav_permission'])
                                                    @php                        $route = route($nav['nav_route']) @endphp
                                                    <li class="@if(request()->routeIs($nav['nav_route'])) nav-active @endif">
                                                        <x-responsive-nav-link :href="$route" class="nav-link">
                                                            <span>{{ __($nav['nav_name']) }}</span>
                                                        </x-responsive-nav-link>
                                                    </li>

                                                @endcan
                                            @else
                                                <li class="nav-parent">
                                                    <a class="nav-link" href="#">
                                                        {{ __($nav['nav_name']) }}<span
                                                            class="mega-sub-nav-toggle toggled float-end"
                                                            data-toggle="collapse"
                                                            data-target=".mega-sub-nav-sub-menu-1"></span>
                                                    </a>
                                                    <ul class="nav nav-children">
                                                        @foreach($nav['sub'] as $sub)
                                                            @can($sub['nav_permission'])
                                                                @php                            $route = route($sub['nav_route']) @endphp
                                                                <li class="@if(request()->routeIs($sub['nav_route'])) nav-active @endif">
                                                                    <x-responsive-nav-link :href="$route"
                                                                                           class="nav-link">
                                                                        <span>{{ __($sub['nav_name']) }}</span>
                                                                    </x-responsive-nav-link>
                                                                </li>
                                                            @endcan
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach

                    @else
                        <li>
                            <x-responsive-nav-link :href="route('dashboard')" class="nav-link">
                                <i class="bx bx-home-alt" aria-hidden="true"></i>
                                <span>{{ __('Home') }}</span>
                            </x-responsive-nav-link>
                        </li>
                        @can('search')
                            @can('search_payments')
                                <li>
                                    <x-responsive-nav-link :href="route('search.payments')" class="nav-link">
                                        <i class="fa-solid fa-search"></i>
                                        <span>{{ __('Search Payment') }}</span>
                                    </x-responsive-nav-link>
                                </li>
                            @endcan
                            @can('search_approvals')
                                <li>
                                    <x-responsive-nav-link :href="route('search.approvals')" class="nav-link">
                                        <i class="bx bx-check-circle" aria-hidden="true"></i>
                                        <span>{{ __('Approvals') }}</span>
                                    </x-responsive-nav-link>
                                </li>
                            @endcan
                        @endcan
                        @can('employee')
                            @can('employee_verification')
                                <li>
                                    <x-responsive-nav-link :href="route('employee.verification')" class="nav-link">
                                        <i class="fa-solid fa-user-clock"></i>
                                        <span>{{ __('Bank Account Verification') }}</span>
                                    </x-responsive-nav-link>
                                </li>
                            @endcan
                        @endcan
                        @can('register')
                            <li class="nav-parent nav-parent-main">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-clipboard"></i>
                                    <span>Register</span>
                                </a>
                                <ul class="nav nav-children">
                                    @can('register_case_id')
                                        <li>
                                            <x-responsive-nav-link :href="route('register.case_id')" class="nav-link">
                                                <span>{{ __('New Case ID') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan
                                    @can('register_procedure_code')
                                        <li>
                                            <x-responsive-nav-link :href="route('register.procedure_code')"
                                                                   class="nav-link">
                                                <span>{{ __('Procedure Code') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan
                                    @can('register_designation_code')
                                        <li>
                                            <x-responsive-nav-link :href="route('register.designation_code')"
                                                                   class="nav-link">
                                                <span>{{ __('Designation Code') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('payment')
                            <li class="nav-parent nav-parent-main">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-money-check"></i>
                                    <span>Manage Payments</span>
                                </a>
                                <ul class="nav nav-children">
                                    @can('manage_payment')
                                        <li>
                                            <x-responsive-nav-link :href="route('payment.manage_payment')"
                                                                   class="nav-link">
                                                <span>{{ __('View Payment File') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan
                                    @can('manage_rejected_payment')
                                        <li>
                                            <x-responsive-nav-link :href="route('payment.manage_rejected_payment')"
                                                                   class="nav-link">
                                                <span>{{ __('Rejected Payment') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('medical_college_management')
                            <li>
                                <x-responsive-nav-link :href="route('administration.medical_college_management')"
                                                       class="nav-link">
                                    <i class="fa-solid fa-school"></i>
                                    <span>{{ __('Manage Medical College') }}</span>
                                </x-responsive-nav-link>
                            </li>
                        @endcan
                        @can('hospital_management')
                            <li>
                                <x-responsive-nav-link :href="route('administration.hospital_management')"
                                                       class="nav-link">
                                    <i class="fa-solid fa-hospital"></i>
                                    <span>{{ __('Manage Hospital') }}</span>
                                </x-responsive-nav-link>
                            </li>
                        @endcan

                        @can('employee_management')
                            <li>
                                <x-responsive-nav-link :href="route('administration.employee_management')"
                                                       class="nav-link">
                                    <i class="fa fa-user"></i>
                                    <span>{{ __('Manage Employees') }}</span>
                                </x-responsive-nav-link>
                            </li>
                        @endcan

                        @can('reports')
                            <li class="nav-parent nav-parent-main">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-chart-line"></i>
                                    <span>Reports</span>
                                </a>
                                <ul class="nav nav-children">
                                    @can('transaction_report')
                                        <li>
                                            <x-responsive-nav-link :href="route('report.transaction_report')"
                                                                   class="nav-link">
                                                <span>{{ __('Transaction Report') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan

                                    @can('incentive_report')
                                        <li>
                                            <x-responsive-nav-link :href="route('report.incentive_report')"
                                                                   class="nav-link">
                                                <span>{{ __('Incentive Report') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan

                                    @can('monthly_report')
                                        <li>
                                            <x-responsive-nav-link :href="route('report.monthly_report')"
                                                                   class="nav-link">
                                                <span>{{ __('Monthly Report') }}</span>
                                            </x-responsive-nav-link>
                                        </li>
                                    @endcan

                                </ul>
                            </li>
                        @endcan

                    @endif

                </ul>

                {{--<ul class="nav nav-main d-none">

                    <li class="@if(request()->routeIs('dashboard')) nav-active @endif">
                        <x-responsive-nav-link :href="route('dashboard')" class="nav-link">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>{{ __('Dashboard') }}</span>
                        </x-responsive-nav-link>
                    </li>

                    @can('user_management')
                    <li class="nav-parent nav-parent-main">
                        <a class="nav-link" href="#">
                            <i class="icons icon-people" aria-hidden="true"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="nav nav-children">
                            @can('user_index')
                            <li class="@if(request()->routeIs('user-management.users')) nav-active @endif">
                                <x-responsive-nav-link :href="route('user-management.users')" class="nav-link">
                                    <span>{{ __('Users') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                            @can('role_index')
                            <li class="@if(request()->routeIs('user-management.roles')) nav-active @endif">
                                <x-responsive-nav-link :href="route('user-management.roles')" class="nav-link">
                                    <span>{{ __('Roles') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('config_management')
                    <li class="nav-parent nav-parent-main">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-gears"></i>
                            <span>Configuration Management</span>
                        </a>
                        <ul class="nav nav-children">
                            @can('day_setting')
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    Day Setting <span class="mega-sub-nav-toggle toggled float-end"
                                        data-toggle="collapse" data-target=".mega-sub-nav-sub-menu-1"></span>
                                </a>
                                <ul class="nav nav-children">
                                    @can('day_setting')
                                    <li
                                        class="@if(request()->routeIs('config-management.weekday_setting')) nav-active @endif">
                                        <x-responsive-nav-link :href="route('config-management.weekday_setting')"
                                            class="nav-link">
                                            <span>{{ __('Weekday Setting') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                    @endcan
                                    @can('special_day_setting')
                                    <li
                                        class="@if(request()->routeIs('config-management.special_day_setting')) nav-active @endif">
                                        <x-responsive-nav-link :href="route('config-management.special_day_setting')"
                                            class="nav-link">
                                            <span>{{ __('Special Day Setting') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('equipment_type_index')
                            <li class="@if(request()->routeIs('config-management.equipment_types')) nav-active @endif">
                                <x-responsive-nav-link :href="route('config-management.equipment_types')"
                                    class="nav-link">
                                    <span>{{ __('Equipment Type') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                            @can('gate_index')
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    Gate Config <span class="mega-sub-nav-toggle toggled float-end"
                                        data-toggle="collapse" data-target=".mega-sub-nav-sub-menu-1"></span>
                                </a>
                                <ul class="nav nav-children">
                                    <li
                                        class="@if(request()->routeIs('config-management.gate_names')) nav-active @endif">
                                        <x-responsive-nav-link :href="route('config-management.gate_names')"
                                            class="nav-link">
                                            <span>{{ __('Gate Name') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                    <li
                                        class="@if(request()->routeIs('config-management.gate_types')) nav-active @endif">
                                        <x-responsive-nav-link :href="route('config-management.gate_types')"
                                            class="nav-link">
                                            <span>{{ __('Gate Type') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                    <li class="@if(request()->routeIs('config-management.gates')) nav-active @endif">
                                        <x-responsive-nav-link :href="route('config-management.gates')"
                                            class="nav-link">
                                            <span>{{ __('Gate') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                </ul>
                            </li>
                            @endcan
                            @can('ip_address_index')
                            <li class="@if(request()->routeIs('config-management.ip_addresses')) nav-active @endif">
                                <x-responsive-nav-link :href="route('config-management.ip_addresses')" class="nav-link">
                                    <span>{{ __('IP Address') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                            @can('payment_mode_index')
                            <li class="@if(request()->routeIs('config-management.payment_modes')) nav-active @endif">
                                <x-responsive-nav-link :href="route('config-management.payment_modes')"
                                    class="nav-link">
                                    <span>{{ __('Payment Mode') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                            --}}{{--@can('ticket_layouts_index')
                            <li class="@if(request()->routeIs('config-management.ticket_layouts')) nav-active @endif">
                                <x-responsive-nav-link :href="route('config-management.ticket_layouts')"
                                    class="nav-link">
                                    <span>{{ __('Ticket Layouts') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                            @can('statistics_list_index')
                            <li class="@if(request()->routeIs('config-management.statistics_lists')) nav-active @endif">
                                <x-responsive-nav-link :href="route('config-management.statistics_lists')"
                                    class="nav-link">
                                    <span>{{ __('Statistics List') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan--}}{{--
                        </ul>
                    </li>
                    @endcan
                    @can('tariff_management')
                    <li class="nav-parent nav-parent-main">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-traffic-light"></i>
                            <span>Tariff Management</span>
                        </a>
                        <ul class="nav nav-children">
                            @can('casual_tariff_index')
                            <li class="@if(request()->routeIs('tariff-management.casual_tariffs')) nav-active @endif">
                                <x-responsive-nav-link :href="route('tariff-management.casual_tariffs')"
                                    class="nav-link">
                                    <span>{{ __('Casual Tariff') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('discount_index')
                    <li class="@if(request()->routeIs('discounts')) nav-active @endif">
                        <x-responsive-nav-link :href="route('discounts')" class="nav-link">
                            <i class="fas fa-tags" aria-hidden="true"></i>
                            <span>{{ __('Discount') }}</span>
                        </x-responsive-nav-link>
                    </li>
                    @endcan
                    @can('reports')
                    <li class="nav-parent nav-parent-main">
                        <a class="nav-link" href="#">
                            <i class="fas fa-file"></i>
                            <span>Reports</span>
                        </a>
                        <ul class="nav nav-children">
                            @can('transaction_report')
                            <li class="@if(request()->routeIs('reports.transaction_report')) nav-active @endif">
                                <x-responsive-nav-link :href="route('reports.transaction_report')" class="nav-link">
                                    <span>{{ __('Transaction Report') }}</span>
                                </x-responsive-nav-link>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('site_setting_index')
                    <li class="@if(request()->routeIs('site-setting')) nav-active @endif">
                        <x-responsive-nav-link :href="route('site-setting')" class="nav-link">
                            <i class="icons icon-settings" aria-hidden="true"></i>
                            <span>{{ __('Site Setting') }}</span>
                        </x-responsive-nav-link>
                    </li>
                    @endcan
                </ul>--}}
            </nav>
        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }


        </script>

    </div>

</aside>
@push('scripts')
    <script>
        $(document).ready(function () {
            /*$(".nav-active").find(".nav-parent").addClass("menu-is-opening menu-open");

            if( $('.nav-active').closest('li').find( '> ul' ).parent().hasClass('nav-parent') ) {
                $('.nav-active').closest('li').find( '> ul' ).slideUp( 'fast', function() {
                    $(this).closest('li').addClass( 'nav-expanded nav-active' );
                });
                console.log(123123)
            }else{
                console.log('herew')
            }*/

            if ($('li').hasClass('nav-active')) {
                // $('.nav-expanded nav-active').slideDown('fast', function () {
                //     $(this).closest('li').removeClass('nav-expanded nav-active');
                //     $('.nav-parent-3').removeClass('nav-expanded nav-active');
                //
                // });
                $('.nav-active').closest('ul .nav-parent').slideUp('fast', function () {
                    $(this).closest('li').addClass('nav-expanded nav-active').show().slideUp('slow', function () {
                        $(this).closest('.nav-parent').addClass('nav-expanded nav-active').show();
                        if ($(this).find('.nav-children').parent().closest('.nav-parent-main').hasClass('nav-parent-main')) {
                            $(this).find('.nav-children').parent().closest('.nav-parent-main').addClass('nav-expanded nav-active').show();
                        } else {
                            $(this).find('.nav-children').parent().closest('.nav-parent-main').removeClass('nav-expanded nav-active');
                        }
                    });
                });
            }
        });
    </script>
@endpush
<!-- end: sidebar -->
