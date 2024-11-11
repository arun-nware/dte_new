<div>
    @php
        use Carbon\Carbon;
    @endphp
    <main>
        <x-header title="Users">
            @can('user_management_create')
                <button type="button" class='btn btn-outline-primary' data-bs-toggle='modal'
                    data-bs-target='#userImportCreateModal' wire:click="resetModal"><i class='fa-solid fa-upload'></i>
                    Import User
                </button>
                <button type="button" class='btn btn-primary mx-4' data-bs-toggle='modal' data-bs-target='#userCreateModal'
                    wire:click="resetModal"><i class='fa-solid fa-add'></i> Create New User
                </button>
            @endcan
        </x-header>

        <!-- start: page -->
        <section class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-5">
                            <livewire:component.search-hospital-dropdown-component />
                        </div>
                        {{-- <div class="col-3">
                            <div class="form-group">
                                <x-input-label for="hospitals" :value="__('Hospitals')" />
                                <select wire:model="hospitals" class="form-control" id="hospitals">
                                    <option>Select</option>
                                    @foreach($hospitals as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('hospitals')" class="mt-2" />
                        </div>--}}
                        <div class="col-3">
                            <div class="form-group">
                                <x-input-label for="limit" :value="__('Inactive Users')" />
                                <div class="form-check col-md-4 mb-3">
                                    <input class="form-check-input form-control-md" type="checkbox" id="user_status"
                                        value="1" name="user_status" wire:model="user_status">
                                    {{-- <label class="form-check-label" for="user_status">Inactive Users</label>--}}
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('user_status')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <div class="btn-group">
                                <x-primary-button class="btn-primary" wire:click="filter" :active="true">Search
                                </x-primary-button>
                                <button type="button" class="btn btn-dark" wire:click="refreshModal">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2 form-inline">
                        Per Page:
                        <select wire:model="perPage" class="form-control" wire:click="filter">
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>All</option>
                        </select>
                    </div>
                    <div class="col-7">
                        <p></p>
                        @if (!empty($exports))
                            <button type="button" class="btn btn-dark float-end" wire:click="export">
                                <i class="fa fa-download"></i>
                                Excel
                            </button>
                        @endif
                    </div>
                    <div class="col-3 float-end">
                        <p></p>
                        <div class="btn-group">
                            <input wire:model.live="search" class="form-control" type="text" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    @if (Auth::user()->can('user_management_edit'))
                        <button class="btn btn-warning" wire:click="toggleActivation">Activate/Deactivate</button>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" wire:click="selectAllCheckbox" wire:model="selectAll"
                                        class="select-checkbox" style="margin-left: 15px !important;">
                                </th>
                                <th wire:click="sortBy('name')" style="cursor: pointer;">
                                    Name
                                    @include('partials._sort-icon', ['field' => 'name'])
                                </th>
                                <th> Employee Code</th>
                                <th> Mobile</th>
                                <th> Email</th>
                                <th> Hospital</th>
                                <th> Active</th>
                                <th> Last Login At</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                                        <tr>
                                                            <td class="px-4 py-2 border text-center">
                                                                @php
                                                                    // Check if the user has any of the restricted roles
                                                                    $restrictedRoles = ['Admin', 'SuperAdmin', 'Administrator'];
                                                                    $hasRestrictedRole = $item->roles->pluck('name')->intersect($restrictedRoles)->isNotEmpty();
                                                                @endphp

                                                                @if (!$hasRestrictedRole)
                                                                    <!-- Show checkbox only if the user does not have a restricted role -->
                                                                    <input type="checkbox" wire:model="selectedUsers" value="{{ $item->id }}">
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{$item->name}} <br>
                                                                <span
                                                                    class="badge badge-success">{{ $item->roles->pluck('name')->implode(', ')}}</span>
                                                            </td>

                                                            <td>{{$item->employee_code}}</td>
                                                            <td>{{$item->phone}}</td>
                                                            <td>{{$item->email}}</td>
                                                            <td>{{ $item->hospitals->hospital_name ?? $item->hospital}}</td>
                                                            <td>
                                                                @if($item->status)
                                                                    <i class="fa-regular fa-circle-check text-success fa-xl"></i>
                                                                @else
                                                                    <i class="fa-regular fa-circle-xmark text-danger fa-xl"></i>
                                                                @endif
                                                            </td>
                                                            <td>@if($item->last_login_at != NULL)
                                                                {{Carbon::parse($item->last_login_at)->format("d-m-Y H:i:s")}}
                                                            @endif
                                                            </td>
                                                            <td>{{Carbon::parse($item->created_at)->format("d-m-Y")}}</td>
                                                            <td>
                                                                <div class='btn-group'>
                                                                    @if (Auth::user()->can('user_management_edit'))
                                                                        <button type='button' class='btn btn-primary' data-bs-toggle='modal'
                                                                            data-bs-target='#userCreateModal'
                                                                            wire:click='dispatchEdit({{$item->id}})'><i
                                                                                class='fa-solid fa-pen-to-square'></i></button>
                                                                    @endif
                                                                    @if (Auth::user()->can('user_management_edit'))
                                                                        <button type='button' class='btn btn-success' data-bs-toggle='modal'
                                                                            data-bs-target='#userCreateModal'
                                                                            wire:click='dispatchView({{$item->id}})'><i
                                                                                class='fa-solid fa-eye'></i></button>
                                                                    @endif
                                                                    @if (Auth::user()->can('user_management_delete'))
                                                                        {{--<i class='btn btn-danger fa-solid fa-trash'
                                                                            wire:click='delete({{$item->id}})'></i>--}}
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <p>
                        Showing {{$users->firstItem()}} to {{$users->lastItem()}} out of {{$users->total()}} items
                    </p>
                    <p>
                        {{$users->links()}}
                    </p>
                </div>

            </div>
        </section>
        {{-- User Modal Start --}}
        <livewire:administrator.user-permission.user-create />
        {{-- User Modal End --}}

        <div wire:ignore.self class="modal fade " id="userImportCreateModal" tabindex="-1" role="dialog"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="userImportCreateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="card-title" id="userImportCreateModalLabel">Import User</h5>
                        <a href="#" class="card-action card-action-dismiss" class="close" data-dismiss="modal"
                            aria-label="Close" wire:click="resetModal"></a>
                    </div>
                    <form wire:submit.prevent="import" class="form-row" id="formID">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" wire:model="title" class="form-control"
                                            id="title">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-12 mb-4" wire:ignore>
                                    <div class="form-group">
                                        <x-input-label for="hospitalFor" :value="__('Hospitals')" />
                                        <select class="form-control populate select2" data-plugin-selectTwo
                                            data-plugin-options='{ "minimumInputLength": 2 }' wire:model="hospitalFor"
                                            id="hospitalFor">
                                            <option>Select</option>
                                            @foreach($hospitalLists as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('hospitalFor')" class="mt-2" />
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label for="customFile">Choose file</label>
                                        <input class="form-control" type="file" wire:model="file" id="customFile"
                                            name="file"
                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                wire:loading.attr="disabled" wire:click="resetModal">Close
                            </button>
                            <button type="submit" class="btn btn-primary" wire:loading.remove>Import
                            </button>
                            <span wire:loading>Processing...</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.
                    on('hide-modal', (event) => {
                        let modalView = document.querySelector('#userImportCreateModal');
                        let modal = bootstrap.Modal.getOrCreateInstance(modalView)

                        modal.hide();
                    })

            })

            document.addEventListener("livewire:initialized", () => {
                let el = $('#hospitalFor')
                initSelect()

                Livewire.hook('message.processed', (message, component) => {
                    initSelect()
                })

                Livewire.on('sethospitalFor', values => {
                    el.val(values).trigger('change.select2')
                })

                el.on('change', function (e) {
                    @this.
                        set('hospitalFor', el.select2("val"))
                })

                function initSelect() {
                    el.select2({
                        placeholder: '{{__('Select your option')}}',
                        allowClear: !el.attr('required'),
                    })
                }
            })

            document.addEventListener("livewire:initialized", () => {
                let el = $('#hospitalID')
                initSelect()

                Livewire.hook('message.processed', (message, component) => {
                    initSelect()
                })

                Livewire.on('sethospitalID', values => {
                    el.val(values).trigger('change.select2')
                })

                el.on('change', function (e) {
                    @this.
                        set('hospitalID', el.select2("val"))
                })

                function initSelect() {
                    el.select2({
                        placeholder: '{{__('Select your option')}}',
                        allowClear: !el.attr('required'),
                    })
                }
            })
        </script>
    </main>
</div>