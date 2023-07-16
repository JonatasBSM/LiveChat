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
        Schema::create('users_has_channels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("channel_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_channels');
    }
};
