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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')           // Agency this invoice belongs to
              ->constrained('agencies')
              ->onDelete('cascade');
        $table->foreignId('created_by')          // User (Owner) who created the invoice
              ->constrained('users')
              ->onDelete('cascade');
        $table->enum('status', ['draft', 'sent', 'paid'])->default('draft'); // Invoice status
        $table->decimal('total_amount', 12, 2)->default(0); // Total amount of invoice
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
