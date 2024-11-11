<div>
    @php
        use Carbon\Carbon;
        use App\Enums\PaymentFileProcessEnums;
    @endphp
    <main>
        <header class="page-header">
            <h2>Roles</h2>

            @can('access_management_create')
                <div class="right-wrapper text-end">
                    <ol class="breadcrumbs">
                        <li>
                            <button type="button" class='btn btn-primary mx-4' data-bs-toggle='modal'
                                    data-bs-target='#userRoleModal' wire:click="$dispatch('reset-role-modal')"><i
                                    class='fa-solid fa-add'></i> Create Role
                            </button>
                        </li>
                    </ol>
                </div>
            @endcan
        </header>

        <!-- start: page -->
        <section class="card">
            <div class="card-body">
                <livewire:administrator.user-permission.role-table/>
            </div>
        </section>
        {{--   User Modal Start    --}}
        <livewire:administrator.user-permission.role-create/>
        {{--   User Modal End    --}}
    </main>
</div>
