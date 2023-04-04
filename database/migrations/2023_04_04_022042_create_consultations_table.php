<?php

use App\Models\Medical;
use App\Models\Society;
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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Society::class, 'society_id');
            $table->foreignIdFor(Medical::class, 'doctor_id')->nullable();

            $table->foreign('doctor_id')->references('id')->on('medicals');
            $table->foreign('society_id')->references('id')->on('societies');

            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->text('disease_history');
            $table->text('current_symptoms');
            $table->text('doctor_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
