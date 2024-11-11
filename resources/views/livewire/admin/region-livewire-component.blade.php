<div>
    <x-header title="Region">
        @can('role_create')
            <button type="button" class='btn btn-primary mx-4' data-bs-toggle='modal'
                    data-bs-target='#regionModal' wire:click="$dispatch('reset-role-modal')"><i
                    class='fa-solid fa-add'></i> Create {{ $componentName }}
            </button>
        @endcan
    </x-header>

    <!-- start: page -->
    <section class="card">
        <div class="card-body">
            <livewire:datatable.region-table/>
        </div>
    </section>
    <x-modal modelId="regionModal" title="{{ $modalTitle }}">
        @if($create)
            <form wire:submit.prevent="save" class="form-row">
                @else
                    <form wire:submit.prevent="update" class="form-row">
                        @endif
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-input-label for="name" :value="__('Region Name')"/>
                                        <x-text-input id="name" type="text" class="form-control"
                                                      placeholder="Region Name"
                                                      wire:model="name"
                                                      autofocus
                                                      autocomplete="off"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <x-input-label for="code" :value="__('Region Code')"/>
                                        <x-text-input id="code" type="text" class="form-control"
                                                      placeholder="Region Code"
                                                      wire:model="code"
                                                      autofocus
                                                      autocomplete="off"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('code')" class="mt-2"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:loading.attr="disabled"  wire:click="$dispatch('reset-role-modal')">Close</button>
                            @if($create)
                                <button type="submit" class="btn btn-primary" wire:loading.remove>Create {{ $componentName }}
                                </button>

                            @else
                                <button type="submit" class="btn btn-primary" wire:loading.remove>Update {{ $componentName }}
                                </button>
                            @endif
                            <span wire:loading>Processing...</span>
                        </div>
                    </form>
    </x-modal>
    <script>
        document.addEventListener('livewire:initialized', () => {
        @this.on('hide-region-modal', (event) => {
            let modalView = document.querySelector('#regionModal');
            let modal = bootstrap.Modal.getOrCreateInstance(modalView)
            modal.hide();
            setTimeout(function () {
            @this.dispatch('reset-region-modal')
                ;
            }, 2000)
        })

        })

    </script>
</div>
