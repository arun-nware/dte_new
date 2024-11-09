<?php

namespace App\Livewire;

use App\Imports\CollegeImportExcel;
use App\Imports\EmployeeImport;
use App\Imports\TransactionImportExcel;
use App\Jobs\CollegeImportJob;
use App\Models\College;
use App\Models\FileUploadRecord;
use App\Models\Transaction;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class TransactionLivewireComponent extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads, WithoutUrlPagination;
    use PaginationTrait;

    #[Url]
    public $sortBy = 'id';

    #[Url]
    public $sortDirection = 'desc';
    #[Url]
    public $perPage = 25;
    public $search = '';

    public $title;
    public $hospital;
    public $file;
    public $TransactionID;

    public function render()
    {
        $transactions = $this->builder();
        return view('livewire.transaction-livewire-component',
        compact('transactions'));
    }

    #[On('refreshParent')]
    public function builder()
    {
        $query = Transaction::query()
            ->select();
        return $this->getPages($query, $this->perPage, $this->sortBy, $this->sortDirection);
    }

    #[On('reset-modal')]
    public function resetModal()
    {
        $this->dispatch('$refresh');
        $this->dispatch('hide-modal');
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
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

    public function filter(): void
    {
        $this->builder();
    }

    public function dispatchEdit($id)
    {
        $this->dispatch('transaction-edit', id: $id);
    }

    public function dispatchView($id)
    {
        $this->dispatch('transaction-view', id: $id);
    }


    public function delete($id)
    {
        $this->TransactionID = $id;
        $this->alert('question', 'Are you sure , You want to delete this Transaction?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);

    }

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $user = Transaction::find($this->TransactionID);
        $user->delete();

        $this->alert('success', 'Transaction Deleted Successfully');
    }


    public function import()
    {
        dd($this->file);
        $validated = $validator = Validator::make(
            [
                'file' => $this->file,
                'title' => $this->title,
            ],
            [
                'file' => 'required|max:50000|mimes:xlsx,xls',
                'title' => 'required|string|max:200',
            ]
        )->validate();

        try {
            $id = auth()->user()->id;
            $fileName = $id . date('Ymd') . time() . '.' . $this->file->extension();

            //Record Upload Data
            $fileUploadRecord = FileUploadRecord::create(
                [
                    'module_type' => 'TransactionImport',
                    'file_title' => $this->title,
                    'file_name' => $fileName,
                    'created_by' => $id,
                ]
            );

            // Storing Excel Data
            $filePath = 'Admin/Transactions/' . date("Ymd");
            $filePathName = $this->file->storeAs(path: $filePath, name: $fileName);

            Excel::import(new TransactionImportExcel($fileUploadRecord), $filePathName);

            $this->alert('success', "Transactions file uploaded successfully.");
            $this->resetModal();
        } catch (\Exception $exception) {
            dd($exception);
            $this->alert('error', $exception->getMessage());
        }
    }

}
