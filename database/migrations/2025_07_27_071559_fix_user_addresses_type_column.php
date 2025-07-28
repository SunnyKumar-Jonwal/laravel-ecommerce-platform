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
        Schema::table('user_addresses', function (Blueprint $table) {
            // Drop the existing enum column and recreate with correct values
            $table->dropColumn('type');
        });
        
        Schema::table('user_addresses', function (Blueprint $table) {
            // Add the type column back with correct enum values
            $table->enum('type', ['home', 'office', 'other'])->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        
        Schema::table('user_addresses', function (Blueprint $table) {
            // Restore original enum values
            $table->enum('type', ['billing', 'shipping'])->after('user_id');
        });
    }
};
