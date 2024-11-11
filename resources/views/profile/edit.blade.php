<x-app-layout>
    <main>
        <header class="page-header">
            <h2>User Profile</h2>
        </header>

        <!-- start: page -->

        <div class="row">
            <div class="col-lg-4 col-xl-4 mb-4 mb-xl-0">

                <section class="card">
                    <div class="card-body">
                        <div class="thumb-info mb-3">
                            <img src="{{ asset('assets/img/!logged-user.png') }}" class="rounded img-fluid" alt="{{ Auth::user()->name }}">
                            <div class="thumb-info-title">
                                <span class="thumb-info-inner">{{ Auth::user()->name }}</span>
                                <span class="thumb-info-type">{{ Auth::user()->roles->pluck('name')->implode(', ') }}</span>
                            </div>
                        </div>

                        <div class="widget-toggle-expand mb-3">
                            <div class="widget-header">
                                <h5 class="mb-2 font-weight-semibold text-dark">Profile Details</h5>
                                <div class="widget-toggle">+</div>
                            </div>
                            <div class="widget-content-expanded">
                                <ul class="simple-todo-list mt-3">
                                    <li class="completed">Email : {{ Auth::user()->email }}</li>
                                    <li class="completed">Phone : {{ Auth::user()->phone }}</li>
                                </ul>
                            </div>
                        </div>
                        <hr class="dotted short">
                    </div>
                </section>
            </div>
            <div class="col-lg-8 col-xl-8">

                <div class="tabs">
                    <ul class="nav nav-tabs tabs-primary">
                        <li class="nav-item active">
                            <button class="nav-link" data-bs-target="#overview" data-bs-toggle="tab">Overview</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-target="#edit" data-bs-toggle="tab">Edit</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="overview" class="tab-pane active">

                        </div>
                        <div id="edit" class="tab-pane">
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-profile-information-form')
                                        </div>
                                    </div>

                                    <div class="p-4 mt-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-password-form')
                                        </div>
                                    </div>

                                    {{--<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                        <div class="max-w-xl">
                                            @include('profile.partials.delete-user-form')
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: page -->
    </main>

    {{--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>--}}
</x-app-layout>
