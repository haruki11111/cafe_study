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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // 店名
            $table->string('address')->nullable();     // 最寄り駅
            $table->boolean('wifi')->default(false);   // Wi-Fi
            $table->boolean('power_supply')->default(false); // コンセント
            $table->tinyInteger('quiet_level');        // 静かさ(1～5)
            $table->text('memo')->nullable();          // メモ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
