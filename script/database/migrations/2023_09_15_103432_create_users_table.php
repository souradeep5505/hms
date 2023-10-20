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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('user_id')->nullable();
            $table->string('password')->nullable();
            $table->longText('additional_data')->nullable();
            $table->string('reset_password')->nullable();
            $table->integer('roll_id')->nullable();
            $table->integer('org_id')->nullable();
            $table->enum('status',['0','1'])->comment('0->Inactive 1->Active');
            $table->enum('is_delete',['N','Y'])->comment('N->NO Y->Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
