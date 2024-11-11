<div>
    <x-header title="Navigation">

    </x-header>

    <!-- start: page -->
    <section class="card">
        <div class="card-body">
            <livewire:datatable.navigation-table />
        </div>
    </section>
    <x-modal modelId="navigationModal" title="{{ $modalTitle }}">
        @includeIf('livewire.component.navigation-create')
    </x-modal>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('hide-navigation-modal', (event) => {
                let modalView = document.querySelector('#navigationModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalView)
                console.log(123123)
                modal.hide();
                setTimeout(function () {
                    @this.dispatch('reset-navigation-modal');
                }, 2000)
            })

        })

    </script>
</div>