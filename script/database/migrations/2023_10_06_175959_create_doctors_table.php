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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->integer('org_id')->nullable();
            $table->integer('entry_id')->nullable();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('dob')->nullable();
            $table->string('degree_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('fees')->nullable();
            $table->enum('gender',['male','female'])->comment('male->Male female->Female');
            $table->string('image')->nullable();
            $table->text('address')->nullable();
            $table->enum('entry_by',['sa','user'])->comment('sa->Superadmin user->User');
            $table->enum('status',['0','1'])->comment('0->Inactive 1->Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
