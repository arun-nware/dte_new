    <table>
        <thead>
            <tr>
                <th>Course</th>
                <th>Username</th>
                <th>Institute Name</th>
                <th>Intake</th>
                <th>Total Allotted (All Centralized Rounds)(Except NRI IPS CLC PIO)</th>
                <th>Total Admission Cancelled/Not Reported/Not Alloted (Centralized
                    Round)
                    (Except
                    NRI IPS CLC PIO and upgraded round)
                </th>
                <th>Admission Cancelled/Not Reported(Upgraded Candidate)</th>
                <th>Total Admissions</th>
                <th>NRI</th>
                <th>IPS</th>
                <th>TFW</th>
                <th>PIO/FN</th>
                <th>Upgrade Count</th>
                <th>Admitted in 1st upgrade allotment (Applied in 1st upgrade)</th>
                <th>Admitted in 2nd upgrade allotment (Applied only in 2nd upgrade)</th>
                <th>Admitted in 2nd upgrade allotment (Applied both 1st and 2nd upgrade)
                </th>
                <th>CLC_Cancelled</th>
                <th>NE/NV</th>
                <th>Admission - (NRI,IPS,CLC Cancl,NE/NV, upgrade)</th>
                <th>Admission + UpgradeCount - (NRI,IPS,CLC Cancl,NE/NV, TFW,PIO)</th>
                <th>Tuition Fee for Payment</th>
                <th>Account No.</th>
                <th>Account Holder Name</th>
                <th>Bank</th>
                <th>Branch</th>
                <th>IFSC CODE</th>
                <th>Nodal Officer Mobile No</th>
                <th>Ast Nodal Officer Mobile No</th>
            </tr>

        </thead>
        <tbody>

            <?php

            if(!empty($paymentReports)):
            foreach ($paymentReports as $result): ?>
            <tr>
                <td><?= $result['course'] ?></td>
                <td><?= $result['college_code'] ?></td>
                <td><?= Illuminate\Support\Str::swap(['&' => 'And'], $result['college_name']) ?></td>
                <td><?= $result['total_intake'] ?></td>
                <td><?= $result['total_allocated'] ?></td>
                <td><?= $result['total_allocated_cancelled'] ?></td>
                <td><?= $result['total_cancelled_upgrade_candidate'] ?></td>
                <td><?= $result['total_admission'] ?></td>
                <td><?= $result['nri'] ?></td>
                <td><?= $result['ips'] ?></td>
                <td><?= $result['twf'] ?></td>
                <td><?= $result['pio'] ?></td>
                <td><?= $result['total_upgrade_candidate'] ?></td>
                <td><?= $result['total_1st_upgrade_candidate'] ?></td>
                <td><?= $result['total_2nd_upgrade_candidate'] ?></td>
                <td><?= $result['total_2nd_upgrade_candidate'] ?></td>
                <td><?= $result['total_clc_cancelled'] ?></td>
                <td><?= $result['ne'] ?></td>
                <td><?= $result['admission'] ?></td>
                <td><?= $result['admission_upgrade'] ?></td>
                <td><?= $result['total_amount'] ?></td>
                <td><?= $result['account_number'] ?></td>
                <td><?= Illuminate\Support\Str::swap(['&' => 'And'], $result['account_holder_name']) ?></td>
                <td><?= Illuminate\Support\Str::swap(['&' => 'And'], $result['bank']) ?></td>
                <td><?= Illuminate\Support\Str::swap(['&' => 'And'], $result['bank_branch']) ?></td>
                <td><?= $result['ifsc'] ?></td>
                <td><?= $result['nodal_officer_mobile_no'] ?></td>
                <td><?= $result['asstt_nodal_officer_mobile_no'] ?></td>
            </tr>
            <?php
            endforeach;
        endif;
        // dd($paymentReports);
            ?>

        </tbody>
    </table>
