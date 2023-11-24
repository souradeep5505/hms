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
        Schema::create('patient_registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('org_id')->nullable();
            $table->integer('depart_id')->nullable();
            $table->integer('doc_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->enum('gender',['male','female','others'])->comment('male->Male female->Female others->Others')->nullable();
            $table->enum('marital_status',['married','unmarried'])->comment('married->Married unmarried->Unmarried')->nullable();
            $table->string('lmp')->nullable();
            $table->enum('handed',['left','right'])->comment('left->Left right->Right')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('bs')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('bp_sy')->nullable();
            $table->string('bp_di')->nullable();
            $table->string('occupation')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('book_date')->nullable();
            $table->string('fees')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('due')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('comments')->nullable();
            $table->enum('status',['0','1'])->comment('0->Canceled 1->Booked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_registrations');
    }
};
