<?php

namespace App\Livewire\Admin;

use App\Exports\Admin\Payment\PaymentConsolidatedReportExport;
use App\Exports\Admin\Reports\TransactionReportExport;
use App\Models\Payment;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PaymentLivewireComponent extends Component
{
    use LivewireAlert, WithPagination, WithoutUrlPagination;

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';
    public $perPage = 20;
    public $search = '';

    public $create = true;
    public $componentName = 'Payment';

    public $startDate;
    public $endDate;
    public $Status;
    public $Region;
    public $paymentId;
    public $exports = false;

    public function render()
    {
        $regions = \App\Models\Region::all();
        $items = $this->builder();
        return view('livewire.admin.payment-livewire-component', compact('regions', 'items'));
    }

    public function builder()
    {
        $page = $this->perPage == "All" ? -1 : intval($this->perPage);

        return Payment::query()
            ->with(['reverseMisTransaction', 'paymentTransaction', 'processedPaymentTransaction', 'rejectedPaymentTransaction'])
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereBetween('payments.created_at', [$this->startDate, $this->endDate]);
            })->when($this->Status, function ($query) {
                if ($this->Status == 2) {
                    $query->where('payments.h2h_processed_status', 1);
                    $query->where('payments.status', 1);
                } elseif ($this->Status == 1) {
                    $query->where('payments.h2h_processed_status', 0);
                    $query->where('payments.status', 1);
                } else {
                    $query->where('payments.h2h_processed_status', 0);
                    $query->where('payments.status', 0);
                }
            })
            ->when($this->search, function ($query) {
                $query->like('title', $this->search);
            })
            ->select()
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($page);
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $this->paymentId = $id;
        $this->alert('question', 'Are you sure , You want to delete this Payment List?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);

    }

    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        Payment::find($this->paymentId)->delete();
        PaymentTransaction::where('payment_id', $this->paymentId)->delete();
        $this->alert('success', 'Payment List Deleted Successfully');
    }

    #[On('search-payment')]
    public function searchPayment($data)
    {
        $this->startDate = $data['start_date'] ?? NULL;
        $this->endDate = $data['end_date'] ?? NULL;
        $this->Status = $data['status'] ?? NULL;
        $this->Region = $data['region'] ?? NULL;
        $items = $this->builder();

        if ($items->count()) {
            $this->exports = true;
        }
    }

    public function export(){

        $data['input'] = [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'status' => $this->Status,
            'region' => $this->Region,
        ];

        return Excel::download(new PaymentConsolidatedReportExport($data), 'TransactionReportExport.xlsx');

    }
}
