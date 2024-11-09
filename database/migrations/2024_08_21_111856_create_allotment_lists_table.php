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
        Schema::create('allotment_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('common_rank')->nullable();
            $table->decimal('merit', 10, 2)->nullable()->default(0);
            $table->string('roll_number')->nullable()->index('student_roll_number');
            $table->string('name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('eligible_domicile')->nullable();
            $table->string('eligible_category')->nullable();
            $table->string('eligible_jk_residents')->nullable();
            $table->string('eligible_jk_migrants')->nullable();
            $table->boolean('fee_waiver')->nullable();
            $table->string('exam')->nullable();
            $table->integer('allotted_preference')->nullable();
            $table->string('allotted_inst_code')->nullable();
            $table->string('allotted_inst_name')->nullable();
            $table->string('allotted_inst_type')->nullable();
            $table->boolean('allotted_inst_fw')->nullable();
            $table->string('allotted_branch')->nullable();
            $table->string('allotted_domicile')->nullable();
            $table->string('allotted_category')->nullable();
            $table->string('user_name')->nullable()->index('college_user_name');
            $table->string('dte_college_code')->nullable();
            $table->string('round')->nullable();
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
        Schema::dropIfExists('allotment_lists');
    }
};
