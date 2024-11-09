<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('college_account_details', function (Blueprint $table) {
            $table->id();
            $table->string('institute_name')->nullable();
            $table->string('institute_type')->nullable();
            $table->string('address')->nullable();
            $table->string('user_name')->nullable()->index('college_user_name');
            $table->string('aicte_code')->nullable()->index('college_aicte_code');
            $table->string('fax')->nullable();
            $table->string('institute_contact_no')->nullable();
            $table->string('institute_email')->nullable();
            $table->string('chairman_name')->nullable();
            $table->string('chairman_mobile_no')->nullable();
            $table->string('chairman_email_id')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('secretary_mobile_no')->nullable();
            $table->string('secretary_email_id')->nullable();
            $table->string('director_name')->nullable();
            $table->string('director_mobile_no')->nullable();
            $table->string('director_email_id')->nullable();
            $table->string('nodal_officer_name')->nullable();
            $table->string('nodal_officer_mobile_no')->nullable();
            $table->string('nodal_officer_email_id')->nullable();
            $table->string('asstt_nodal_officer_name')->nullable();
            $table->string('asstt_nodal_officer_mobile_no')->nullable();
            $table->string('asstt_nodal_officer_email_id')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('account_number')->nullable();
            $table->date('last_modified_date')->nullable();
            $table->string('course')->nullable();
            $table->year('year')->nullable();
            $table->integer('file_upload_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_account_details');
    }
};
