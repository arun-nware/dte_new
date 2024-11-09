<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reqDate' => 'required',
            'reqTime' => 'required',
            'userName' => 'required',
            'userType' => 'required',
            'modeOfPayment' => 'required',
            'TotalAmount' => 'required',
            'DiscountAmount' => 'required',
            'NetAmount' => 'required',
            'output' => 'required|array',
            'txnId' => ['required', Rule::unique('transactions', 'transaction_id')->ignore($request['txnId'])->whereNull('deleted_at')],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorData = [
                "response" => "FAILED",
                "respCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "resDate" => date("Ymd"),
                "resTime" => date("His"),
                "errors" => $errors
            ];
            return \response($errorData);
        }
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                "in_date" => date("Y-m-d", strtotime($request['reqDate'])),
                "in_time" => date("H:i:s", strtotime($request['reqTime'])),
                "user_id" => auth('api')->user()->id,
                "transaction_id" => $request['txnId'],
                "payment_mode" => $request['modeOfPayment'],
                "auth_code" => $request['authCode'],
                "card_first" => $request['cardFirst'],
                "card_last" => $request['cardLast'],
                "rrn" => $request['rrn'],
                "vpa" => $request['vpa'],
                "total_amount" => $request['TotalAmount'],
                "discount_amount" => $request['DiscountAmount'],
                "net_amount" => $request['NetAmount'],
                "discount_code" => $request['DiscountCode'],
                "output" => json_encode($request['output']),
                "created_by" => auth('api')->user()->id,
            ]);

            if ($transaction) {
                $successData = [
                    "response" => "SUCCESS",
                    "respCode" => Response::HTTP_CREATED,
                    "resDate" => date("Ymd"),
                    "resTime" => date("His")
                ];
                $data = array_merge($request->all(), $successData);
                DB::commit();
                return response($data);
            }
            DB::rollBack();
            throw new \Exception('Transaction not created');

        } catch (\Exception $e) {
            $successData = [
                "response" => "FAILED",
                "respCode" => Response::HTTP_BAD_REQUEST,
                "resDate" => date("Ymd"),
                "resTime" => date("His")
            ];
            $data = array_merge($request->all(), $successData);
            DB::rollBack();
            return response($data);
        }

    }

    public function searchTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reqDate' => 'required',
            'reqTime' => 'required',
            'userName' => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
            'fromTime' => 'required',
            'toTime' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorData = [
                "response" => "FAILED",
                "respCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "resDate" => date("Ymd"),
                "resTime" => date("His"),
                "errors" => $errors
            ];
            return \response($errorData);
        }

        $fromDate = date("Y-m-d", strtotime($request['fromDate']));
        $toDate = date("Y-m-d", strtotime($request['toDate']));
        $fromTime = date("H:i:s", strtotime($request['fromTime']));
        $toTime = date("H:i:s", strtotime($request['toTime']));
        $fromDate = $fromDate . ' ' . $fromTime;
        $toDate = $toDate . ' ' . $toTime;
        try {
            $transactions = Transaction::select(DB::raw('"MOP" as summaryType'), DB::raw("sum(net_amount) as totalSaleVolume"), 'payment_mode as methodOfPayment', DB::raw("count(id) as count"))
                ->where('user_id', auth('api')->user()->id);

            if ($fromDate != '' && $toDate != '') {
                $transactions->whereBetween('created_at', [$fromDate, $toDate]);
            }

            $transactions = $transactions->groupBy('payment_mode')->get()->toArray();
            $output = [];
            $amount = 0;
            $count = 0;
            foreach ($transactions as $key => $value) {
                $output[$key] = $value;
                $amount += $value['totalSaleVolume'];
                $count += $value['count'];
            }


            if (!empty($output)) {
                $summaryType = [[
                    "summaryType" => "TOTAL",
                    "totalSaleVolume" => $amount,
                    "methodOfPayment" => "",
                    "count" => $count
                ]];
                $output = array_merge($output, $summaryType);
            }

            $successData = [
                "output" => $output,
                "response" => "SUCCESS",
                "respCode" => Response::HTTP_ACCEPTED,
                "resDate" => date("Ymd"),
                "resTime" => date("His")
            ];
            $data = array_merge($request->all(), $successData);
            return \response($data);
        } catch (\Exception $e) {
            $successData = [
                "response" => "FAILED",
                "respCode" => Response::HTTP_BAD_REQUEST,
                "resDate" => date("Ymd"),
                "resTime" => date("His")
            ];
            $data = array_merge($request->all(), $successData);
            return response($data);
        }

    }
}
