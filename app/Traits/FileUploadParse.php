<?php

namespace App\Traits;

use App\Enums\PaymentTransactionProcessEnums;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait FileUploadParse
{
    function getDataTxtFile($file_path, $explode_by = '<br />'): array|bool
    {
        if (file_exists($file_path)) {
            $data = file_get_contents($file_path);
            $data1 = nl2br($data);
            return explode($explode_by, $data1);
        }
        return false;
    }

    public function setupTextFileForH2hProcess($paymentReferenceNo, $caseID, $procedureCode, $hospitalID, $hospitalAccountName, $hospitalAccountNo, $employeeAccountName, $employeeAccountNo, $employeeAccountIFSC, $amount, $paymentDate, $paymentType, $paymentRemark, $mobile, $email, $distributionRemark, $remarkType = 'Hospital Fund', $designationGroup = '', $designationCode = ''): string
    {
        $currentDate = date("d/m/Y");
        $paymentDate = date('d/m/Y', strtotime($paymentDate));
        return $paymentReferenceNo . '|' . $caseID . '|' . $procedureCode . '|' . $hospitalID . '|' . $hospitalAccountName . '|' . $hospitalAccountNo . '|' . $employeeAccountName . '|' . $employeeAccountNo . '|' . $employeeAccountIFSC . '|' . $amount . '|' . $paymentDate . '|' . $paymentType . '|' . $paymentRemark . '|' . $mobile . '|' . $email . '|' . $distributionRemark . '|' . $remarkType . '|' . $designationGroup . '|' . $designationCode . PHP_EOL;
    }

    public function updateFile($fileName, $text)
    {
        $file = fopen($fileName, "a");
        fwrite($file, $text);
        fclose($file);
    }

    public function calculateIncentive($Amount, $Percentage): float
    {
        try {
            $amount = ($Amount * $Percentage) / 100;
            return $this->truncateDecimal($amount, 2);
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function calculateIncentiveForEmployee($Amount, $count): float
    {
        try {
            $amount = ($Amount / $count);
            return $this->truncateDecimal($amount, 2);
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function truncateDecimal($number, $precision = 2): float
    {
        // Shift the decimal point to the right by the precision amount
        $factor = pow(10, $precision);

        // Truncate the number by casting it to an integer
        $truncatedNumber = (int)($number * $factor);

        // Shift the decimal point back to the left by the precision amount
        return $truncatedNumber / $factor;
    }

    public function saveReinitiatedPaymentTransaction($paymentID, $fileName, $text, $paymentReferenceNo, $caseID, $procedureCode, $hospitalID, $hospitalAccountName, $hospitalAccountNo, $employeeAccountName, $employeeAccountNo, $employeeAccountIFSC, $amount, $paymentDate, $paymentType, $paymentRemark, $mobile, $email, $distributionRemark, $remarkType, $designationGroup, $designationCode, $employeeID): bool
    {
        DB::beginTransaction();
        $filePath = '';
        try {
            $data = [
                "payment_id" => $paymentID,
                "employee_id" => $employeeID,
                "unique_reference_no" => $paymentReferenceNo,
                "case_id" => $caseID,
                "procedure_code" => $procedureCode,
                "hospital_id" => $hospitalID,
                "hospital_account_name" => $hospitalAccountName,
                "hospital_account_no" => $hospitalAccountNo,
                "employee_account_name" => $employeeAccountName,
                "employee_account_no" => $employeeAccountNo,
                "employee_account_ifsc" => $employeeAccountIFSC,
                "amount" => $amount,
                "payment_date" => Carbon::parse($paymentDate)->format('Y-m-d'),
                "payment_type" => $paymentType,
                "payment_remark" => $paymentRemark,
                "mobile" => $mobile,
                "email" => $email,
                "distribution_remark" => $distributionRemark,
                "payment_status" => PaymentTransactionProcessEnums::Created->value,
                "remark_type" => $remarkType,
                "designation_group" => $designationGroup,
                "designation_code" => $designationCode,
            ];

            if ($amount > 0) {
                $paymentTransaction = PaymentTransaction::create($data);

                if ($paymentTransaction === null) {
                    throw new \Exception("Payment can not created");
                }

                $text .= $this->setupTextFileForH2hProcess($paymentReferenceNo, $caseID, $procedureCode, $hospitalID, $hospitalAccountName, $hospitalAccountNo, $employeeAccountName, $employeeAccountNo, $employeeAccountIFSC, $amount, $paymentDate, $paymentType, $paymentRemark, $mobile, $email, $distributionRemark, $remarkType, $designationGroup, $designationCode);

                $filePath = $fileName;
                $this->updateFile($fileName, $text);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            unlink($filePath);
            return false;
        }

    }

    public function moveFile($path, $toDicrectory, $to): bool
    {
        if (!is_dir($toDicrectory)) {
            mkdir($toDicrectory, 0777, true);
        }
        if (file_exists($path)) {
            copy($path, $to);
            unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function makeDir($path): bool
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if (file_exists($path)) {
            return true;
        } else {
            return false;
        }
    }

    public function ifExcessExpenditureAmount($amount, $percentage, $excessAmount): float
    {
        if ($this->excess_expenditure_amount > 0) {
            return $this->calculateIncentive($amount, $percentage) - $excessAmount;
        }
        return $this->calculateIncentive($amount, $percentage);
    }
}
