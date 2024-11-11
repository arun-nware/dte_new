<div>
    <?php if (isset($component)) { $__componentOriginald5d051f243b37508d39f8ce3d92a5684 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5d051f243b37508d39f8ce3d92a5684 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.loader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('loader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5d051f243b37508d39f8ce3d92a5684)): ?>
<?php $attributes = $__attributesOriginald5d051f243b37508d39f8ce3d92a5684; ?>
<?php unset($__attributesOriginald5d051f243b37508d39f8ce3d92a5684); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5d051f243b37508d39f8ce3d92a5684)): ?>
<?php $component = $__componentOriginald5d051f243b37508d39f8ce3d92a5684; ?>
<?php unset($__componentOriginald5d051f243b37508d39f8ce3d92a5684); ?>
<?php endif; ?>
    <?php
        use Carbon\Carbon;
        use App\Traits\EmployeeActivationDescription;
    ?>
    <main>
        <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => ['title' => 'Payment Reports']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Payment Reports']); ?>
            <li>
                <a href="#" wire:click="export" class="btn btn-purple text-light"><i class="fa fa-download mr5"></i>
                    Export</a>
            </li>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>

        <section class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-2 form-inline">
                        Per Page:
                        <select wire:model="perPage" class="form-control" wire:click="filter">
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>All</option>
                        </select>
                    </div>
                    <div class="col-7">
                        <!--[if BLOCK]><![endif]--><?php if(!empty($exports)): ?>
                            <button type="button" class="btn btn-dark float-end" wire:click="export">
                                <i class="fa fa-download"></i>
                                Excel
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="col-3 float-end">
                        <p></p>
                        <div class="btn-group">
                            <input wire:model.live="search" class="form-control" type="text" placeholder="Search...">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="na_datatable" class="table table-bordered table-striped text-center table-sm"
                        width="100%">
                        <thead>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td width="10%">Course</td>
                                <td width="10%">Username</td>
                                <td width="10%">Institute Name</td>
                                <td width="10%">Intake</td>
                                <td width="10%">Total Allotted (All Centralized Rounds)(Except NRI IPS CLC PIO)</td>
                                <td width="10%">Total Admission Cancelled/Not Reported/Not Alloted (Centralized
                                    Round)
                                    (Except
                                    NRI IPS CLC PIO and upgraded round)
                                </td>
                                <td width="10%">Admission Cancelled/Not Reported(Upgraded Candidate)</td>
                                <td width="10%">Total Admissions</td>
                                <td width="10%">NRI</td>
                                <td width="10%">IPS</td>
                                <td width="10%">TFW</td>
                                <td width="10%">PIO/FN</td>
                                <td width="10%">Upgrade Count</td>
                                <td width="10%">Admitted in 1st upgrade allotment (Applied in 1st upgrade)</td>
                                <td width="10%">Admitted in 2nd upgrade allotment (Applied only in 2nd upgrade)</td>
                                <td width="10%">Admitted in 2nd upgrade allotment (Applied both 1st and 2nd upgrade)
                                </td>
                                <td width="10%">CLC_Cancelled</td>
                                <td width="10%">NE/NV</td>
                                <td width="10%">Admission - (NRI,IPS,CLC Cancl,NE/NV, upgrade)</td>
                                <td width="10%">Admission + UpgradeCount - (NRI,IPS,CLC Cancl,NE/NV, TFW,PIO)</td>
                                <td width="10%">Tuition Fee for Payment</td>
                                <td width="10%">Account No.</td>
                                <td width="10%">Account Holder Name</td>
                                <td width="10%">Bank</td>
                                <td width="10%">Branch</td>
                                <td width="10%">IFSC CODE</td>
                                <td width="10%">Nodal Officer Mobile No</td>
                                <td width="10%">Ast Nodal Officer Mobile No</td>
                            </tr>

                            <?php foreach ($paymentReports as $result): ?>
                            <tr>
                                <td><?= $result['course'] ?></td>
                                <td><?= $result['college_code'] ?></td>
                                <td><?= $result['college_name'] ?></td>
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
                                <td><?= $result['account_holder_name'] ?></td>
                                <td><?= $result['bank'] ?></td>
                                <td><?= $result['bank_branch'] ?></td>
                                <td><?= $result['ifsc'] ?></td>
                                <td><?= $result['nodal_officer_mobile_no'] ?></td>
                                <td><?= $result['asstt_nodal_officer_mobile_no'] ?></td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <div>
                    <p>
                        Showing <?php echo e($paymentReports->firstItem()); ?> to <?php echo e($paymentReports->lastItem()); ?> out
                        of <?php echo e($paymentReports->total()); ?>

                        items
                    </p>
                    <p>
                        <?php echo e($paymentReports->links()); ?>

                    </p>
                </div>
            </div>
        </section>

    </main>
</div>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/livewire/reports/payment-report-livewire-component.blade.php ENDPATH**/ ?>