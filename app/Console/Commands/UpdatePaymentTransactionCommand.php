<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\PaymentTransaction;
use App\Traits\SendExternalApiTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdatePaymentTransactionCommand extends Command
{
    use SendExternalApiTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-payment-transaction-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Payment Transaction which is uploaded by Maker';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $paymentFiles = Payment::getPaymentListForCron();
            foreach ($paymentFiles as $paymentFile) {

                $creditLists = PaymentTransaction::getPaymentCreditListForCron($paymentFile['id']);

                foreach ($creditLists as $creditList) {
                    $bill_no = $creditList['bill_no'];
                    $deductionAmount = $this->callWarehouseDeduction($bill_no);
                    $deduction = json_decode($deductionAmount[0], true);
                    if (!isset($deduction[0])) {
                        $deduction[0] = [];
                    }
                    $deduction = $deduction[0];

                    $data = [
                        'deduction' => $deduction['OtherDeduction'],
                        'StorageBillNumber' => $deduction['StorageBillNumber'],
                        'RentBillNumber' => $deduction['RentBillNumber'],
                        'GrossAmount' => $deduction['GrossAmount'],
                        'TDS' => $deduction['TDS'],
                        'OtherDeduction' => $deduction['OtherDeduction'],
                        'PayableAmount' => $deduction['PayableAmount'] ?? 0,
                        'RentBillAmount' => $deduction['RentBillAmount'] ?? 0,
                        'CropYear' => $deduction['CropYear'],
                        'FinancialYear' => $deduction['FinancialYear'],
                        'Month' => $deduction['Month'],
                        'Commodity' => $deduction['Commodity'],
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    PaymentTransaction::find($creditList['id'])->update($data);
                }

                Payment::find($paymentFile['id'])->update(['cron_status' => 1]);
                DB::commit();
            }
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
        }
    }
}
