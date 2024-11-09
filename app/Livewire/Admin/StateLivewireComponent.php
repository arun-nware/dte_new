<?php

namespace App\Livewire\Admin;

use App\Models\Region;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class StateLivewireComponent extends Component
{
    use LivewireAlert;

    public bool $create = true;
    public bool $view = false;
    public string $modalTitle = "State Create";
    public string $componentName = "State";

    public string $name = '';

    public string $code = '';
    public $StateData;
    public $StateId;

    public function render()
    {
        return view('livewire.admin.state-livewire-component');
    }

    public function save()
    {
        $validated = Validator::make([
            "name" => $this->name,
            "code" => $this->code,
        ],
            [
                'name' => ['required', \Illuminate\Validation\Rule::unique('states')->whereNull('deleted_at')],
                'code' => ['required', \Illuminate\Validation\Rule::unique('states')->whereNull('deleted_at')]
            ])->validate();

        try {
            State::create($validated);

            $this->dispatch('hide-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'State Updated Successfully.');
        } catch (\Exception $e) {
            $this->alert('error', 'There is an error. Please try again!');
        }
    }


    #[On('state-edit')]
    public function dispatchEdit($id)
    {
        $this->create = false;
        $this->modalTitle = "Update State";
        $this->StateData = State::find($id);

        $this->StateId = $this->StateData->id;
        $this->name = $this->StateData->name;
        $this->code = $this->StateData->code;

    }

    #[On('state-view')]
    public function dispatchView($id)
    {
        $this->create = false;
        $this->view = true;
        $this->modalTitle = "View State";
        $this->StateData = State::find($id);

        $this->StateId = $this->StateData->id;
        $this->name = $this->StateData->name;
        $this->code = $this->StateData->code;

    }

    public function update()
    {
        $validated = Validator::make([
            "name" => $this->name,
            "code" => $this->code,
        ],
            [
                'name' => ['required', \Illuminate\Validation\Rule::unique('states')->ignore($this->StateData->id)->whereNull('deleted_at')],
                'code' => ['required', \Illuminate\Validation\Rule::unique('states')->ignore($this->StateData->id)->whereNull('deleted_at')]
            ])->validate();

        try {
            $this->StateData->update($validated);

            $this->dispatch('hide-modal');
            $this->dispatch('refreshDatatable');
            $this->alert('success', 'State Updated Successfully.');
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
