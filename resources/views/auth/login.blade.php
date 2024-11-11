<x-guest-layout>

    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <div class="login-page-logo">
                <a href="/">

                    <img src="{{asset('app') . '/' . $siteSetting->logo}}" height="70" alt="Porto Admin" />
                </a>
                @php $appName = explode("|", $siteSetting->app_name) @endphp
                <h2 class="login-page-hading m-0 mt-3">@isset($appName[0]){{ $appName[0] }}@endisset</h2>
                <h3 class="login-page-hading m-0 mb-2">@isset($appName[1]){{ $appName[1] }}@endisset</h3>
            </div>

            <div class="panel card-sign">
                <!-- <div class="card-title-sign mt-3 text-end">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i
                            class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Sign In</h2>
                </div> -->
                <div class="card-body">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />


                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="input-group">
                                <x-text-input id="email" class="form-control form-control-lg" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <div class="clearfix">
                                <x-input-label class="float-start" for="password" :value="__('Password')" />

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="float-end">{{ __('Forgot your password?') }}</a>
                                @endif

                            </div>
                            <div class="input-group">
                                <x-text-input id="password" class="form-control form-control-lg" type="password"
                                    name="password" required autocomplete="current-password" />
                                <span class="input-group-text">
                                    <i class="bx bx-lock text-4"></i>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="remember" name="remember" type="checkbox" />
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-end">
                                <x-primary-button class="btn btn-primary mt-2">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <x-footer />
        </div>
    </section>
    <!-- end: page -->
</x-guest-layout>
