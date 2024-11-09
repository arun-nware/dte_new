<?php

namespace App\Jobs;

use App\Imports\CollegeImportExcel;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class CollegeImportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private $fileUpload;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $fileUpload)
    {
        $this->filePath = $filePath;
        $this->fileUpload = $fileUpload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new CollegeImportExcel($this->fileUpload), $this->filePath);
    }
}
