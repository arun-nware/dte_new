<?php

namespace App\Exports\Admin\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class BeneficiaryExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    public  $result;
    public function __construct($Data)
    {
        $this->result = $Data;
    }

    public function view(): \Illuminate\Contracts\View\View
    {

        $users = $this->result;
        return view('admin.reports.user-export', compact('users'));
    }
}
