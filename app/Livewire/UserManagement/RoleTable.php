<?php

namespace App\Livewire\Administrator\UserPermission;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RoleTable extends DataTableComponent
{
    use LivewireAlert;
    protected $model = Role::class;

    protected $listeners = [
        'confirmedDelete'
    ];

    public $roleId;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->searchable()->sortable(),
            Column::make("Permissions")->label(function ($row){
                $html = '';
                foreach ($row->permissions->pluck('name') as $name)
                {
                    $html .= "<span class='badge badge-info text-dark'> $name </span> ";
                }
                return $html;
            })->searchable()->sortable()->html(),

            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make('Action')->label(function ($row) {
                $edit = "<div class='btn-group'>";
                if (Auth::user()->can('access_management_edit')) {
                    $edit .= "<i type='button' class='btn btn-primary fa-solid fa-pen-to-square' data-bs-toggle='modal' data-bs-target='#userRoleModal' wire:click='dispatchEdit($row->id)'></i>";
                }
                if (Auth::user()->can('access_management_view')) {
                    $edit .= "<i type='button' class='btn btn-success fa-solid fa-eye' data-bs-toggle='modal' data-bs-target='#userRoleModal' wire:click='dispatchView($row->id)'></i>";
                }
                if (Auth::user()->can('access_management_delete')) {
                    $edit .= "<i class='btn btn-danger fa-solid fa-trash'' wire:click='delete($row->id)'></i>";
                }
                $edit .= "</div>";
                return $edit;
            })->html()
        ];
    }
    public function builder(): Builder
    {
        $loggedInUser = Auth::user();
        if ($loggedInUser->hasAnyRole(['SuperAdmin'])) {
            return Role::query()
                ->with('permissions')
                ->select();
        } else {
            return Role::query()
                ->with('permissions')
                ->whereNotIn('name', ['SuperAdmin'])
                ->select();
        }
    }

    public function delete($id)
    {
        $this->roleId = $id;
        $this->alert('question', 'Are you sure , You want to delete this role?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);

    }

    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $role = Role::find($this->roleId);
        $role->delete();

        $role->syncPermissions([]);
        $this->alert('success', 'Role Deleted Successfully');
    }

    public function dispatchEdit($id)
    {
        $this->dispatch('role-edit', id: $id);
    }

public function dispatchView($id)
    {
        $this->dispatch('role-view', id: $id);
    }

    public function resetModal()
    {
        $this->dispatch('reset-role-modal');
    }
}
