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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees', 'id')->restrictOnDelete()->restrictOnUpdate();
            $table->string('leave_type');
            $table->date('applied_on');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('total_leave_days');
            $table->string('leave_reason')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
