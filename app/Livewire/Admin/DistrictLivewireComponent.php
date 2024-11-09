<?php

namespace App\Livewire\Admin;

use App\Models\District;
use App\Models\Region;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DistrictLivewireComponent extends Component
{
    use LivewireAlert;

    public bool $create = true;
    public bool $view = false;
    public string $modalTitle = "District Create";
    public string $componentName = "District";

    public string $name = '';

    public string $code = '';
    public string $state_id = '';
    public $DistrictData;
    public $DistrictId;

    public function render()
    {
        $states = State::all();
        return view('livewire.admin.district-livewire-component', compact('states'));
    }

    public function save()
    {
        $validated = Validator::make([
            "name" => $this->name,
            "code" => $this->code,
            "state_id" => $this->state_id,
        ],
            [
                'name' => ['required', \Illuminate\Validation\Rule::unique('districts')->whereNull('deleted_at')],
                'code' => ['required', \Illuminate\Validation\Rule::unique('districts')->whereNull('deleted_at')],
                'state_id' => ['required']
            ])->validate();

        try {
            District::create($validated);

            $this->dispatch('hide-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'District Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }


    #[On('district-edit')]
    public function dispatchEdit($id)
    {
        $this->create = false;
        $this->modalTitle = "Update District";
        $this->DistrictData = District::find($id);

        $this->DistrictId = $this->DistrictData->id;
        $this->name = $this->DistrictData->name;
        $this->code = $this->DistrictData->code;
        $this->state_id = $this->DistrictData->state_id;

    }

    #[On('district-view')]
    public function dispatchView($id)
    {
        $this->create = false;
        $this->view = true;
        $this->modalTitle = "View District";
        $this->DistrictData = District::find($id);

        $this->DistrictId = $this->DistrictData->id;
        $this->name = $this->DistrictData->name;
        $this->code = $this->DistrictData->code;
        $this->state_id = $this->DistrictData->state_id;

    }

    public function update()
    {
        $validated = Validator::make([
            "name" => $this->name,
            "code" => $this->code,
        ],
            [
                'name' => ['required', \Illuminate\Validation\Rule::unique('districts')->ignore($this->DistrictData->id)->whereNull('deleted_at')],
                'code' => ['required', \Illuminate\Validation\Rule::unique('districts')->ignore($this->DistrictData->id)->whereNull('deleted_at')]
            ])->validate();

        try {
            $this->DistrictData->update($validated);

            $this->dispatch('hide-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'District Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('reset-modal')]
    public function resetModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatch('hide-modal');
        $this->dispatch('refreshDatatable');
    }
}
