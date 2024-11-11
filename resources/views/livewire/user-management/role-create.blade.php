<div>
    <div wire:ignore.self class="modal fade " id="userRoleModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-labelledby="roleCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="card-title" id="roleCreateModalLabel">{{ $modalTitle }}</h5>
                </div>
                @if($roleCreate)
                    <form wire:submit.prevent="save" class="form-row">
                        @else
                            <form wire:submit.prevent="update" class="form-row">
                                @endif
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="form-group col-md-12">
                                            <x-input-label for="role" :value="__('Role Name')"/>
                                            <x-text-input id="role" type="text" class="form-control"
                                                          placeholder="Role Name"
                                                          wire:model="role"
                                                          autofocus
                                                          autocomplete="role"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                                    </div>
                                    <div class="row mb-4 mx-2">
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                @foreach($permissions as $_permission)
                                                    <div class="form-check col-md-6 mb-3">
                                                        <input class="form-check-input" type="checkbox" id="{{ $_permission->name }}"
                                                               value="{{ $_permission->id }}" name="permission[]" wire:model="permission">
                                                        <label class="form-check-label" for="{{ $_permission->name }}">
                                                            {{ $_permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('permission[]')" class="mt-2"/>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:loading.attr="disabled"  wire:click="$dispatch('reset-role-modal')">Close</button>
                                    @if(!$roleView)
                                        @if($roleCreate)
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>Create Role
                                            </button>

                                        @else
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>Update Role
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
                let modalView = document.querySelector('#userRoleModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalView)

                modal.hide();
            })

        })
    </script>
</div>
