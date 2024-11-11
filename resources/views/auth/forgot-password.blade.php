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
                <div class="card-body" style="color: #595959">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')"/>
                    <h2 class="title text-uppercase font-weight-bold m-0">Forgot Password</h2>

                    <h4 class="mb-4">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </h4>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="btn-primary">
                                {{ __('Email Password Reset Link') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <x-footer />
        </div>
    </section>
    <!-- end: page -->
</x-guest-layout>

