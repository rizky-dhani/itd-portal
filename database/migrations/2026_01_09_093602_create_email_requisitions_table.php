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
        Schema::create('email_requisitions', function (Blueprint $table) {
            $table->id();
            
            // Requisition fields (1-11)
            $table->date('requisition_date');
            $table->string('request_type'); // New, Update, Delete
            $table->string('nickname');
            $table->string('full_name');
            $table->string('job_title');
            $table->string('department');
            $table->string('office_location');
            $table->string('nik');
            $table->string('email_purpose');
            $table->string('email_purpose_custom')->nullable();
            $table->string('distribution_list_initial');
            $table->string('distribution_list_initial_custom')->nullable();
            $table->text('requisition_note')->nullable();

            // Autofill fields (12-13)
            $table->foreignId('requester_id')->nullable()->constrained('users');
            $table->foreignId('dept_head_id')->nullable()->constrained('users');

            // ITD Personnel fields (14-17)
            $table->date('email_creation_date')->nullable();
            $table->string('email_address')->nullable();
            $table->string('password')->nullable();
            $table->string('distribution_list_final')->nullable();

            // ITD Autofill fields (18-19)
            $table->foreignId('itd_personnel_id')->nullable()->constrained('users');
            $table->foreignId('itd_manager_id')->nullable()->constrained('users');

            // Workflow status
            $table->string('status')->default('Draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_requisitions');
    }
};