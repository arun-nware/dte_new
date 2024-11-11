<div>
    <main>
        <header class="page-header">
            <h2>Site Setting</h2>
        </header>

        <!-- start: page -->
        <section class="card">
            <div class="card-body">
                <form class="p-3" wire:submit="update({{$siteSetting->id ?? ''}})">
                    <div class="row mb-4">
                        <div class="form-group col-md-6">
                            @php
                                $appName = $siteSetting->app_name ?? old('app_name');
                            @endphp
                            <x-input-label for="application_name" :value="__('Application Name')"/>
                            <x-text-input id="application_name" type="text" class="form-control"
                                          placeholder="Application Name"
                                          wire:model="app_name" :value="$appName" required autofocus
                                          autocomplete="app_name"/>
                            <x-input-error :messages="$errors->get('app_name')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            @php
                                $copyright =  $siteSetting->copyright ?? old('copyright');
                            @endphp
                            <x-input-label for="copyright" :value="__('Copyright')"/>
                            <x-text-input id="copyright" type="text" class="form-control" placeholder="Copyright"
                                          wire:model="copyright" :value="$copyright" required autofocus
                                          autocomplete="copyright"/>
                            <x-input-error :messages="$errors->get('copyright')" class="mt-2"/>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-md-6">
                            <x-input-label for="application_name" :value="__('Timezone')"/>
                            <select id="timezone" wire:model="time_zone" class="form-control">
                                @foreach($allTimeZone as $region => $list)
                                    <optgroup label="{{ $region }}">
                                        @foreach($list as $timezone => $name)
                                            <option value="{{ $timezone }}" @if($timezone == $siteSetting->time_zone)
                                                {{ 'selected' }}
                                                @endif>{{ $name }}</option>
                                        @endforeach
                                        <optgroup>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('time_zone')" class="mt-2"/>
                        </div>
                        <div class="col-md-6  pt-0">
                            <x-input-label for="financial_year" :value="__('Financial Year')"/>
                            <select id="financial_year" wire:model="financial_year" class="form-control">
                                @php
                                    $cYear = date("Y");
                                    $cMonth = date("m");

                                    $finYear = trim($siteSetting->financial_year);

                                    $currentYear = $cYear - 1;
                                @endphp

                                @for ($i = 2012; $i <= $cYear; $i++)
                                    @php
                                        $selected = ""; @endphp

                                    @if (!isset($finYear))

                                        @if ($i == $currentYear && $cMonth <= 4)
                                            @php
                                                $selected = "selected"; @endphp

                                        @elseif ($i == $cYear && $cMonth >= 5)
                                            @php
                                                $selected = "selected"; @endphp

                                        @endif

                                    @else
                                        {

                                        @if ($i == $finYear)
                                            @php $selected = "selected"; @endphp
                                        @endif

                                    @endif


                                    <option value="{{ $i }}" {{ $selected }}>{{ $i . "-" . ($i + 1) }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('time_zone')" class="mt-2"/>

                        </div>
                    </div>
                    <div class="row form-group ">
                        <div class="col-md-6 ">
                            <x-input-label for="favicon" :value="__('Favicon')"/>
                            <input class="form-control" type="file" id="favicon" wire:model="favicon"
                                   value="{{ old('favicon') }}" autofocus
                                   autocomplete="favicon" accept="image/png, image/gif, image/jpeg">
                            <x-input-error :messages="$errors->get('favicon')" class="mt-2"/>
                            @if ($favicon)
                                <img src="{{ $favicon->temporaryUrl() }}" width="120px">
                            @else
                                <img src="{{asset('app').'/'.$siteSetting->favicon}}" width="120px">

                            @endif
                        </div>
                        <div class="form-group col-md-6 ">
                            <x-input-label for="logo" :value="__('Logo')"/>
                            <input class="form-control" type="file" id="logo" wire:model="logo"
                                   value="{{ old('logo') }}" autofocus
                                   autocomplete="logo" accept="image/png, image/gif, image/jpeg">
                            <x-input-error :messages="$errors->get('logo')" class="mt-2"/>

                            @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" width="120px">
                            @else
                                <img src="{{asset('app').'/'.$siteSetting->logo}}" width="120px">
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-end mt-3">
                            <button class="btn btn-primary modal-confirm">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </main>
</div>
