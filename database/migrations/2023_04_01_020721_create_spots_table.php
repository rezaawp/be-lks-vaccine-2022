<?php

use App\Models\Regional;
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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Regional::class, 'regional_id');
            $table->foreign('regional_id')->references('id')->on('regionals');
            $table->string('name');
            $table->text('address');
            $table->tinyInteger('serve');
            $table->integer('capcity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};
