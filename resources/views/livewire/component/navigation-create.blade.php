<div>
    @if($create)
        <form wire:submit.prevent="save" class="form-row" autocomplete="off">
            @else
                <form wire:submit.prevent="update" class="form-row" autocomplete="off">
                    @endif
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="nav_type" :value="__('Navigation Type')"/>
                                    <select wire:model="nav_type" class="form-control" id="nav_type">
                                        <option>Select</option>
                                        <option value="main">Main</option>
                                        <option value="nav">Nav</option>
                                        <option value="sub-nav">Sub</option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('nav_type')" class="mt-2"/>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-input-label for="nav_id" :value="__('Navigation ID')"/>
                                    <select wire:model="nav_id" class="form-control" id="nav_id">
                                        <option>Select</option>
                                        @foreach($navigationType as $type)
                                            <option value="{{ $type->id }}">{!! $type->nav_icon !!} {{ $type->nav_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('nav_id')" class="mt-2"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <x-input-label for="nav_name" :value="__('Navigation Name')"/>
                                    <x-text-input id="nav_name" type="text" class="form-control"
                                                  placeholder="Navigation Name"
                                                  wire:model="nav_name"
                                                  autofocus
                                                  autocomplete="off"/>
                                </div>
                                <x-input-error :messages="$errors->get('nav_name')" class="mt-2"/>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <x-input-label for="nav_route" :value="__('Navigation route')"/>
                                    <x-text-input id="nav_route" type="text" class="form-control"
                                                  placeholder="Navigation Route"
                                                  wire:model="nav_route"
                                                  autofocus
                                                  autocomplete="off"/>
                                </div>
                                <x-input-error :messages="$errors->get('nav_route')" class="mt-2"/>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <x-input-label for="nav_permission" :value="__('Navigation Permission')"/>
                                    <x-text-input id="nav_permission" type="text" class="form-control"
                                                  placeholder="Navigation Permission"
                                                  wire:model="nav_permission"
                                                  autofocus
                                                  autocomplete="off"/>
                                </div>
                                <x-input-error :messages="$errors->get('nav_permission')" class="mt-2"/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <div class="form-group ">
                                    <x-input-label for="nav_icon" :value="__('Navigation Icon')"/>
                                    <x-text-input id="nav_icon" type="text" class="form-control"
                                                  placeholder="Navigation Icon"
                                                  wire:model="nav_icon"
                                                  autofocus
                                                  autocomplete="off"/>
                                </div>
                                <x-input-error :messages="$errors->get('nav_icon')" class="mt-2"/>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <x-input-label for="nav_order" :value="__('Navigation Order')"/>
                                    <x-text-input id="nav_order" type="text" class="form-control"
                                                  placeholder="Navigation Order"
                                                  wire:model="nav_order"
                                                  autofocus
                                                  autocomplete="off"/>
                                </div>
                                <x-input-error :messages="$errors->get('nav_order')" class="mt-2"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                wire:loading.attr="disabled" wire:click="resetModal">Close
                        </button>
                        @if($create)
                            <button type="submit" class="btn btn-primary" wire:loading.remove>Create
                                Navigation
                            </button>

                        @else
                            <button type="submit" class="btn btn-primary" wire:loading.remove>Update
                                Navigation
                            </button>
                        @endif
                        <span wire:loading>Processing...</span>
                    </div>
                </form>
</div>
