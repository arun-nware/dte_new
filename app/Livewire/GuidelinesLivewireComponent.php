<?php

namespace App\Livewire;

use App\Models\SupportDocumentType;
use Livewire\Component;

class GuidelinesLivewireComponent extends Component
{
    public function render()
    {
        $documentTypes = SupportDocumentType::with('supportDocuments')->where('document_type_name', 'GUIDELINES')->get();
        return view('livewire.guidelines-livewire-component', compact('documentTypes'));
    }
}
