{{--<div class="preloader flex-column justify-content-center align-items-center">
    @if(isset($siteSetting->favicon) && $siteSetting->favicon != '')
        <img class="animation__shake" src="{{ asset('app').'/'.$siteSetting->favicon ?? asset('assets/img/favicon.png') }}" alt="{{ $siteSetting->favicon ?? config('app.APP_NAME') }}" height="60"
             width="60">
    @else
        <div class="loading-overlay">
            <div class="bounce-loader">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    @endif

</div>--}}
<div wire:loading>
    <div style="display: flex; justify-content: center; align-items: center;
            background-color: #0a0a0a; opacity: .75; position: fixed; left: 0; top: 0; z-index: 9999; width: 100%; height: 100%;">
        <div class="lds-facebook"><div></div><div></div><div></div></div>
    </div>
</div>
