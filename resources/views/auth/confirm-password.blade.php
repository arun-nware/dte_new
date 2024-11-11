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
                            class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Confirm Password</h2>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <p class="mb-4">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </p>
                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')"/>

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="current-password"/>

                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-primary-button>
                                {{ __('Confirm') }}
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
