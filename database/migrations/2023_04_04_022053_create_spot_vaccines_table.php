<?php

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
        Schema::create('spot_vaccines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Spot::class, 'spot_id');
            $table->foreignIdFor(Vaccine::class, 'vaccine_id');

            $table->foreign('spot_id')->references('id')->on('spots');
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spot_vaccines');
    }
};
