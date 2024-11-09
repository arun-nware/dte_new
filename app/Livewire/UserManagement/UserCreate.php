<?php

namespace App\Livewire\UserManagement;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class UserCreate extends Component
{
    use LivewireAlert;

    public bool $create = true;
    public bool $view = false;
    public bool $modalHide = false;
    public string $modalTitle = "User Create";

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $employee_code;
    public $designation;
    public $hospital;
    public $medical_college_id;
    public $status;
    public $password;
    public $password_confirmation;
    public $role;
    public $roles;
    public $loggedInUser;
    public $user;
    public $UserId = '';
    public $passwordStatus = false;
    public $hospitals;
    protected function rules()
    {
        return (new UserRequest($this->create, $this->UserId, $this->passwordStatus))->rules();
    }

    public function mount()
    {
        $this->hospitals = Hospital::all();
    }

    public function render()
    {
        $this->loggedInUser = Auth::user();
        if ($this->loggedInUser->hasAnyRole(['SuperAdmin'])) {
            $roles = Role::all();
        } else {
            $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        }
        //$hospitals = $this->hospital;
        $medicalColleges = MedicalCollege::all();

        $designations = Designation::all();
        $this->roles = $roles;
        return view('livewire.user-management.user-create', compact('roles', 'designations', 'medicalColleges'));
    }

    public function save()
    {
        $validated = $this->validate();
        $username = explode('@', $validated['email']);
        $validated = array_merge($validated, ['username' => $username[0]]);
        $validated = array_merge($validated, ['name' => $this->first_name . ' ' . $this->last_name]);

        try {
            $user = User::Create($validated);
            $user->email_verified_at = now();
            $user->save();

            event(new Registered($user));

            $user->assignRole($this->role);

            $this->alert('success', 'User Created Successfully');
            $this->dispatch('hide-modal');
            $this->dispatch('refreshParent');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('user-edit')]
    public function edit($id)
    {
        $this->create = false;
        $this->modalTitle = "User Edit";
        $this->commonData($id);
    }


    #[On('user-view')]
    public function view($id)
    {
        $this->create = false;
        $this->view = true;
        $this->modalTitle = "User View";

        $this->commonData($id);
    }

    public function update()
    {
        if ($this->password != '') {
            $this->passwordStatus = true;
        }

        $validated = $this->validate();

        try {
            $validated = array_merge($validated, ['name' => $this->first_name . ' ' . $this->last_name]);

            $this->user->update($validated);

            $roles = $this->user->roles->pluck('name');

            $this->user->syncRoles([]);

            $this->user->assignRole($this->role);
            $this->dispatch('hide-modal');

            $this->alert('success', 'User Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('reset-user-modal')]
    public function resetModal()
    {
        $this->dispatch('$refresh');
        $this->dispatch('hide-modal');
        $this->dispatch('refreshParent');
        $this->resetErrorBag();
    }

    private function commonData($id)
    {
        $user = User::with(['roles'])->where('id', $id)->first();
        $this->UserId = $user->id;
        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->employee_code = $user->employee_code;
        $this->status = $user->status;
        $this->role = $user->roles->pluck('name')[0] ?? '';
        $this->hospital = $user->hospital;
        $this->designation = $user->designation;
        $this->medical_college_id = $user->medical_college_id;
        $this->dispatch('set-hospital-id', hospital: $this->hospital);
    }

    public function changeHospital(){
        $this->hospitals = Hospital::where('medical_college_id', $this->medical_college_id)->get();
    }
}
