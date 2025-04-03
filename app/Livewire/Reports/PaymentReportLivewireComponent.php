<?php

namespace App\Livewire\Reports;

use App\Exports\Reports\PaymentReportExport;
use App\Models\AllotmentList;
use App\Models\College;
use App\Models\PaymentReport;
use App\Models\Student;
use App\Models\Tpr;
use App\Models\Transaction;
use App\Traits\PaginationTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PaymentReportLivewireComponent extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads, WithoutUrlPagination;
    use PaginationTrait;

    #[Url]
    public $sortBy = 'colleges.id';
    #[Url]
    public $sortDirection = 'desc';
    #[Url]
    public $perPage = 25;
    #[Url]
    public $search = '';

    public $title;
    public $hospital;
    public $file;

    public function export()
    {
        DB::enableQueryLog();
        $query = College::query()
            ->leftJoin('college_account_details', 'college_account_details.user_name', '=', 'colleges.user_name')
            ->select('colleges.course', 'colleges.branch_name as branch', 'colleges.user_name as college_code', 'colleges.inst_name as college_name', DB::raw('sum(intake) as total_intake'), DB::raw('sum(total_admitted) as total_admission'), DB::raw('sum(nri_seats) as total_nri'), 'account_number', 'account_holder_name', 'bank', 'college_account_details.branch as bank_branch', 'ifsc', 'nodal_officer_mobile_no', 'asstt_nodal_officer_mobile_no',)

            ->addSelect(['total_NENV_count' => Student::select(DB::raw('count(id)'))
                ->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('not_eligible', 1)])

            ->addSelect(['total_tfw_count' => Student::select(DB::raw('count(id)'))
                ->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('tuition_fee_waiver_status', 'Y')])

            ->addSelect(['total_IPS_count' => Student::select(DB::raw('count(id)'))
                ->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('round', 'IPS')])

            ->addSelect(['total_allocated_count' => AllotmentList::select(DB::raw('count(id)'))
                ->where('user_name', DB::raw('colleges.user_name'))])

            ->addSelect(['total_upgraded_admission_cancel_count' => AllotmentList::select(DB::raw('count(id)'))
                ->where('user_name', DB::raw('colleges.user_name'))->whereIn('round', ['FU'])
                ->whereNotIn(
                    'roll_number',
                    Student::select('roll_number')->where('institute_user_name', DB::raw('colleges.user_name'))
                        ->whereIn('round', ['FU', 'SL'])
                )])


            // FR Admission Count
            ->addSelect(['fr_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['FR', 'RF', 'F'])])

            // SR Admission Count
            ->addSelect(['sr_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['SR', 'RS', 'S'])])

            // SL Admission Count
            ->addSelect(['sl_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('round', 'SL')])

            // FU Admission Count
            ->addSelect(['fu_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('round', 'FU')])

            // QL Admission Count
            ->addSelect(['ql_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['TR', 'T'])])

            // FR Allotment Count
            ->addSelect(['fr_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['FR', 'RF', 'F'])])

            // SR Allotment Count
            ->addSelect(['sr_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['SR', 'RS', 'S'])])

            // SL Allotment Count
            ->addSelect(['sl_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->where('round', 'SL')])

            // UR Allotment Count (FU in original SQL)
            ->addSelect(['ur_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->where('round', 'FU')])

            // QL Allotment Count
            ->addSelect(['ql_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['TR', 'T', 'QR'])])


            ->addSelect(['total_CLC_cancel_count' => Transaction::select(DB::raw('count(id)'))
                ->where('transaction_amount', 30)
                ->whereRaw('counselling_id_roll_no IN (select roll_number from students where institute_user_name = colleges.user_name AND round = "CLC")')])

            ->addSelect([
                'totalUpgradeCount' =>
                Student::select(DB::raw('count(id)'))
                    ->where('round', '=', 'FU')
                    ->where('tuition_fee_waiver_status', '=', 'N')
                    ->where('students.institute_user_name', DB::raw('colleges.user_name'))
                    ->whereIn(
                        'roll_number',
                        Transaction::select('counselling_id_roll_no')
                            ->where('transaction_amount', '=', '1030')
                    ),
                'totalAllotted' =>  Student::select(DB::raw('count(id)'))
                    ->where('round', '=', 'FU')
                    ->where('tuition_fee_waiver_status', '=', 'N')
                    ->where('students.institute_user_name', DB::raw('colleges.user_name'))
                    ->whereIn(
                        'roll_number',
                        Transaction::select('counselling_id_roll_no')
                            ->where('transaction_amount', '=', '1030')
                    ),
            ])
            ->addSelect(['total_upgrade_count' => DB::raw('(select (totalUpgradeCount-totalAllotted)) AS total_upgrade_count'),])

            ->groupBy('colleges.user_name')
            ->orderBy('colleges.user_name', 'asc')
            // ->orderBy('colleges.course', 'asc');
            ->orderBy('colleges.course', 'asc')->limit(5);
        // dd($query->toRawSql());
        $results = $query->get()->toArray();

        // $PaymentReports = $this->result($results);
        $PaymentReports = PaymentReport::all([
            "course",
            'user_name AS college_code',
            'inst_name AS college_name',
            'total_intake',
            'total_allotted AS total_allocated',
            "total_admission",
            'total_admission_cancelled AS total_allocated_cancelled',
            'total_upgraded_admission_cancelled AS total_cancelled_upgrade_candidate',
            'total_nri AS nri',
            'total_ips AS ips',
            'total_tfw AS twf',
            'total_pio AS pio',
            'total_upgrade_count AS total_upgrade_candidate',
            'total_upgrade_allotment AS total_1st_upgrade_candidate',
            'total_upgrade AS total_2nd_upgrade_candidate',
            'total_clc_cancelled',
            'total_nenv AS ne',
            'admission1 AS admission',
            'admission2 AS admission_upgrade',
            'tuition_fee_payment AS total_amount',
            "account_number",
            "account_holder_name",
            "bank",
            "bank_branch",
            "ifsc",
            "nodal_officer_mobile_no",
            "asstt_nodal_officer_mobile_no",

        ])->toArray();
        // $PaymentReports = Tpr::all()->first()->toArray();

        try {
            $export = new PaymentReportExport($PaymentReports);
            // dd($PaymentReports, $export);
            return Excel::download($export, 'PaymentReports.xlsx');
            // return Excel::store($export, 'PaymentReports.xlsx');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function render()
    {
        $paymentReports = $this->builder();

        // dd($paymentReports);

        return view('livewire.reports.payment-report-livewire-component', compact('paymentReports'));
    }

    #[On('refreshParent')]
    public function builder()
    {
        DB::enableQueryLog();

        $query = College::query()
            ->leftJoin('college_account_details', 'college_account_details.user_name', '=', 'colleges.user_name')
            ->select('colleges.course', 'colleges.branch_name as branch', 'colleges.user_name as college_code', 'colleges.inst_name as college_name', DB::raw('sum(intake) as total_intake'), DB::raw('sum(total_admitted) as total_admission'), DB::raw('sum(nri_seats) as total_nri'), 'account_number', 'account_holder_name', 'bank', 'college_account_details.branch as bank_branch', 'ifsc', 'nodal_officer_mobile_no', 'asstt_nodal_officer_mobile_no',)

            ->addSelect(['total_NENV_count' => Student::select(DB::raw('count(id)'))
                ->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('not_eligible', 1)])

            ->addSelect(['total_tfw_count' => Student::select(DB::raw('count(id)'))
                ->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('tuition_fee_waiver_status', 'Y')])

            ->addSelect(['total_IPS_count' => Student::select(DB::raw('count(id)'))
                ->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('round', 'IPS')])

            ->addSelect(['total_allocated_count' => AllotmentList::select(DB::raw('count(id)'))
                ->where('user_name', DB::raw('colleges.user_name'))])

            ->addSelect(['total_upgraded_admission_cancel_count' => AllotmentList::select(DB::raw('count(id)'))
                ->where('user_name', DB::raw('colleges.user_name'))->whereIn('round', ['FU'])
                ->whereNotIn(
                    'roll_number',
                    Student::select('roll_number')->where('institute_user_name', DB::raw('colleges.user_name'))
                        ->whereIn('round', ['FU', 'SL'])
                )])


            // FR Admission Count
            ->addSelect(['fr_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['FR', 'RF', 'F'])])

            // SR Admission Count
            ->addSelect(['sr_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['SR', 'RS', 'S'])])

            // SL Admission Count
            ->addSelect(['sl_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('round', 'SL')])

            // FU Admission Count
            ->addSelect(['fu_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->where('round', 'FU')])

            // QL Admission Count
            ->addSelect(['ql_admission' => Student::select(DB::raw('count(id)'))->where('institute_user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['TR', 'T'])])

            // FR Allotment Count
            ->addSelect(['fr_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['FR', 'RF', 'F'])])

            // SR Allotment Count
            ->addSelect(['sr_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['SR', 'RS', 'S'])])

            // SL Allotment Count
            ->addSelect(['sl_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->where('round', 'SL')])

            // UR Allotment Count (FU in original SQL)
            ->addSelect(['ur_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->where('round', 'FU')])

            // QL Allotment Count
            ->addSelect(['ql_allotment' => AllotmentList::select(DB::raw('count(id)'))->where('user_name', DB::raw('colleges.user_name'))
                ->whereIn('round', ['TR', 'T', 'QR'])])


            ->addSelect(['total_CLC_cancel_count' => Transaction::select(DB::raw('count(id)'))
                ->where('transaction_amount', 30)
                ->whereRaw('counselling_id_roll_no IN (select roll_number from students where institute_user_name = colleges.user_name AND round = "CLC")')])

            ->addSelect([
                'totalUpgradeCount' =>
                Student::select(DB::raw('count(id)'))
                    ->where('round', '=', 'FU')
                    ->where('tuition_fee_waiver_status', '=', 'N')
                    ->where('students.institute_user_name', DB::raw('colleges.user_name'))
                    ->whereIn(
                        'roll_number',
                        Transaction::select('counselling_id_roll_no')
                            ->where('transaction_amount', '=', '1030')
                    ),
                'totalAllotted' =>  Student::select(DB::raw('count(id)'))
                    ->where('round', '=', 'FU')
                    ->where('tuition_fee_waiver_status', '=', 'N')
                    ->where('students.institute_user_name', DB::raw('colleges.user_name'))
                    ->whereIn(
                        'roll_number',
                        Transaction::select('counselling_id_roll_no')
                            ->where('transaction_amount', '=', '1030')
                    ),
            ])
            ->addSelect(['total_upgrade_count' => DB::raw('(select (totalUpgradeCount-totalAllotted)) AS total_upgrade_count'),])


            //         $students = Student::where('institute_user_name', $collegeCode)
            //     ->whereIn('round', ['FU', 'SL'])
            //     ->get('roll_number')->toArray();


            // // Subquery to count the records from allotment_lists for the 'FU' round
            // $allotmentCount = AllotmentList::where('user_name', $collegeCode)
            //     ->whereIn('round', ['FU'])
            //     ->whereNotIn('roll_number', $students)->count();


            //->where('colleges.year', $this->financial);
            //->where('colleges.user_name', "BR_001")

            // ->whereIn(
            //     'colleges.user_name',
            //     Student::select('institute_user_name')
            //         ->where('round', '=', 'FU')
            //         ->where('tuition_fee_waiver_status', '=', 'N')
            //         ->whereIn(
            //             'roll_number',
            //             Transaction::select('counselling_id_roll_no')
            //                 ->where('transaction_amount', '=', '1030')
            //         )
            // )

            ->when($this->search != '', function ($query) {
                $query->where('colleges.user_name', 'LIKE', "%$this->search%");
            })
            ->groupBy('colleges.user_name')
            ->orderBy('colleges.user_name', 'asc')
            // ->orderBy('colleges.course', 'asc');
            ->orderBy('colleges.course', 'asc')->limit(50);
        // dd($query->toRawSql());
        $results = $query->get()->toArray();
        //$results = $this->getPages($query, $this->perPage, $this->sortBy, $this->sortDirection)->toArray();

        $items = $this->result($results);



        /*$query = PaymentReport::query()
            ->when($this->search != '', function ($query) {
                $query->where('user_name', 'LIKE', "%$this->search%");
            });
        $items = $query->get([
            "course",
            'user_name AS college_code',
            'inst_name AS college_name',
            'total_intake',
            'total_allotted AS total_allocated',
            "total_admission",
            'total_admission_cancelled AS total_allocated_cancelled',
            'total_upgraded_admission_cancelled AS total_cancelled_upgrade_candidate',
            'total_nri AS nri',
            'total_ips AS ips',
            'total_tfw AS twf',
            'total_pio AS pio',
            'total_upgrade_count AS total_upgrade_candidate',
            'total_upgrade_allotment AS total_1st_upgrade_candidate',
            'total_upgrade AS total_2nd_upgrade_candidate',
            'total_clc_cancelled',
            'total_nenv AS ne',
            'admission1 AS admission',
            'admission2 AS admission_upgrade',
            'tuition_fee_payment AS total_amount',
            "account_number",
            "account_holder_name",
            "bank",
            "bank_branch",
            "ifsc",
            "nodal_officer_mobile_no",
            "asstt_nodal_officer_mobile_no",

        ])->toArray();*/
        // dd($items);
        return $this->getPaginate($items, $this->perPage);
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

    public function result($results)
    {
        foreach ($results as $key => $result) {

            //print_r($result);
            $collegeCode = $result['college_code'];

            // $total_NENV_count = ($this->paymentTotalAdmittedCount($collegeCode)['total'] - $result['total_admission']);

            // $total_NENV_count = $this->paymentTotalAdmittedCount($collegeCode)['total'];
            // $total_tfw_count = $this->paymentTotalTfwCount($collegeCode);
            // $total_IPS_count = $this->getIpsCount($collegeCode);
            // $total_allocated_count = $this->paymentTotalAllottedCount($collegeCode); //Total Allotted (All Centralized Rounds)(Except NRI IPS CLC PIO)

            $total_NENV_count = $result['total_NENV_count'];
            $total_tfw_count = $result['total_tfw_count'];
            $total_IPS_count = $result['total_IPS_count'];
            $total_allocated_count = $result['total_allocated_count'];

            // $allotmentAdmissionRoundCount = $this->allotmentAdmissionRoundCount($collegeCode);
            $allotmentAdmissionRoundCount = $result;

            // $total_upgraded_admission_cancel_count = $this->totalUpgradedAdmissionCancelCount($collegeCode)['total'];  //Admission Cancelled/Not Reported(Upgraded Candidate)
            $total_upgraded_admission_cancel_count = $result['total_upgraded_admission_cancel_count'];

            // $total_CLC_cancel_count = $this->paymentTotalClcCancelCount($collegeCode)['total'];
            $total_CLC_cancel_count = $result['total_CLC_cancel_count'];

            // $total_upgrade_count = $this->paymentTotalUpgradeCount($collegeCode, true)['total'];
            $total_upgrade_count = $result['total_upgrade_count'];


            $total_admitted_count = $result['total_admission'];
            $total_NRI_count = $result['total_nri'];
            $total_admission_cancel_count = ($allotmentAdmissionRoundCount['fr_allotment'] - $allotmentAdmissionRoundCount['fr_admission']) + ($allotmentAdmissionRoundCount['sr_allotment'] - $allotmentAdmissionRoundCount['sr_admission']) + ($allotmentAdmissionRoundCount['sl_allotment'] - $allotmentAdmissionRoundCount['sl_admission']) + ($allotmentAdmissionRoundCount['ql_allotment'] - $allotmentAdmissionRoundCount['ql_admission']); //Total Admission Cancelled/Not Reported/Not Alloted (Centralized Round)  (Except NRI IPS CLC PIO and upgraded round)
            // $total_admission_cancel_count = ($result['fr_allotment'] - $result['fr_admission']) + ($result['sr_allotment'] - $result['sr_admission']) + ($result['sl_allotment'] - $result['sl_admission']) + ($result['ql_allotment'] - $result['ql_admission']); //Total Admission Cancelled/Not Reported/Not Alloted (Centralized Round)  (Except NRI IPS CLC PIO and upgraded round)

            $total_PIO_count = 0;
            $total_1st_upgrade_count = $total_upgrade_count;
            $total_2nd_upgrade_count = 0;

            $account_number = $result['account_number'] ?? '';
            $account_holder_name = $result['account_holder_name'] ?? '';
            $bank = $result['bank'] ?? '';
            $branch = $result['branch'] ?? '';
            $ifsc = $result['ifsc'] ?? '';

            $nodal_officer_mobile_no = $result['nodal_officer_mobile_no'] ?? '';
            $asstt_nodal_officer_mobile_no = $result['asstt_nodal_officer_mobile_no'] ?? '';

            $admission1 = $total_admitted_count - ($total_NRI_count + $total_IPS_count + $total_CLC_cancel_count + $total_NENV_count + $total_upgrade_count + $total_tfw_count);
            $admission2 = $total_admitted_count + $total_upgrade_count + $total_1st_upgrade_count + $total_2nd_upgrade_count - ($total_NRI_count + $total_IPS_count + $total_CLC_cancel_count + $total_NENV_count + $total_upgrade_count + $total_tfw_count);
            $total_amount = $admission2 * 1000;


            $results[$key]['total_allocated'] = $total_allocated_count;
            $results[$key]['total_allocated_cancelled'] = $total_admission_cancel_count;
            $results[$key]['total_cancelled_upgrade_candidate'] = $total_upgraded_admission_cancel_count;
            // $results[$key]['total_admission'] = $total_admitted_count;
            $results[$key]['total_admission'] = $total_admitted_count + $total_NENV_count;
            $results[$key]['nri'] = $total_NRI_count;
            $results[$key]['ips'] = $total_IPS_count;
            $results[$key]['twf'] = $total_tfw_count;
            $results[$key]['pio'] = $total_PIO_count;
            $results[$key]['total_upgrade_candidate'] = $total_upgrade_count;
            $results[$key]['total_1st_upgrade_candidate'] = $total_1st_upgrade_count;
            $results[$key]['total_2nd_upgrade_candidate'] = $total_2nd_upgrade_count;
            $results[$key]['total_clc_cancelled'] = $total_CLC_cancel_count;
            $results[$key]['ne'] = $total_NENV_count;
            $results[$key]['admission'] = $admission1;

            $results[$key]['admission_upgrade'] = $admission2;
            $results[$key]['total_amount'] = $total_amount;

            $results[$key]['account_number'] = $account_number ?? '';
            $results[$key]['account_holder_name'] = $account_holder_name ?? '';
            $results[$key]['bank'] = $bank ?? '';
            $results[$key]['bank_branch'] = $branch ?? '';
            $results[$key]['ifsc'] = $ifsc ?? '';
            $results[$key]['nodal_officer_mobile_no'] = $nodal_officer_mobile_no ?? '';
            $results[$key]['asstt_nodal_officer_mobile_no'] = $asstt_nodal_officer_mobile_no ?? '';
        }
        return $results;
    }

    private function paymentTotalAdmittedCount($collegeCode): array
    {
        return Student::query()
            ->select(DB::raw('count(id) as total'))
            ->where('institute_user_name', $collegeCode)
            ->where('not_eligible', 1)
            ->get()->first()->toArray();
    }

    private function paymentTotalTfwCount($collegeCode): int
    {
        return Student::where('institute_user_name', $collegeCode)
            ->where('tuition_fee_waiver_status', 'Y')->count();
    }

    private function paymentTotalClcCancelCount($collegeCode): array
    {
        return Transaction::query()
            ->select(DB::raw('count(id) as total'))
            ->where('transaction_amount', 30)
            ->whereRaw('counselling_id_roll_no IN (select roll_number from students where institute_user_name = "' . $collegeCode . '" AND round = "CLC")')
            ->get()->first()->toArray();
    }

    private function paymentTotalUpgradeCount($collegeCode, $var = false): array
    {
        // Subquery 1: Count of total_upgrade_count
        // $totalUpgradeCount = Student::where('institute_user_name', $collegeCode)
        //     ->where('round', 'FU')
        //     ->where('tuition_fee_waiver_status', 'N')
        //     ->count();

        $totalUpgradeCount = Student::select('institute_user_name')
            ->where('round', '=', 'FU')
            ->where('tuition_fee_waiver_status', '=', 'N')
            ->where('students.institute_user_name', $collegeCode)
            ->whereIn(
                'roll_number',
                Transaction::select('counselling_id_roll_no')
                    ->where('transaction_amount', '=', '1030')
            )
            // ->toRawSql();
            ->count();
        // dd($totalUpgradeCount);
        // Subquery 2: Count of total_allotted
        $totalAllotted = Student::rightJoin('allotment_lists', 'students.roll_number', '=', 'allotment_lists.roll_number')
            ->where('students.institute_user_name', $collegeCode)
            ->where('students.round', 'FU')
            ->where('allotment_lists.allotted_category', 'FW/OP')
            //            ->where('students.tuition_fee_waiver_status', 'N')
            ->whereNull('allotment_lists.allotted_inst_code')
            // ->toRawSql();
            ->count();

        // dd($totalAllotted);
        // dd($totalUpgradeCount, $totalAllotted, $tot);
        // Calculate total
        $total = $totalUpgradeCount - $totalAllotted;
        $data['total'] = $total;
        if ($var)
            return $data;
        else
            return Student::query()
                ->select(DB::raw('count(id) as total'))
                ->where('institute_user_name', $collegeCode)
                ->where('round', 'FU')
                ->where('tuition_fee_waiver_status', 'N')
                ->get()->first()->toArray();
    }

    private function paymentTotalAllottedCount($collegeCode)
    {
        return AllotmentList::where('user_name', $collegeCode)->get()->count();
    }

    private function allotmentAdmissionRoundCount($collegeCode): array
    {
        // FR Admission Count
        $fr_admission = Student::where('institute_user_name', $collegeCode)
            ->whereIn('round', ['FR', 'RF', 'F'])
            ->count();

        // SR Admission Count
        $sr_admission = Student::where('institute_user_name', $collegeCode)
            ->whereIn('round', ['SR', 'RS', 'S'])
            ->count();

        // SL Admission Count
        $sl_admission = Student::where('institute_user_name', $collegeCode)
            ->where('round', 'SL')
            ->count();

        // FU Admission Count
        $fu_admission = Student::where('institute_user_name', $collegeCode)
            ->where('round', 'FU')
            ->count();

        // QL Admission Count
        $ql_admission = Student::where('institute_user_name', $collegeCode)
            ->whereIn('round', ['TR', 'T'])
            ->count();

        // FR Allotment Count
        $fr_allotment = AllotmentList::where('user_name', $collegeCode)
            ->whereIn('round', ['FR', 'RF', 'F'])
            ->count();

        // SR Allotment Count
        $sr_allotment = AllotmentList::where('user_name', $collegeCode)
            ->whereIn('round', ['SR', 'RS', 'S'])
            ->count();

        // SL Allotment Count
        $sl_allotment = AllotmentList::where('user_name', $collegeCode)
            ->where('round', 'SL')
            ->count();

        // UR Allotment Count (FU in original SQL)
        $ur_allotment = AllotmentList::where('user_name', $collegeCode)
            ->where('round', 'FU')
            ->count();

        // QL Allotment Count
        $ql_allotment = AllotmentList::where('user_name', $collegeCode)
            ->whereIn('round', ['TR', 'T', 'QR'])
            ->count();

        // Combine the results
        return [
            'fr_admission' => $fr_admission,
            'sr_admission' => $sr_admission,
            'sl_admission' => $sl_admission,
            'fu_admission' => $fu_admission,
            'ql_admission' => $ql_admission,
            'fr_allotment' => $fr_allotment,
            'sr_allotment' => $sr_allotment,
            'sl_allotment' => $sl_allotment,
            'ur_allotment' => $ur_allotment,
            'ql_allotment' => $ql_allotment,
        ];
    }

    private function totalUpgradedAdmissionCancelCount($collegeCode): array
    {

        $students = Student::where('institute_user_name', $collegeCode)
            ->whereIn('round', ['FU', 'SL'])
            ->get('roll_number')->toArray();


        // Subquery to count the records from allotment_lists for the 'FU' round
        $allotmentCount = AllotmentList::where('user_name', $collegeCode)
            ->whereIn('round', ['FU'])
            ->whereNotIn('roll_number', $students)
            ->count();

        // Subquery to count the records from students for the 'FU' round
        $studentCount = Student::where('institute_user_name', $collegeCode)
            ->whereIn('round', ['FU', 'SL'])
            ->count();
        // Calculate the difference
        $data['total'] = $allotmentCount;
        return $data;
    }

    private function getIpsCount($collegeCode)
    {
        return Student::where(['round' => 'IPS', 'institute_user_name' => $collegeCode])->count();
    }
}
