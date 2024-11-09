<?php

namespace App\Livewire\Admin;

use App\Models\Navigation;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RegionLivewireComponent extends Component
{
    use LivewireAlert;

    public bool $create = true;
    public string $modalTitle = "Region Create";
    public string $componentName = "Region";

    #[Rule('required|string|max:255|unique:regions,name')]
    public string $name;

    #[Rule('required|integer|unique:regions,code')]
    public string $code;
    public $regionData;
    public $regionId;

    public function render()
    {
        return view('livewire.admin.region-livewire-component');
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            Region::create($validated);

            $this->dispatch('hide-region-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'Region Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }


    #[On('region-edit')]
    public function dispatchEdit($id)
    {
        $this->create = false;
        $this->modalTitle = "Update Region";
        $this->regionData = Region::find($id);

        $this->regionId = $this->regionData->id;
        $this->name = $this->regionData->name;
        $this->code = $this->regionData->code;

    }

    public function update()
    {
        $validated = Validator::make([
            "name" => $this->name,
            "code" => $this->code,
        ],
            [
                'name' => ['required', \Illuminate\Validation\Rule::unique('regions')->ignore($this->regionData->id)],
                'code' => ['required', \Illuminate\Validation\Rule::unique('regions')->ignore($this->regionData->id)]
            ])->validate();

        try {
            $this->regionData->update($validated);

            $this->dispatch('hide-region-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'Region Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }

    #[On('reset-region-modal')]
    public function resetModal()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatch('refreshDatatable');
    }
}
