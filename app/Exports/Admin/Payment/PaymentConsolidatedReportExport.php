<?php

namespace App\Exports\Admin\Payment;

use App\Models\Payment;
use App\Models\PaymentTransaction;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class PaymentConsolidatedReportExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    public  $result;
    public function __construct($Data)
    {
        $this->result = $Data;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $input = $this->result['input'];
        $data['payment'] = Payment::getPaymentConsolidateData($input['start_date'],$input['end_date'],$input['status'],$input['region']);

        $data['credit_payments'] = PaymentTransaction::getConsolidateCreditPayment($input['start_date'],$input['end_date'],$input['status'],$input['region']);

        return view('admin.reports.transaction-report', compact('data', 'input'));
    }
}
