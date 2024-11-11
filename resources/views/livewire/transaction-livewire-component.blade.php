<div>
    @php
        use Carbon\Carbon;
        use App\Traits\EmployeeActivationDescription;
    @endphp
    <main>
        <x-header title="Transactions">
            @can('transaction_create')
                <button type="button" class='btn btn-primary mx-4' data-bs-toggle='modal'
                        data-bs-target='#transactionImportCreateModal' wire:click="resetForm"><i class='fa-solid fa-add'></i>
                    Import Transaction
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
                            <th wire:click="sortBy('course')" style="cursor: pointer;">
                                Course
                                @include('partials._sort-icon', ['field' => 'course'])
                            </th>
                            <th wire:click="sortBy('course_name')" style="cursor: pointer;">
                                Course Name
                                @include('partials._sort-icon', ['field' => 'course_name'])
                            </th>
                            <th wire:click="sortBy('round')" style="cursor: pointer;">
                                Round
                                @include('partials._sort-icon', ['field' => 'round'])
                            </th>
                            <th>Counselling Round</th>
                            <th>Roll No</th>
                            <th>Counselling Activity</th>
                            <th>Transaction ID</th>
                            <th>Transaction Date</th>
                            <th>Transaction Amount</th>
                            <th>Amount</th>
                            <th>Remark</th>
                            <th>Paid Status</th>
                            <th>Cancelled Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $item)
                            <tr wire:key="item-{{ $item->id }}">
                                <td>{{$item->course}}</td>
                                <td>{{$item->course_name}}</td>
                                <td>{{$item->round}}</td>
                                <td>{{$item->counselling_round}}</td>
                                <td>{{$item->counselling_id_roll_no}}</td>
                                <td>{{$item->counselling_activity}}</td>
                                <td>{{$item->trans_id}}</td>
                                <td>{{$item->transaction_date}}</td>
                                <td>{{$item->transaction_amount}}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{$item->remark}}</td>
                                <td>{{$item->paid_status}}</td>
                                <td>{{$item->cancelled_status}}</td>
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

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <p>
                        Showing {{$transactions->firstItem()}} to {{$transactions->lastItem()}} out of {{$transactions->total()}}
                        items
                    </p>
                    <p>
                        {{$transactions->links()}}
                    </p>
                </div>
            </div>
        </section>

        <div wire:ignore.self class="modal fade " id="transactionImportCreateModal" tabindex="-1" role="dialog"
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
                let modalView = document.querySelector('#transactionImportCreateModal');
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
