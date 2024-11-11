<div class="table-responsive">
    @if ($filter)
        <style>
            thead th {
                font-size: 14px;
                font-family: Calibri, serif;
                font-weight: bold;
                background-color: #007fff;
            }
        </style>
        <table class="table table-hover">
            <tbody>
            <tr>
                <td align="center" colspan="12" style="font-size: 14px; font-family: Calibri;background-color: #0c84ff">
                    <b>Transaction Report</b>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="4"
                    style="font-size: 14px; font-family: Calibri,serif;background-color: #ffba0c"><b> Operator
                        : {{ $input['operator'] }} </b></td>
            </tr>
            <tr>
                <td align="center" colspan="4"
                    style="font-size: 14px; font-family: Calibri,serif;background-color: #ffba0c"><b> Payment Txn Id
                        : {{ $input['paymentTxnId'] }} </b></td>
                <td align="center" colspan="4"
                    style="font-size: 14px; font-family: Calibri,serif;background-color: #ffba0c"><b> Payment Method
                        : {{ $input['paymentMethod'] }} </b></td>

            </tr>
            <tr>
                <td align="center" colspan="4"
                    style="font-size: 14px; font-family: Calibri,serif;background-color: #ffba0c"><b> Start Date
                        : {{ $input['start_date'] }} </b></td>
                <td align="center" colspan="4"
                    style="font-size: 14px; font-family: Calibri,serif;background-color: #ffba0c"><b> End Date
                        : {{ $input['end_date'] }} </b></td>

            </tr>
            </tbody>
        </table>
    @endif
    <table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">
        <thead>
        <tr>
            <th>Unique Ref No</th>
            <th>Case ID</th>
            <th>Hospital ID</th>
            <th>Procedure Code</th>
            <th>Hospital Account Name</th>
            <th>Hospital Account No</th>
            <th>Beneficiary Account Name</th>
            <th>Beneficiary Account IFSC</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Payment Type</th>
            <th>Payment Remark</th>
            <th>Mobile no</th>
            <th>Email ID</th>
            <th>Distribution Remark</th>
            <th>Incentive Remark</th>
            <th>Designation Group</th>
            <th>Designation Code</th>
            <th>Payment Ref No</th>
            <th>Status</th>
            <th>Liquidation Date</th>
            <th>Customer Ref No</th>
            <th>Remarks</th>
            <th>Date</th>
            <th>Maker ID</th>
            <th>File Name</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 1;@endphp
        @foreach($allTransactions as $transaction)
            <tr>
                <td>{{ $transaction['created_at'] }}</td>
                <td>{{ $transaction['transaction_date'] }}</td>
                <td>{{ $transaction['case_id'] }}</td>
                <td>{{ $transaction['beneficiary_account_name'] }}</td>
                <td>{{ $transaction['beneficiary_account_number'] }}</td>
                <td>{{ $transaction['transaction_amount'] }}</td>
                <td>{{ $transaction['payment_mode'] }}</td>
                <td>{{ $transaction['hospital_id'] }}</td>
                <td>{{ $transaction['hospital_name'] }}</td>
                <td>{{ $transaction['credit_narration'] }}</td>
                <td>{{ $transaction['payment_reference_no'] }}</td>
                <td>{{ $transaction['status'] }}</td>
                <td>{{ $transaction['status'] }}</td>
                <td>{{ $transaction['procedure_code'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
