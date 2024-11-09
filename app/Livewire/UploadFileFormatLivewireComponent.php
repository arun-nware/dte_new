<?php

namespace App\Livewire;

use App\Models\SupportDocumentType;
use Livewire\Component;

class UploadFileFormatLivewireComponent extends Component
{
    public function render()
    {
        $documentTypes = SupportDocumentType::with('supportDocuments')->where('document_type_name', 'UPLOADFILEFORMAT')->get();
        return view('livewire.upload-file-format-livewire-component', compact('documentTypes'));
    }
}
