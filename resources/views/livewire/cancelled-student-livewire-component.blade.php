<div>
    @php
        use Carbon\Carbon;
        use App\Traits\EmployeeActivationDescription;
    @endphp
    <main>
        <x-header title="Colleges">
            @can('college_create')
                <button type="button" class='btn btn-primary mx-4' data-bs-toggle='modal'
                        data-bs-target='#employeeImportCreateModal' wire:click="resetForm"><i class='fa-solid fa-add'></i>
                    Import College
                </button>
            @endcan
        </x-header>

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

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                <input type="checkbox" wire:click="selectAllCheckbox" wire:model="selectAll"
                                       class="select-checkbox"   style="margin-left: 15px !important;">
                            </th>
                            <th>#</th>
                            <th wire:click="sortBy('course')" style="cursor: pointer;">
                                Course
                                @include('partials._sort-icon', ['field' => 'course'])
                            </th>
                            <th wire:click="sortBy('inst_name')" style="cursor: pointer;">
                                Institute Name
                                @include('partials._sort-icon', ['field' => 'inst_name'])
                            </th>
                            <th wire:click="sortBy('AICTE_code')" style="cursor: pointer;">
                                AICTE Code
                                @include('partials._sort-icon', ['field' => 'AICTE_code'])
                            </th>
                            <th> User Name</th>
                            <th> Branch Code</th>
                            <th> Branch Name</th>
                            <th> Institute Type</th>
                            <th> Intake</th>
                            <th> Total Admitted Fale</th>
                            <th> Total Admitted Female</th>
                            <th>Total Admitted</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($colleges as $item)
                            <tr wire:key="item-{{ $item->id }}">
                                <td class="px-4 py-2 border text-center">
                                    <input type="checkbox" wire:model="selectedEmployees" value="{{ $item->id }}">
                                </td>
                                <td class="px-4 py-2 border text-center">

                                    <button class="btn btn-outline-primary btn-sm"
                                            onclick="toggleListView(this, {{$item->id}})"><i
                                            class="icon_{{$item->id}} fa-solid fa-circle-plus"></i></button>
                                </td>
                                <td>{{$item->course}}</td>
                                <td>{{$item->inst_name}}</td>
                                <td>{{$item->AICTE_code}}</td>
                                <td>{{$item->user_name}}</td>
                                <td>{{$item->branch_code}}</td>
                                <td>{{$item->branch_name}}</td>
                                <td>{{$item->institute_type}}</td>
                                <td>{{$item->intake}}</td>
                                <td>{{$item->total_admitted_male}}</td>
                                <td>{{$item->total_admitted_female}}</td>
                                <td>{{$item->total_admitted}}</td>
                                <td>
                                    <div class='btn-group'>
                                        @if (Auth::user()->can('employee_management_edit'))
                                            <button type='button' class='btn btn-primary' data-bs-toggle='modal'
                                                    data-bs-target='#collegeCreateModal'
                                                    wire:click='dispatchEdit({{$item->id}})'><i
                                                    class='fa-solid fa-pen-to-square'></i></button>
                                        @endif
                                        @if (Auth::user()->can('employee_management_view'))
                                            <button type='button' class='btn btn-success' data-bs-toggle='modal'
                                                    data-bs-target='#collegeCreateModal'
                                                    wire:click='dispatchView({{$item->id}})'><i
                                                    class='fa-solid fa-eye'></i></button>
                                        @endif
                                        @if (Auth::user()->can('employee_management_delete'))
                                            {{--<i class='btn btn-danger fa-solid fa-trash'
                                                wire:click='delete({{$item->id}})'></i>--}}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr id="list-view-{{$item->id}}" class="hidden">
                                <td colspan="10" class="bg-blue-300">
                                    <ul class="mt-2">
                                        <li><b>Institute Count. :</b>{{$item->inst_count}}</li>
                                        <li><b>Total ST Seats. :</b>{{$item->total_st_seats}}</li>
                                        <li><b>Total SC Seats. :</b>{{$item->total_sc_seats}}</li>
                                        <li><b>Total OBC Seats. :</b>{{$item->total_obc_seats}}</li>
                                        <li><b>Total UR Seats. :</b>{{$item->total_ur_seats}}</li>
                                        <li><b>Total UR Seats. :</b>{{$item->total_ur_seats}}</li>
                                        <li><b>NRI Seats. :</b>{{$item->nri_seats}}</li>
                                        <li><b>IPS Seats. :</b>{{$item->ips_seats}}</li>
                                        <li><b>FW Seats. :</b>{{$item->fw_seats}}</li>
                                        <li><b>FW Adimission. :</b>{{$item->fw_admission}}</li>
                                        <li><b>EWS Seats. :</b>{{$item->ews_seats}}</li>
                                        <li><b>EWS Adimission. :</b>{{$item->ews_admission}}</li>
                                        <li><b>EWS Seats. :</b>{{$item->ai_jk_resident_seats}}</li>
                                        <li><b>EWS Adimission. :</b>{{$item->ai_jk_migrants_seats}}</li>
                                        <li><b>EWS Adimission. :</b>{{$item->intake_with_ews}}</li>
                                        <li><b>ST Female Admitted. :</b>{{$item->st_female_admitted}}</li>
                                        <li><b>ST Male Admitted. :</b>{{$item->st_male_admitted}}</li>
                                        <li><b>Total ST Admitted. :</b>{{$item->total_st_admitted}}</li>
                                        <li><b>SC Female Admitted. :</b>{{$item->sc_female_admitted}}</li>
                                        <li><b>SC Male Admitted. :</b>{{$item->sc_male_admitted}}</li>
                                        <li><b>Total SC Admitted. :</b>{{$item->total_sc_admitted}}</li>
                                        <li><b>OBC Female Admitted. :</b>{{$item->obc_female_admitted}}</li>
                                        <li><b>OBC Male Admitted. :</b>{{$item->obc_male_admitted}}</li>
                                        <li><b>Total OBC Admitted. :</b>{{$item->total_obc_admitted}}</li>
                                        <li><b>UR Female Admitted. :</b>{{$item->ur_female_admitted}}</li>
                                        <li><b>UR Male Admitted. :</b>{{$item->ur_male_admitted}}</li>
                                        <li><b>Total UR Admitted. :</b>{{$item->total_ur_admitted}}</li>
                                        <li><b>Year. :</b>{{$item->year}}</li>

                                        <li><b>Create At :</b>{{Carbon::parse($item->created_at)->format("d-m-Y")}}</li>

                                        <!-- Add more list items as needed -->
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <p>
                        Showing {{$colleges->firstItem()}} to {{$colleges->lastItem()}} out of {{$colleges->total()}}
                        items
                    </p>
                    <p>
                        {{$colleges->links()}}
                    </p>
                </div>
            </div>
        </section>

        <div wire:ignore.self class="modal fade " id="employeeImportCreateModal" tabindex="-1" role="dialog"
             data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="hospitalCreateModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="card-title" id="employeeImportModalLabel">Import Employee</h5>
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
                            <button type="submit" class="btn btn-primary" wire:loading.remove>Import Employee
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
                let modalView = document.querySelector('#employeeImportCreateModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalView)

                modal.hide();
            })

            })
        </script>

    </main>
    <script>
        function toggleListView(button, id) {
            const listView = document.getElementById("list-view-" + id);
            ;
            console.log(listView)
            listView.classList.toggle('hidden');
            var icon = document.getElementsByClassName("icon_" + id);
            if (button.firstElementChild.classList.contains('fa-circle-plus')) {
                button.firstElementChild.classList.remove('fa-circle-plus');
                button.firstElementChild.classList.toggle('fa-circle-minus');
            } else {
                button.firstElementChild.classList.remove('fa-circle-minus');
                button.firstElementChild.classList.toggle('fa-circle-plus');
            }
        }
    </script>
</div>
