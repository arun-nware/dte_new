<?php

namespace App\Livewire\UserManagement;

use App\Models\FileUploadRecord;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserListLivewireComponent extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;

    #[Url]
    public $sortBy = 'id';

    #[Url]
    public $sortDirection = 'desc';
    #[Url]
    public $perPage = 25;
    #[Url]
    public $search = '';
    #[Url]
    public $hospital;
    public $hospitalID;
    public $hospitalLists;
    public bool $exports = false;
    #[Url]
    public bool $user_status = false;

    public $hospitalFor;
    public $title;
    public $file;
    public $selectAll = false;
    public $selectedUsers = [];
    public function render()
    {
        $users = $this->builder();
        return view('livewire.user-management.user-list-livewire-component', compact('users'));
    }

    #[On('refreshParent')]
    public function builder()
    {
        $page = $this->perPage == "All" ? -1 : intval($this->perPage);

        $query =  User::query()
            ->with('hospitals')
            ->when($this->hospitalID, function ($query) {
                $query->whereHas('hospitals', function ($query) {
                    $query->where('hospital_code', $this->hospitalID);
                });
            })
            ->when($this->user_status, function ($query) {
                $query->where('status', $this->user_status);
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%$this->search%");
                $query->orWhere('phone', 'like', "%$this->search%");
                $query->orWhere('email', 'like', "%$this->search%");
            })
            ->select()
            ->orderBy($this->sortBy, $this->sortDirection);
            if ($this->perPage == "All") {
                $results = $query->get();
                return new \Illuminate\Pagination\LengthAwarePaginator($results, $results->count(), -1);
            }
        return $query->paginate($page);;
    }

    #[On('reset-user-modal')]
    public function resetModal()
    {
        $this->dispatch('$refresh');
        $this->dispatch('hide-modal');
        $this->resetErrorBag();
    }

    public function refreshModal()
    {
        return $this->redirect(route('administration.user_management'), navigate: false);
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function filter()
    {
        $this->builder();
    }

    public function dispatchEdit($id)
    {
        $this->dispatch('user-edit', id: $id);
    }

    public function dispatchView($id)
    {
        $this->dispatch('user-view', id: $id);
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

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $user = User::find($this->userId);
        $user->delete();

        $this->alert('success', 'User Deleted Successfully');
    }
    public function selectAllCheckbox()
    {
        if ($this->selectAll) {
            $this->selectAll = true;
            $users = $this->builder();
            $this->selectedUsers = $users->pluck('id')->toArray();
        } else {
            $this->selectedUsers = [];
            $this->selectAll = false;
        }
    }
    public function toggleActivation()
    {
        if (empty($this->selectedUsers)) {
            $this->alert('success','No users selected.');
            return;
        }

        $selectedUsers = User::whereIn('id', $this->selectedUsers)->get();


        // Define restricted roles
        $restrictedRoles = ['Admin', 'SuperAdmin', 'Administrator'];

        foreach ($selectedUsers as $user) {
            if ($user->roles->pluck('name')->intersect($restrictedRoles)->isEmpty()) {
                $user->status = !$user->status;
                $user->save();
            }
        }

        // Refresh the user list
        $this->users = User::all();

        // Clear the selected users and reset the select-all checkbox
        $this->selectedUsers = [];
        $this->selectAll = false;

        $this->alert('success','Selected users updated.');
    }

}
