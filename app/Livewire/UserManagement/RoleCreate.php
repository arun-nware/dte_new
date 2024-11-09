<?php

namespace App\Livewire\UserManagement;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Permission;
use App\Models\Role;

class RoleCreate extends Component
{
    use LivewireAlert;

    public bool $roleCreate = True;
    public bool $roleView = False;
    public string $modalTitle = "Role Create";

    #[Rule('required|string|max:255|unique:roles,name')]
    public $role;

    #[Rule('required|max:255')]
    public $permission = [];


    public $permissions;
    public $roleData;

    public function render()
    {
        $permissions = Permission::all();
        $this->permissions = $permissions;

        return view('livewire.user-management.role-create', compact('permissions'));
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            $role = Role::create([
                "name" => ucwords($this->role),
                "gaurd_name" => "web"
            ]);
            $permissions = Permission::whereIn('id', $this->permission)->get();

            if (!empty($this->permission)) {
                $role->syncPermissions($permissions);
            }

            $this->alert('success', 'Role Created Successfully');
            $this->reset();
            $this->dispatch('hide-modal');
            $this->dispatch('refreshDatatable');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('role-edit')]
    public function edit($id)
    {
        $this->roleCreate = false;
        $this->modalTitle = "Role Edit";
        $role = Role::with('permissions')->where('id', $id)->first();
        $this->roleData = $role;
        $this->role = $this->roleData->name;
        $this->permission = $this->roleData->permissions->pluck('id')->toArray();
    }

    #[On('role-view')]
    public function view($id)
    {
        $this->roleCreate = false;
        $this->roleView = true;
        $this->modalTitle = "Role View";
        $role = Role::with('permissions')->where('id', $id)->first();
        $this->roleData = $role;
        $this->role = $this->roleData->name;
        $this->permission = $this->roleData->permissions->pluck('id')->toArray();
    }

    public function update()
    {
        try {
            $validated = Validator::make([
                'name' => $this->role,
                'permission' => $this->permission,
            ],
                [
                    'name' => ['required', 'max:255', \Illuminate\Validation\Rule::unique('roles')->ignore($this->roleData->id)],
                    'permission' => ['required'],
                ])->validate();


            $this->roleData->update(['name' => ucwords($this->role)]);

            $permissions = Permission::whereIn('id', $this->permission)->get();

            if (!empty($this->permission)) {
                $this->roleData->syncPermissions($permissions);
            }

            $this->dispatch('hide-modal');
            $this->dispatch('refreshDatatable');
            $this->resetModal();
            $this->alert('success', 'Role Updated Successfully.');

        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('reset-role-modal')]
    public function resetModal()
    {
        $this->reset();
        $this->dispatch('hide-modal');
        $this->resetErrorBag();
    }
}
