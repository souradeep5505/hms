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
        Schema::create('doctors_times', function (Blueprint $table) {
            $table->id();
            $table->integer('org_id')->nullable();
            $table->integer('doc_id')->nullable();
            $table->enum('opt',['day','week','month'])->comment('day->day week->week month->month')->nullable();
            $table->string('value')->nullable();
            $table->string('slot')->nullable();
            $table->enum('status',['0','1'])->comment('0->Inactive 1->Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_times');
    }
};
