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
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees', 'id')->restrictOnDelete()->restrictOnUpdate;
            $table->string('designation');
            $table->string('address');
            $table->date('dob');
            $table->string('nid')->unique();
            $table->enum('gender', ['Male', 'Female']);
            $table->string('phone')->unique();
            $table->integer('salary')->nullable();
            $table->timestamps();
        });


        // Indexing the 'nid' column
        Schema::table('employee_infos', function ($table) {
            $table->index('address');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_infos');
    }
};
