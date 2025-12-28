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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')              // The user who logged the expense
              ->constrained('users')
              ->onDelete('cascade');
        $table->foreignId('agency_id')            // The agency this expense belongs to
              ->constrained('agencies')
              ->onDelete('cascade');
        $table->decimal('amount', 12, 2);         // Expense amount
        $table->text('description');              // Expense description
         $table->enum('billable_status', [
        'billable',
        'non_billable',
    ])->default('billable'); // Billable or not
       $table->enum('status', [
        'pending',
        'approved',
        'rejected',
    ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
