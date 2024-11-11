<x-guest-layout>
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="/" class="logo float-start">
                <img src="{{asset('app').'/'.$siteSetting->logo}}" height="70" alt="Porto Admin"/>
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-end">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i
                            class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Verify OTP</h2>
                </div>
                <div class="card-body">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')"/>

                    <form method="POST" action="{{ route('otp.confirm') }}">
                        @csrf
                        <p class="mb-4">
                            {{ __('This is a secure area of the application. Please verify your OTP before continuing.') }}
                        </p>
                        <!-- OTP -->
                        <div>
                            <x-input-label for="otp" :value="__('Verity OTP')"/>

                            <x-text-input id="otp" class="block mt-1 w-full"
                                          type="text"
                                          name="otp"
                                          placeholder="XXXXXX"
                                          required autocomplete="current-password" maxlength="6" min="0" max="6"/>

                            <x-input-error :messages="$errors->get('otp')" class="mt-2"/>
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-primary-button class="btn-primary">
                                {{ __('Confirm') }}
                            </x-primary-button>

                            <a class="" href="{{ route('otp.resend') }}">
                                {{ __('Resend OTP') }}
                            </a>
                            (<small>Max 3 OTP can resend</small>)

                        </div>
                    </form>
                </div>
            </div>

            <x-footer />
        </div>
    </section>
    <!-- end: page -->
</x-guest-layout>
