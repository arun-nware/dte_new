<?php

namespace App\Livewire;

use App\Models\Navigation;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class SubNavigationLivewireComponent extends Component
{
    use LivewireAlert;

    public bool $create = True;
    public string $modalTitle = "Navigation Create";

    public $id;
    public $navigations;
    public $navigationId;
    public $nav_type = 'nav';
    public $nav_id;
    public $nav_name;
    public $nav_route;
    public $nav_permission;
    public $nav_icon;
    public $nav_order;
    public $navigationData;

    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $this->navigations = Navigation::with('navigation')->where('nav_id', $this->id)->get();
        $navigationType = Navigation::where('nav_type', 'nav')->get();
        return view('livewire.sub-navigation-livewire-component', ['navigations' => $this->navigations, 'navigationType' => $navigationType]);
    }

    #[On('navigation-edit')]
    public function dispatchEdit($id)
    {
        $this->create = false;
        $this->modalTitle = "Update Navigation";
        $this->navigationData = Navigation::find($id);

        $this->nav_id = $this->navigationData->nav_id;
        $this->nav_name = $this->navigationData->nav_name;
        $this->nav_route = $this->navigationData->nav_route;
        $this->nav_permission = $this->navigationData->nav_permission;
        $this->nav_icon = $this->navigationData->nav_icon;
        $this->nav_order = $this->navigationData->nav_order;
        $this->nav_type = $this->navigationData->nav_type;
    }

    public function update()
    {
        $validated = Validator::make([
            "nav_id" => $this->nav_id,
            "nav_type" => $this->nav_type,
            "nav_name" => $this->nav_name,
            "nav_route" => $this->nav_route,
            "nav_permission" => $this->nav_permission,
            "nav_icon" => $this->nav_icon,
            "nav_order" => $this->nav_order
        ],
            [
                'nav_id' => ['required', 'max:255'],
                'nav_type' => ['required'],
                'nav_name' => ['required', \Illuminate\Validation\Rule::unique('navigations')->ignore($this->navigationData->id)->whereNull('deleted_at')],
                'nav_permission' => ['required'],
                'nav_order' => ['required']
            ])->validate();

        try {
            $this->navigationData->update([
                "nav_id" => $this->nav_id,
                "nav_type" => $this->nav_type,
                "nav_name" => $this->nav_name,
                "nav_route" => $this->nav_route,
                "nav_permission" => $this->nav_permission,
                "nav_icon" => $this->nav_icon,
                "nav_order" => $this->nav_order
            ]);

            $this->dispatch('hide-navigation-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'Navigation Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('reset-navigation-modal')]
    public function resetModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatch('refreshDatatable');
    }

    public function delete($id)
    {
        $this->navigationId = $id;
        $this->alert('question', 'Are you sure , You want to delete this navigation?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);
    }

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $role = Navigation::find($this->navigationId);
        $role->delete();

        $this->alert('success', 'Navigation Deleted Successfully');
    }
}
