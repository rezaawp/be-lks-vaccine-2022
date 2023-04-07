<?php

use App\Models\Choise;
use App\Models\Polling;
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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Polling::class, 'polling_id');
            $table->foreignIdFor(Choise::class, 'choise_id');
            $table->foreignIdFor(User::class, 'user_id', 'id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('polling_id')->references('id')->on('pollings');
            $table->foreign('choise_id')->references('id')->on('choises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
