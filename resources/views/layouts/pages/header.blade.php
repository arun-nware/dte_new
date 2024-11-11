<!-- start: header -->
<header class="header header-nav-menu">
    <div class="logo-container">
        @php $appName = explode("|", $siteSetting->app_name) @endphp
        <a href="{{ route('dashboard') }}" class="float-start" >
            <img src="{{asset('app').'/'.$siteSetting->logo}}" width="70" height="70"
                 alt="@isset($appName[0]){{ $appName[0] }}@endisset"/>
        </a>
        <div class=" text-white inline align-items-center py-3 mx-3">
                <span class="text-md">@isset($appName[0])
                        {{ $appName[0] }}
                    @endisset</span>
            <br>
            <span style="font-size: 16px">@isset($appName[1])
                    {{ $appName[1] }}
                @endisset</span>
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
