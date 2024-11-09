<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

#[Title('Users')]
class UserTable extends DataTableComponent
{
    use LivewireAlert;

    protected $model = User::class;

    protected $listeners = [
        'confirmedDelete'
    ];

    public string $userId;
    public string $title = "Users";

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
            Column::make("Username", "username")
                ->searchable()->sortable(),
            Column::make("Email", "email")
                ->searchable()->sortable(),
            Column::make("Phone", "phone")
                ->searchable()->sortable(),
            Column::make("Role")->label(fn($row) =>  $row->roles->pluck('name')->implode(', '))
                ->searchable()->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make('Action')->label(function($row){
                $edit = "<div class='d-flex justify-content-between'>";
                if (Auth::user()->can('role_edit')) {
                    $edit .= "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#userCreateModal' wire:click='dispatchEdit($row->id)'><i class='fa-solid fa-pen-to-square'></i></button>";
                }
                if (Auth::user()->can('role_delete')) {
                    $edit .= "<button type='button' class='btn btn-danger mx-2' wire:click='delete($row->id)'><i class='fa-solid fa-trash'></i></button>";
                }
                $edit .= "</div>";
                return $edit;
            })->html()
        ];
    }

    public function builder(): Builder
    {
        return User::query()
            ->with('roles')
            ->select(); // Eager load anything
    }

    public function delete($id)
    {
        $this->userId = $id;
        $this->alert('question', 'Are you sure , You want to delete this user?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);

    }

    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $user = User::find($this->userId);
        $user->delete();

        $this->alert('success', 'User Deleted Successfully');
    }

    public function dispatchEdit($id)
    {
        $this->dispatch('user-edit', id: $id);
    }

    public function resetModal()
    {
        $this->dispatch('reset-user-modal');
    }
}
