<div>
    <div wire:ignore.self class="modal fade " id="userCreateModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
         data-bs-keyboard="false"
         aria-labelledby="userCreateModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="card-title" id="userCreateModalLabel">{{ $modalTitle }}</h5>
                </div>
                @if($create)
                    <form wire:submit.prevent="save" class="form-row">
                        @else
                            <form wire:submit.prevent="update" class="form-row">
                                @endif
                                <div class="modal-body" >
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="first_name" :value="__('First Name')"/>
                                                <x-text-input id="first_name" type="text" class="form-control"
                                                              placeholder="First Name"
                                                              wire:model="first_name"
                                                              autocomplete="first_name"/>
                                                <x-input-error :messages="$errors->get('first_name')"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="last_name" :value="__('Last Name')"/>
                                                <x-text-input id="last_name" type="text" class="form-control"
                                                              placeholder="Last Name"
                                                              wire:model="last_name"
                                                              autocomplete="last_name"/>
                                                <x-input-error :messages="$errors->get('last_name')"/>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="email" :value="__('Email')"/>
                                            <x-text-input id="email" type="email" class="form-control "
                                                          placeholder="Email"
                                                          wire:model.alive="email"
                                                          autocomplete="email"/>
                                            <x-input-error :messages="$errors->get('email')"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-label for="phone" :value="__('Phone')"/>
                                            <x-text-input id="phone" type="text" class="form-control"
                                                          placeholder="Phone"
                                                          wire:model="phone"
                                                          onkeypress="onlyNumberKey(event, this)"
                                                          autocomplete="off"
                                                          maxLength="10"/>
                                            <x-input-error :messages="$errors->get('phone')"/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <x-input-label for="role" :value="__('Role')"/>
                                            <select class="form-control" wire:model="role" id="role">
                                                <option value="">Select</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('role')"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-label for="limit" :value="__('Active')"/>
                                            <div class="form-check col-md-4 mb-3">
                                                <input class="form-check-input form-control-md" type="checkbox"
                                                       id="status"
                                                       value="1" name="status" wire:model="status">
                                                {{--<label class="form-check-label" for="user_status">Inactive Users</label>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="designation" :value="__('Designation')"/>
                                            <select class="form-control" wire:model="designation" id="designation">
                                                <option value="">Select</option>
                                                @foreach($designations as $designation)
                                                    <option
                                                        value="{{ $designation->designation_code }}">{{ $designation->designation_name }}
                                                        - {{ $designation->designation_code }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('designation')"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-label for="employee_code" :value="__('Employee Code')"/>
                                            <x-text-input id="employee_code" type="text" class="form-control"
                                                          placeholder="Employee Code"
                                                          wire:model="employee_code"
                                                          autocomplete="off"/>
                                            <x-input-error :messages="$errors->get('employee_code')"/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <x-input-label for="medical_college_id" :value="__('Medical College')"/>
                                            <select class="form-control" wire:model="medical_college_id"
                                                    id="medical_college_id" wire:click="changeHospital">
                                                <option value="">Select</option>
                                                @foreach($medicalColleges as $college)
                                                    <option
                                                        value="{{ $college->id }}">{{ $college->medical_college_name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('medical_college_id')"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-label for="hospital" :value="__('Hospital')"/>
                                            <select class="form-control" wire:model="hospital"
                                                    id="hospitals" wire:click="changeHospital">
                                                <option value="">Select</option>
                                                <option value="All">All</option>
                                                @foreach($hospitals as $hospital)
                                                    <option
                                                        value="{{ $hospital->hospital_code }}">{{ $hospital->hospital_name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('hospital')"/>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <x-input-label for="password" :value="__('Password')"/>
                                            <x-text-input id="password" type="password"
                                                          class="form-control"
                                                          placeholder="Password"
                                                          wire:model="password"
                                                          autocomplete="off"/>
                                            <x-input-error :messages="$errors->get('password')"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-label for="password_confirmation"
                                                           :value="__('Confirm Password')"/>
                                            <x-text-input id="password_confirmation" type="password"
                                                          class="form-control"
                                                          placeholder="Confirm Password"
                                                          wire:model="password_confirmation"

                                                          autocomplete="off"/>
                                            <x-input-error :messages="$errors->get('password_confirmation')"/>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            wire:loading.attr="disabled" wire:click="resetModal">Close
                                    </button>
                                    @if(!$view)
                                        @if($create)
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>Create
                                                User
                                            </button>

                                        @else
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>Update
                                                User
                                            </button>
                                        @endif
                                        <span wire:loading>Processing...</span>
                                    @endif
                                </div>
                            </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.
            on('hide-modal', (event) => {
                let modalView = document.querySelector('#userCreateModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalView)

                modal.hide();
            })

        })

        document.addEventListener("livewire:initialized", () => {

            let el = $("#hospital")

            initSelect()

            Livewire.hook('message.processed', (message, component) => {
                initSelect()
            })

            Livewire.on('setHospital', values => {
                el.val(values).trigger('change.select2')
            })

            el.on('change', function (e) {
                @this.
                set('hospital', el.select2("val"))
            })

            function initSelect() {

                /*  $('.select2').each(function() {
                      $(this).select2({
                          placeholder: '{{__('Select your option')}}',
                        allowClear: !el.attr('required'),
                        theme: "bootstrap-5",
                        dropdownParent: $(this).parent(), // fix select2 search input focus bug
                    })
                })*/

                el.select2({
                    placeholder: '{{__('Select your option')}}',
                    allowClear: !el.attr('required'),
                    theme: "bootstrap-5",
                    dropdownParent: $(this).parent(),
                })

                // fix select2 bootstrap modal scroll bug
                $(document).on('select2:close', '.select2', function (e) {
                    var evt = "scroll.select2"
                    $(e.target).parents().off(evt)
                    $(window).off(evt)
                })

            }
        })
    </script>
    @push('scripts')
        <script>
            /* $(document).ready(function() {
                 $(".select2").select2({
                     dropdownParent: $("#userCreateModal")
                 });
                 console.log(12312)
             });*/
        </script>
    @endpush
</div>
