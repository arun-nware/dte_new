<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Traits\TariffConfigurationTrait;
use Carbon\Carbon;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $adultGraphCount = [];
        $childGraphCount = [];
        $bothGraphCount = [];
        $getTimeSlots = 0;
        $totalAdult = 0;
        $totalChild = 0;
        $totalIncome = 0;
        $lastSevenDaysIncome = 0;

        return view('dashboard', compact('childGraphCount', 'adultGraphCount', 'bothGraphCount', 'totalAdult', 'totalChild', 'totalIncome', 'lastSevenDaysIncome'));
    }

    public function verify(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $employee_id = $decryptedId;
            $employee = DB::table('employees')->where('id', $decryptedId)->first();
            if (!$employee) {
                abort(404, 'Employee not found');
            }
        } catch (\Exception $e) {
            abort(404, 'Invalid ID');
        }
        return view('livewire.employee.employee-verify', compact('employee'));
    }
    public function approve(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            DB::table('employees')->where('id', $decryptedId)->update(['is_approved' => 1]);
            $request->session()->flash('alert', 'Employee approved successfully.');
            return redirect()->route('employee.verification');
        } catch (\Exception $e) {
            abort(404, 'Invalid ID');
        }
    }

    public function reject(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            DB::table('employees')->where('id', $decryptedId)->update(['is_approved' => 2]);
            $request->session()->flash('alert', 'Employee rejected.');
            return redirect()->route('employee.verification');
        } catch (\Exception $e) {
            abort(404, 'Invalid ID');
        }
    }
}
