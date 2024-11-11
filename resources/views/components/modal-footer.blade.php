@props([
'target' => '',
'buttonName' => 'Import'
])

<div wire:loading.remove>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
            wire:click="resetModal">Close
    </button>
    <button wire:target="{{$target}}" type="submit" class="btn btn-primary" >{{ $buttonName }}</button>
</div>
<span wire:loading><button class="btn btn-warning" disabled>Please... Wait!</button></span>
