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
        Schema::create('email_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_requisition_id')->constrained('email_requisitions')->cascadeOnDelete();
            $table->string('recipient_email');
            $table->string('subject');
            $table->string('status'); // sent, failed
            $table->text('error_message')->nullable();
            $table->string('type'); // submitted, finished
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_monitorings');
    }
};