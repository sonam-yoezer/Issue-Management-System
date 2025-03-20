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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to User
            $table->foreignId('issues_id')->constrained()->onDelete('cascade'); // Link to Product
            $table->string('name'); 
            $table->string('email'); 
            $table->string('module'); 
            $table->string('issue_type'); 
            $table->string('description'); 
            $table->string('img'); 
            $table->string('priority'); 
            $table->string('report_date'); 
            $table->string('client_confirmation'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
