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
        Schema::create('cancelled_students', function (Blueprint $table) {
            $table->id();
            $table->string('course')->nullable();
            $table->string('roll_number')->nullable()->index('student_roll_number');
            $table->string('candidate_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('father_name')->nullable();
            $table->string('admitted_institute')->nullable();
            $table->string('institute_user_name')->nullable()->index('college_user_name');
            $table->string('admitted_branch')->nullable();
            $table->string('gender')->nullable();
            $table->string('university')->nullable();
            $table->string('tuition_fee_waiver_status')->nullable();
            $table->date('cancellation_date')->nullable();
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
        Schema::dropIfExists('cancelled_students');
    }
};
