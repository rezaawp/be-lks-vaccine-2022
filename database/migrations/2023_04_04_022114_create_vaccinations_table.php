<?php

use App\Models\Medical;
use App\Models\Society;
use App\Models\Spot;
use App\Models\Vaccine;
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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('dose');
            $table->date('date');
            $table->foreignIdFor(Society::class, 'society_id');
            $table->foreignIdFor(Spot::class, 'spot_id');
            $table->foreignIdFor(Vaccine::class, 'vaccine_id')->nullable();
            $table->foreignIdFor(Medical::class, 'doctor_id')->nullable();
            $table->foreignIdFor(Medical::class, 'officer_id')->nullable();
            $table->integer('queue');
            $table->enum('status', ['in_queue', 'done'])->default('in_queue');

            $table->foreign('society_id')->references('id')->on('societies');
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
            $table->foreign('doctor_id')->references('id')->on('medicals');
            $table->foreign('officer_id')->references('id')->on('medicals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
