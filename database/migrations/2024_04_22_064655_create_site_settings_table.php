<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('Nwaresoft Pvt. Ltd.')->nullable();
            $table->string('copyright')->default('Nwaresoft Pvt. Ltd.')->nullable();
            $table->string('currency')->default('INR')->nullable();
            $table->string('timezone')->default('Asia/Calcutta')->nullable();
            $table->string('favicon')->default('favicon.png')->nullable();
            $table->string('logo')->default('logo.png')->nullable();
            $table->year('financial_year')->default(date('Y'))->nullable();
            $table->boolean('status')->default(false)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
