<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to allow truncating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = collect([
            "dashboard",
            "search",
            "search_payments",
            "search_payment_create",
            "search_payment_view",
            "search_payment_delete",
            "search_payment_expenditure_details",
            "search_payment_expenditure_rejected",
            "search_approvals",
            "search_approvals_approved",
            "search_approvals_view",
            "search_approvals_delete",
            "claim_upload",
            "claim_upload_import",
            "reverse_file_upload",
            "reverse_file_upload_import",

            "employee",
            "employee_verification",
            "employee_transfer",
            "employee_transfer_access",

            "register",
            "register_case_id",
            "register_case_id_create",
            "register_case_id_edit",
            "register_case_id_view",
            "register_case_id_delete",
            "register_procedure_code",
            "register_procedure_code_create",
            "register_procedure_code_edit",
            "register_procedure_code_view",
            "register_procedure_code_delete",
            "register_designation_code",
            "register_designation_code_create",
            "register_designation_code_edit",
            "register_designation_code_view",
            "register_designation_code_delete",
            "payment",
            "manage_payment",
            "manage_payment_download",
            "manage_payment_download_encrypted",
            "manage_rejected_payment",
            "manage_payment_rejected_transferred",
            "reports",
            "transaction_report",
            "incentive_report",
            "monthly_report",
            "consolidated_incentive_distribution_employee_report",
            "administration",
            "users_permissions",
            "user_management",
            "user_management_create",
            "user_management_edit",
            "user_management_view",
            "user_management_delete",
            "access_management",
            "access_management_create",
            "access_management_edit",
            "access_management_view",
            "access_management_delete",
            "system_configuration",
            "support_document_configuration",
            "support_document_configuration_create",
            "support_document_configuration_edit",
            "support_document_configuration_view",
            "support_document_configuration_delete",
            "notification",
            "notification_create",
            "notification_edit",
            "notification_view",
            "notification_delete",
            "master_configuration",
            "medical_college_management",
            "medical_college_management_create",
            "medical_college_management_edit",
            "medical_college_management_view",
            "medical_college_management_delete",
            "hospital_management",
            "hospital_management_create",
            "hospital_management_edit",
            "hospital_management_view",
            "hospital_management_delete",
            "employee_management",
            "employee_management_create",
            "employee_management_edit",
            "employee_management_view",
            "employee_management_delete",
            "procedure",
            "procedure_create",
            "procedure_edit",
            "procedure_view",
            "procedure_delete",
            "procedure_type",
            "procedure_type_create",
            "procedure_type_edit",
            "procedure_type_view",
            "procedure_type_delete",
            "designation",
            "designation_create",
            "designation_edit",
            "designation_view",
            "designation_delete",
            "designation_group",
            "designation_group_create",
            "designation_group_edit",
            "designation_group_view",
            "designation_group_delete",
            "incentive_shares",
            "incentive_shares_create",
            "incentive_shares_edit",
            "incentive_shares_view",
            "incentive_shares_delete",
            "incentive_distribution",
            "incentive_distribution_create",
            "incentive_distribution_edit",
            "incentive_distribution_view",
            "incentive_distribution_delete",
            "miscellaneous",
            "file_uploads",
            "file_upload_download",
            "stored_files",
            "file_upload_create",
//            "region",
//            "state",
//            "state_create",
//            "state_edit",
//            "state_view",
//            "state_delete",
//            "district",
//            "district_create",
//            "district_edit",
//            "district_view",
//            "district_delete",
//            "site_setting",
//            "navigation"
        ]);

        $permissions->each(function ($permission) {
            Permission::firstOrCreate([
                "name" => $permission,
                "guard_name" => "web"
            ]);
        });
    }
}
