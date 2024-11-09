<?php

namespace App\Livewire\Component;

use App\Models\SupportDocumentConfig;
use App\Models\SupportDocumentType;
use Livewire\Component;

class NavDocumentTypeComponent extends Component
{
    public function render()
    {
        $documentTypes = SupportDocumentType::with('supportDocuments')->get();
        return view('livewire.component.nav-document-type-component', compact('documentTypes'));
    }
}
