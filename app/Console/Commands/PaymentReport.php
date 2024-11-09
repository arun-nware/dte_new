<?php

namespace App\Console\Commands;

use App\Livewire\Reports\PaymentReportLivewireComponent;
use Illuminate\Console\Command;

class PaymentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download Payment Report in Excel File';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // (new PaymentReportLivewireComponent)->export();
        dd('Download Payment Report in Excel File');
    }
}
