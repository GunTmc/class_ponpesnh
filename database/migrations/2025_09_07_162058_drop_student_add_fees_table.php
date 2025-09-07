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
        Schema::dropIfExists('student_add_fees');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('student_add_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->float('total_amount', 10, 2)->nullable();
            $table->float('paid_amount', 10, 2)->nullable();
            $table->float('remaning_amount', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->text('remark')->nullable();
            $table->tinyInteger('is_payment')->default(0);
            $table->string('stripe_session_id')->nullable();
            $table->text('payment_data')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }
};
