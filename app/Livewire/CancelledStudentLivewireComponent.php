<?php

namespace App\Livewire;

use App\Imports\CollegeImportExcel;
use App\Imports\EmployeeImport;
use App\Jobs\CollegeImportJob;
use App\Models\College;
use App\Models\FileUploadRecord;
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

class CancelledStudentLivewireComponent extends Component
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

    public function render()
    {
        $colleges = $this->builder();
        return view('livewire.college-livewire-component',
        compact('colleges'));
    }

    #[On('refreshParent')]
    public function builder()
    {
        $query = College::query()
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
        $this->dispatch('college-edit', id: $id);
    }

    public function dispatchView($id)
    {
        $this->dispatch('college-view', id: $id);
    }


    public function delete($id)
    {
        $this->EmployeeId = $id;
        $this->alert('question', 'Are you sure , You want to delete this College?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);

    }

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $user = College::find($this->CollegeID);
        $user->delete();

        $this->alert('success', 'College Deleted Successfully');
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function import()
    {
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
                    'module_type' => 'CollegeImport',
                    'file_title' => $this->title,
                    'file_name' => $fileName,
                    'created_by' => $id,
                ]
            );

            // Storing Excel Data
            $filePath = 'Admin/Colleges/' . date("Ymd");
            $filePathName = $this->file->storeAs(path: $filePath, name: $fileName);

            Excel::import(new CollegeImportExcel($fileUploadRecord), $filePathName);

            $this->alert('success', "Colleges file uploaded successfully.");
            $this->resetModal();
        } catch (\Exception $exception) {
            dd($exception);
            $this->alert('error', $exception->getMessage());
        }
    }

}
