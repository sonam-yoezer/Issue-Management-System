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
        Schema::table('issues', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_user_id')->nullable()->after('img'); // Add assigned_user_id column
            $table->string('priority')->default('low')->after('assigned_user_id'); // Add priority column with default value
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            //
        });
        
        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('assigned_user_id'); // Drop assigned_user_id column
        });
    }
};
