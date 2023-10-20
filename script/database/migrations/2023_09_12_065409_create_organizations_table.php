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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_name')->nullable();
            $table->string('org_address')->nullable();
            $table->string('org_mobile')->nullable();
            $table->string('org_fax')->nullable();
            $table->string('org_email')->nullable();
 	        $table->string('org_registration_no')->nullable();
            $table->string('org_gst_no')->nullable();
	        $table->string('org_abbreviation')->nullable();
            $table->string('org_logo')->nullable();
            $table->string('org_lhead')->nullable();
            $table->string('org_lfooter')->nullable();
            $table->enum('status',['0','1'])->comment('0->Inactive 1->Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
