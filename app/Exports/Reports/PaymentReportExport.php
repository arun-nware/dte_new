<?php

namespace App\Exports\Reports;

use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class PaymentReportExport extends StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
// class PaymentReportExport implements FromView
{
    protected $PaymentReport;

    public function __construct($PaymentReport)
    {
        $this->PaymentReport = $PaymentReport;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $paymentReports = $this->PaymentReport;

        // dd($paymentReports);

        return view('admin.reports.payment-report-export', compact('paymentReports'));
    }
}
