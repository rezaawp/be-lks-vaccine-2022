<?php

use App\Models\Spot;
use App\Models\User;
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
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Spot::class, 'spot_id');
            $table->foreign('spot_id')->references('id')->on('spots');
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('role', ['officer', 'doctor']);
            $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicals');
    }
};
