<?php

namespace App\Livewire;

use App\Models\SupportDocumentType;
use Livewire\Component;

class NotificationLivewireComponent extends Component
{
    public function render()
    {
        $documentType = SupportDocumentType::with('supportDocuments')->where('document_type_name', 'NOTIFICATION')->get();

        return view('livewire.notification-livewire-component', compact('documentType'));
    }
}
