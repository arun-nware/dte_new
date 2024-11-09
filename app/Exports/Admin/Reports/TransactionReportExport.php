<?php

namespace App\Exports\Admin\Reports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class TransactionReportExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    public  $result;
    public function __construct($Data)
    {
        $this->result = $Data;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $input = $this->result['input'];
        $filter = $this->result['filter'];
        $allTransactions = $this->result['allTransactions'];
        return view('admin.reports.transaction-report', compact('allTransactions', 'filter', 'input'));
    }
}
