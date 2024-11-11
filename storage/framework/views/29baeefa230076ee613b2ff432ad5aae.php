<div>
    <!--[if BLOCK]><![endif]--><?php if(session('password_expired')): ?>
        <!-- Overlay -->
        <div class="modal-backdrop"
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1040;">
        </div>

        <!-- Modal -->
        <div class="modal show" style="display: block; z-index: 1050;" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title m-0">Update Password</h3>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updatePassword">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" wire:model="old_password" class="form-control">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" wire:model="new_password" class="form-control">
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" wire:model="new_password_confirmation" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\Herd\Nwaresoft\dte\resources\views/livewire/password-update-livewire-component.blade.php ENDPATH**/ ?>