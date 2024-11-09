<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PasswordUpdateLivewireComponent extends Component
{
    public $old_password;
    public $new_password;
    public $new_password_confirmation;

    protected $rules = [
        'old_password' => 'required',
        'new_password' => 'required|confirmed|min:6',
    ];

    public function updatePassword()
    {
        $this->validate();

        $user = Auth::user();

        // Check if the old password is correct
        if (!Hash::check($this->old_password, $user->password)) {
            $this->addError('old_password', 'The old password is incorrect.');
            return;
        }

        // Fetch the last password from manage_passwords table
        $passwordRecord = DB::table('manage_passwords')->where('user_id', $user->id)->first();

        // Check if the new password matches the last used passwords
        if (
            Hash::check($this->new_password, $user->password) ||
            ($passwordRecord && Hash::check($this->new_password, $passwordRecord->last_password))
        ) {
            $this->addError('new_password', 'The new password cannot be the same as any of your previous passwords.');
            return;
        }

        // Update the user's password
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Update the manage_passwords table
        DB::table('manage_passwords')->updateOrInsert(
            ['user_id' => $user->id],
            ['last_password' => Hash::make($this->old_password), 'updated_at' => now()]
        );

        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        session()->flash('status', 'Password updated successfully. Please log in again.');

        return redirect()->route('login');
    }

}





