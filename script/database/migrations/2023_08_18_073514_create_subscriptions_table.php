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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_name')->nullable();
            $table->string('subscription_amount_month')->nullable();
            $table->string('subscription_amount_year')->nullable();
            $table->string('duration')->nullable()->comment('Days');
            $table->enum('status',['0','1'])->comment('0->Inactive 1->Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
