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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('module')->nullable();
            $table->string('issue_type')->nullable();
            $table->text('description')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->dateTime('due_date')->nullable(); // Add due date for priority
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
