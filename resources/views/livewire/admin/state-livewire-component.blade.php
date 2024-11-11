<div>
    <x-header title="State">
        @can('state_create')
            <button type="button" class='btn btn-primary mx-4' data-bs-toggle='modal'
                    data-bs-target='#stateModal' wire:click="$dispatch('reset-modal')"><i
                    class='fa-solid fa-add'></i> Create {{ $componentName }}
            </button>
        @endcan
    </x-header>

    <!-- start: page -->
    <section class="card">
        <div class="card-body">
            <livewire:datatable.state-table/>
        </div>
    </section>
    <div wire:ignore.self class="modal fade " id="stateModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
         data-bs-keyboard="false"
         aria-labelledby="userCreateModalLabel" aria-hidden="true">
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
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <x-input-label for="name" :value="__('State Name')"/>
                                                <x-text-input id="name" type="text" class="form-control"
                                                              placeholder="State Name"
                                                              wire:model="name"
                                                              autofocus
                                                              autocomplete="off"/>
                                            </div>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <x-input-label for="code" :value="__('State Code')"/>
                                                <x-text-input id="code" type="text" class="form-control"
                                                              placeholder="State Code"
                                                              wire:model="code"
                                                              autofocus
                                                              autocomplete="off"/>
                                            </div>
                                            <x-input-error :messages="$errors->get('code')" class="mt-2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            wire:loading.attr="disabled" wire:click="resetModal">Close
                                    </button>
                                    @if(!$view)
                                        @if($create)
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>Create
                                                State
                                            </button>

                                        @else
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>Update
                                                State
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
        @this.on('hide-modal', (event) => {
            let modalView = document.querySelector('#stateModal');
            let modal = bootstrap.Modal.getOrCreateInstance(modalView)
            modal.hide();
        })

        })

    </script>
</div>
