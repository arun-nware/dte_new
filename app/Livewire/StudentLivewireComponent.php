<?php

namespace App\Livewire;

use App\Imports\CollegeImportExcel;
use App\Imports\EmployeeImport;
use App\Imports\StudentImportExcel;
use App\Jobs\CollegeImportJob;
use App\Models\College;
use App\Models\FileUploadRecord;
use App\Models\Student;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
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

class StudentLivewireComponent extends Component
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

    public $StudentID;
    public $title;
    public $file;

    public function render()
    {
        $students = $this->builder();
        return view('livewire.student-livewire-component',
        compact('students'));
    }

    #[On('refreshParent')]
    public function builder()
    {
        $query = Student::query()
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
        $this->dispatch('student-edit', id: $id);
    }

    public function dispatchView($id)
    {
        $this->dispatch('student-view', id: $id);
    }


    public function delete($id)
    {
        $this->StudentID = $id;
        $this->alert('question', 'Are you sure , You want to delete this Student?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Delete',
            'onConfirmed' => 'confirmedDelete'
        ]);

    }

    #[On('confirmedDelete')]
    public function confirmedDelete()
    {
        // Get input value and do anything you want to it
        $user = Student::find($this->StudentID);
        $user->delete();

        $this->alert('success', 'Student Deleted Successfully');
    }


    public function import(): void
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
                    'module_type' => 'StudentImport',
                    'file_title' => $this->title,
                    'file_name' => $fileName,
                    'created_by' => $id,
                ]
            );

            // Storing Excel Data
            $filePath = 'Admin/Students/' . date("Ymd");
            $filePathName = $this->file->storeAs(path: $filePath, name: $fileName);

            Excel::import(new StudentImportExcel($fileUploadRecord), $filePathName);

            $this->alert('success', "Student file uploaded successfully.");
            $this->resetModal();
        } catch (\Exception $exception) {
            $this->alert('error', $exception->getMessage());
        }
    }

}
