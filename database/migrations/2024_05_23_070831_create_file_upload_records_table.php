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
        Schema::create('file_upload_records', function (Blueprint $table) {
            $table->id();
            $table->string('module_type')->nullable(true);
            $table->string('file_title')->nullable(true);
            $table->string('file_name')->nullable(true);
            $table->integer('total_records')->nullable(true)->default(0);
            $table->integer('total_uploaded')->nullable(true)->default(0);
            $table->integer('total_failed')->nullable(true)->default(0);
            $table->integer('created_by')->nullable(true);
            $table->longText('errors')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_upload_records');
    }
};
