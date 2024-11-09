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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable(true);
            $table->string('site_address')->nullable(true);
            $table->string('site_contact')->nullable(true);
            $table->string('site_email')->nullable(true);
            $table->string('weekdays')->nullable(true);
            $table->string('weekends')->nullable(true);
            $table->string('default_date_format')->nullable(true);
            $table->string('shift_hours')->nullable(true);
            $table->string('ticket_print')->nullable(true);
            $table->integer('password_reset_interval')->nullable(true);
            $table->string('operational_from')->nullable(true);
            $table->string('operational_to')->nullable(true);
            $table->string('eod_report_time')->nullable(true);
            $table->string('company_name')->nullable(true);
            $table->string('company_address')->nullable(true);
            $table->string('gst_in')->nullable(true);
            $table->string('pan')->nullable(true);
            $table->string('cin')->nullable(true);
            $table->string('hsn_code')->nullable(true);
            $table->string('city_of_supply')->nullable(true);
            $table->string('state_name_code')->nullable(true);
            $table->string('description_service')->nullable(true);
            $table->string('prefix_for_invoice')->nullable(true);
            $table->string('signature_image')->nullable(true);
            $table->string('property_logo')->nullable(true);
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
        Schema::dropIfExists('settings');
    }
};
