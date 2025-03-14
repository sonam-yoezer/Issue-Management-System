<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDueDateToIssuesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dateTime('due_date')->nullable()->after('priority'); // Add due date column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('due_date'); // Drop due date column
        });
    }
}
