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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('course')->nullable();
            $table->string('course_name')->nullable();
            $table->string('round')->nullable();
            $table->string('counselling_round')->nullable();
            $table->string('counselling_id_roll_no')->nullable()->index('student_roll_number');
            $table->string('counselling_activity')->nullable();
            $table->string('trans_id')->nullable();
            $table->date('transaction_date')->nullable();
            $table->decimal('transaction_amount', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('remark')->nullable();
            $table->string('paid_status')->nullable();
            $table->string('cancelled_status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
