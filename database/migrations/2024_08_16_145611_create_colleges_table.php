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
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('course')->nullable();
            $table->string('inst_name')->nullable();
            $table->string('AICTE_code')->nullable()->index('college_aicte_code');
            $table->integer('inst_count')->nullable();
            $table->string('user_name')->nullable()->index('college_user_name');
            $table->string('branch_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('institute_type')->nullable();
            $table->integer('total_st_seats')->nullable();
            $table->integer('total_sc_seats')->nullable();
            $table->integer('total_obc_seats')->nullable();
            $table->integer('total_ur_seats')->nullable();
            $table->integer('nri_seats')->nullable();
            $table->integer('ips_seats')->nullable();
            $table->integer('fw_seats')->nullable();
            $table->integer('fw_admission')->nullable();
            $table->integer('ews_seats')->nullable();
            $table->integer('ews_admission')->nullable();
            $table->integer('ai_jk_resident_seats')->nullable();
            $table->integer('ai_jk_migrants_seats')->nullable();
            $table->integer('intake')->nullable();
            $table->integer('intake_with_ews')->nullable();
            $table->integer('total_admitted_male')->nullable();
            $table->integer('total_admitted_female')->nullable();
            $table->integer('total_admitted')->nullable();
            $table->integer('st_female_admitted')->nullable();
            $table->integer('st_male_admitted')->nullable();
            $table->integer('total_st_admitted')->nullable();
            $table->integer('sc_female_admitted')->nullable();
            $table->integer('sc_male_admitted')->nullable();
            $table->integer('total_sc_admitted')->nullable();
            $table->integer('obc_female_admitted')->nullable();
            $table->integer('obc_male_admitted')->nullable();
            $table->integer('total_obc_admitted')->nullable();
            $table->integer('ur_female_admitted')->nullable();
            $table->integer('ur_male_admitted')->nullable();
            $table->integer('total_ur_admitted')->nullable();
            $table->year('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
