@props([
'maxWidth' => 'lg',
'title',
'modelId',
'create' => true,
'formEnable' => true,
'componentName' => 'Create'
])

@php
    $maxWidth = [
        'sm' => 'modal-sm',
        'md' => 'modal-md',
        'lg' => 'modal-lg',
        'xl' => 'modal-xl',
        '2xl' => 'modal-2xl',
    ][$maxWidth];
@endphp

<div wire:ignore.self class="modal fade " id="{{ $modelId }}" tabindex="-1" role="dialog"
     data-bs-backdrop="static" data-bs-keyboard="false"
     aria-labelledby="{{ $modelId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ $maxWidth }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="card-title" id="{{ $modelId }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($formEnable)
                    @if($create)
                        <form wire:submit.prevent="save" class="form-row">
                            @else
                                <form wire:submit.prevent="update" class="form-row">
                                    @endif
                                    @endif
                                    {{ $slot }}

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                wire:loading.attr="disabled" wire:click="$dispatch('reset-role-modal')">
                                            Close
                                        </button>
                                        @if($create)
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>
                                                Create {{ $componentName }}
                                            </button>

                                        @else
                                            <button type="submit" class="btn btn-primary" wire:loading.remove>
                                                Update {{ $componentName }}
                                            </button>
                                        @endif
                                        <span wire:loading>Processing...</span>
                                    </div>
                                    @if($formEnable)
                                </form>
                    @endif
            </div>
        </div>
    </div>
</div>

