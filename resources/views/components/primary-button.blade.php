@props(['active' => false])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }} wire:loading.remove>
    {{ $slot }}
    @if($active)
        <button {{ $attributes->merge(['class' => 'btn']) }} type="button" disabled="" wire:loading>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            {{ $slot }}
        </button>
    @endif
</button>
