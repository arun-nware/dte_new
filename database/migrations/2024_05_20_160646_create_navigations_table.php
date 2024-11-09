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
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->integer('nav_id')->nullable();
            $table->string('nav_name')->nullable();
            $table->string('nav_route')->nullable(true)->default('#');
            $table->string('nav_type')->nullable(true)->default('main');
            $table->string('nav_permission')->nullable();
            $table->text('nav_icon')->nullable();
            $table->decimal('nav_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
};
