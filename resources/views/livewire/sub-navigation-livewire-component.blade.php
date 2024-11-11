<div>
    <div>
        <main>
            <header class="page-header">
                <h2>Sub Navigation</h2>
            </header>
        </main>

        <!-- start: page -->
        <section class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nav Name</th>
                        <th>Nav Route</th>
                        <th>Nav Permission</th>
                        <th>Nav Icon</th>
                        <th>Nav Order</th>
                        <th>Sub Nav List</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($navigations as $navigation)
                        <tr>
                            <td>{{ $navigation->id }}</td>
                            <td>{{ $navigation->nav_name }}</td>
                            <td>{{ $navigation->nav_route }}</td>
                            <td>{{ $navigation->nav_permission }}</td>
                            <td>{{ $navigation->nav_icon }}</td>
                            <td>{{ $navigation->nav_order }}</td>
                            <td>
                                @if ($navigation->navigation->count())
                                    <a href='{{ route('sub.navigations', $navigation->id) }}'
                                       class='fa-regular fa-eye mx-1 text-primary'></a>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->can('navigation_edit'))
                                    <a href="#" class='fa-solid fa-pen-to-square mx-1 text-success' data-bs-toggle='modal'
                                       data-bs-target='#navigationModal' wire:click='dispatchEdit({{$navigation->id}})'></a>
                                @endif
                                @if (Auth::user()->can('navigation_delete'))
                                    <i class='fa-solid fa-trash mx-1 text-danger link'
                                       wire:click='delete({{$navigation->id}})'></i>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
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
