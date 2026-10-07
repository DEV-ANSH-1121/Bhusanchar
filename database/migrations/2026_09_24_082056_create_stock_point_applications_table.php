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
        Schema::create('stock_point_applications', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->string('business_name');
            $table->string('email');
            $table->string('mobile', 20);
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('block')->nullable();
            $table->string('panchayat')->nullable();
            $table->longText('business_address')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->text('admin_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_point_applications');
    }
};
