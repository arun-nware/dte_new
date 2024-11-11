<header class="sub-header header-nav-menu">
    <div class="logo-container">
        <!-- start: header nav menu -->
        <div class="header-nav collapse">
            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
                <nav>
                    <ul class="nav nav-pills" id="mainNav">
                        <li class="@if(request()->routeIs('dashboard')) active @endif">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                Home
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle @if(request()->routeIs('guidelines')) active @endif">
                            <a class="nav-link" href="{{ route('guidelines') }}">
                                Guidelines
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle @if(request()->routeIs('download-formats')) active @endif">
                            <a class="nav-link" href="{{ route('download-formats') }}">
                                Download Formats
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle @if(request()->routeIs('notification')) active @endif">
                            <a class="nav-link" href="{{ route('notifications') }}">
                                Notifications
                            </a>
                        </li>
                        <li class="dropdown navbar-toggle @if(request()->routeIs('contact-us')) active @endif">
                            <a class="nav-link" href="{{ route('contact-us') }}">
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

        {{--<a class="btn search-toggle d-none d-md-inline-block d-xl-none" data-toggle-class="active" data-target=".search"><i class="bx bx-search"></i></a>
        <form action="pages-search-results.html" class="search nav-form d-none d-xl-inline-block">
            <div class="input-group">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
            </div>
        </form>

        <span class="separator"></span>

        <ul class="notifications">
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-task"></i>
                    <span class="badge">3</span>
                </a>

                <div class="dropdown-menu notification-menu large">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">3</span>
                        Tasks
                    </div>

                    <div class="content">
                        <ul>
                            <li>
                                <p class="clearfix mb-1">
                                    <span class="message float-start">Generating Sales Report</span>
                                    <span class="message float-end text-dark">60%</span>
                                </p>
                                <div class="progress progress-xs light">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </li>

                            <li>
                                <p class="clearfix mb-1">
                                    <span class="message float-start">Importing Contacts</span>
                                    <span class="message float-end text-dark">98%</span>
                                </p>
                                <div class="progress progress-xs light">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                </div>
                            </li>

                            <li>
                                <p class="clearfix mb-1">
                                    <span class="message float-start">Uploading something big</span>
                                    <span class="message float-end text-dark">33%</span>
                                </p>
                                <div class="progress progress-xs light mb-1">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-envelope"></i>
                    <span class="badge">4</span>
                </a>

                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">230</span>
                        Messages
                    </div>

                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">

                                    <figure class="image">
                                        <img src="img/!sample-user.jpg" alt="Joseph Doe Junior" class="rounded-circle">
                                    </figure>

                                    <span class="title">Joseph Doe</span>
                                    <span class="message">Lorem ipsum dolor sit.</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">

                                    <figure class="image">
                                        <img src="img/!sample-user.jpg" alt="Joseph Junior" class="rounded-circle">
                                    </figure>

                                    <span class="title">Joseph Junior</span>
                                    <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">

                                    <figure class="image">
                                        <img src="img/!sample-user.jpg" alt="Monica Doe" class="rounded-circle">
                                    </figure>

                                    <span class="title">Monica Doe</span>
                                    <span class="message">Lorem ipsum dolor sit.</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">

                                    <figure class="image">
                                        <img src="img/!sample-user.jpg" alt="Robert Doe" class="rounded-circle">
                                    </figure>

                                    <span class="title">Robert Doe</span>
                                    <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
                                </a>
                            </li>
                        </ul>

                        <hr>

                        <div class="text-end">
                            <a href="#" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="dropdown-toggle notification-icon" data-bs-toggle="dropdown">
                    <i class="bx bx-bell"></i>
                    <span class="badge">3</span>
                </a>

                <div class="dropdown-menu notification-menu">
                    <div class="notification-title">
                        <span class="float-end badge badge-default">3</span>
                        Alerts
                    </div>

                    <div class="content">
                        <ul>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-dislike bg-danger"></i>
                                    </div>
                                    <span class="title">Server is Down!</span>
                                    <span class="message">Just now</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-lock-alt bg-warning"></i>
                                    </div>
                                    <span class="title">User Locked</span>
                                    <span class="message">15 minutes ago</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="clearfix">
                                    <div class="image">
                                        <i class="bx bx-wifi bg-success"></i>
                                    </div>
                                    <span class="title">Connection Restaured</span>
                                    <span class="message">10/10/2023</span>
                                </a>
                            </li>
                        </ul>

                        <hr>

                        <div class="text-end">
                            <a href="#" class="view-more">View All</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

      --}}

        <span class="separator"></span>
        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{asset("assets/img/!logged-user.png")}}" alt="{{ Auth::user()->name }}"
                         class="rounded-circle" data-lock-picture="img/!logged-user.png"/>
                </figure>
                <div class="profile-info" data-lock-name="{{ Auth::user()->name }}"
                     data-lock-email="{{ Auth::user()->email }}">
                    <span class="name">{{ Auth::user()->name }}</span>
                    <span class="role">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <x-dropdown-link role="menuitem" tabindex="-1" :href="route('profile.edit')"><i
                                class="bx bx-user-circle"></i>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link role="menuitem" tabindex="-1" :href="route('logout')"
                                             onclick="event.preventDefault();
														this.closest('form').submit();">
                                <i class="bx bx-power-off"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
