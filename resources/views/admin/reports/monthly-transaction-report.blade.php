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
        <table>
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
            <th>Advice Generation Date</th>
            <th>Transaction Creation Date</th>
            <th>Payment Approval Date</th>
            <th>Payment Processing Date</th>
            <th>Hospital Code</th>
            <th>Hospital Description</th>
            <th>Case ID</th>
            <th>Beneficiary Name</th>
            <th>Beneficiary Acc No</th>
            <th>Beneficiary Code</th>
            <th>Beneficiary IFSC Code</th>
            <th>Amount</th>
            <th>Procedure Name</th>
            <th>Procedure Type</th>
            <th>Debit Acc No</th>
            <th>Designation Groups</th>
            <th>Payment Remarks</th>
            <th>Transfer Mode</th>
            <th>Credit Ref No</th>
            <th>Bank Ref No</th>
            <th>Response Transaction Status</th>
            <th>IDP Status</th>
            <th>Transaction Remarks</th>
            <th>Payment Remarks</th>
            <th>Medical College Fund (MCF)/ Incentive</th>
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
