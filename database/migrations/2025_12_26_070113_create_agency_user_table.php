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
        Schema::create('agency_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained('agencies')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('role')->after('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down()
{
    Schema::table('agency_user', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}

};
