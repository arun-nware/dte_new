<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="/" class="logo float-start">
                <img src="{{asset('app').'/'.$siteSetting->logo}}" height="70" alt="Porto Admin"/>
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-end">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i
                            class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Reset Password</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                          :value="old('email', $request->email)" required autofocus
                                          autocomplete="username"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')"/>
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                          required autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password"/>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="btn-primary">
                                {{ __('Reset Password') }}
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
