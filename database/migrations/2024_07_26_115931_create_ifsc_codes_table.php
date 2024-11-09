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
        Schema::create('ifsc_codes', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('ifsc_code');
            $table->string('branch_name');
            $table->longText('bank_address');
            $table->string('city1');
            $table->string('city2');
            $table->string('state');
            $table->integer('std_code');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ifsc_codes');
    }
};
