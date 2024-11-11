<?php

use App\Http\Controllers\Auth\ConfirmableLoginOtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\Admin\DistrictLivewireComponent;
use App\Livewire\Admin\RegionLivewireComponent;
use App\Livewire\Admin\StateLivewireComponent;
use App\Livewire\UserManagement\RoleListLivewireComponent;
use App\Livewire\UserManagement\UserListLivewireComponent;
use App\Livewire\ContactUsLivewireComponent;
use App\Livewire\DashboardLivewireComponent;
use App\Livewire\GuidelinesLivewireComponent;
use App\Livewire\NavigationLivewireComponent;
use App\Livewire\Reports\IncentiveTransactionReportLivewireComponent;
use App\Livewire\Reports\MonthlyTransactionReportLivewireComponent;
use App\Livewire\Reports\TransactionReportLivewireComponent;
use App\Livewire\SiteSetting;
use App\Livewire\SubNavigationLivewireComponent;
use App\Livewire\UploadFileFormatLivewireComponent;
use App\Services\SFTPService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('confirm-otp', [ConfirmableLoginOtpController::class, 'show'])
        ->name('otp.create');
    Route::post('confirm-otp', [ConfirmableLoginOtpController::class, 'store'])
        ->name('otp.confirm');
    Route::get('resend-otp', [ConfirmableLoginOtpController::class, 'resend'])
        ->name('otp.resend');

    Route::middleware(['auth-otp-verified', 'check.password.expiry'])->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        /* Dashboard Start */
        Route::get('/dashboard', DashboardLivewireComponent::class)->name('dashboard');
        /* Dashboard End */

        /* College Start */
        Route::get('/colleges', \App\Livewire\CollegeLivewireComponent::class)->name('colleges');
        /* College End */

        /* Student Start */
        Route::get('/students', \App\Livewire\StudentLivewireComponent::class)->name('students');
        /* Student End */

        /* Transaction Start */
        Route::get('/transactions', \App\Livewire\TransactionLivewireComponent::class)->name('transactions');
        /* Transaction End */

        /* Users Permissions Start */
        Route::get('/users', UserListLivewireComponent::class)->name('users')->middleware('can:user_management');
        Route::get('/access_managements', RoleListLivewireComponent::class)->name('access_managements')->middleware('can:access_management');
        /* Users Permissions End */

        /* Reports Start */
        Route::middleware(['can:reports'])->as('report.')->group(function () {
            Route::get('/payment_report', \App\Livewire\Reports\PaymentReportLivewireComponent::class)->name('payment_report')->middleware('can:transaction_report');
            //Route::get('/incentive_report', IncentiveTransactionReportLivewireComponent::class)->name('incentive_report')->middleware('can:incentive_report');
            //Route::get('/monthly_report', MonthlyTransactionReportLivewireComponent::class)->name('monthly_report')->middleware('can:monthly_report');
            //Route::get('/consolidated_incentive_distribution_employee_report', NavigationLivewireComponent::class)->name('consolidated_incentive_distribution_employee_report')->middleware('can:consolidated_incentive_distribution_employee_report');
        });
        /* Reports End */

        /* Administration Start */
        Route::middleware(['can:administration'])->as('administration.')->group(function () {

            /* Users Permissions Start */
            Route::middleware(['can:users_permissions'])->group(function () {
                Route::get('/user_management', UserListLivewireComponent::class)->name('user_management')->middleware('can:user_management');
                Route::get('/access_management', RoleListLivewireComponent::class)->name('access_management')->middleware('can:access_management');
            });
            /* Users Permissions End */

            Route::get('/regions', RegionLivewireComponent::class)->name('region')->middleware('can:region');
            Route::get('/states', StateLivewireComponent::class)->name('state')->middleware('can:state');
            Route::get('/districts', DistrictLivewireComponent::class)->name('district')->middleware('can:district');

        });
        /* Administration End */


        Route::get('/site-setting', SiteSetting::class)->name('site-setting')->middleware('can:site_setting_index');
        Route::get('/navigations', NavigationLivewireComponent::class)->name('navigations')->middleware('can:navigations');
        Route::get('/navigations/{id}', SubNavigationLivewireComponent::class)->name('sub.navigations')->middleware('can:navigations');

    });

    Route::get('/contact-us', ContactUsLivewireComponent::class)->name('contact-us');
    Route::get('/guidelines', GuidelinesLivewireComponent::class)->name('guidelines');
    Route::get('/download-formats', UploadFileFormatLivewireComponent::class)->name('download-formats');
    Route::get('/notifications', \App\Livewire\NotificationLivewireComponent::class)->name('notifications');


});

Route::get('/employees/{id}/verify', [DashboardController::class, 'verify'])->name('verify');
Route::get('/employees/{id}/approve', [DashboardController::class, 'approve'])->name('approve');
Route::get('/employees/{id}/reject', [DashboardController::class, 'reject'])->name('reject');


// manage password
//Route::get('/password-update', PasswordUpdateLivewireComponent::class)->name('password.update.form');


Route::get('/ftp', function () {
    $sftpService = new SFTPService(
        "host2host.icicibank.com",
        4446,
        "PMJAYHAR_ici",
        "Ayush@0708"
    );

    $list = $sftpService->listFiles('/cmsips/SFTP/PMJAYHAR/PMJAYHAR_COPY/PMJAYHARCOPY_Out');
    dd($sftpService, $list);
});
require __DIR__ . '/auth.php';


