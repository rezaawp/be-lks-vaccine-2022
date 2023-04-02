<?php

use App\Models\Regional;
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
        Schema::create('societies', function (Blueprint $table) {
            $table->id();
            $table->char('id_card_number', 8);
            $table->string('password')->nullable();
            $table->date('born_date');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->foreignIdFor(Regional::class, 'regional_id');
            $table->foreign('regional_id')->references('id')->on('regionals');
            $table->foreignIdFor(User::class, 'user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('login_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('societies');
    }
};
