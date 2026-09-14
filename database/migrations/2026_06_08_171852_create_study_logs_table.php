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
        Schema::create('study_logs', function (Blueprint $table) {
            $table->id();

            // カフェとのリレーション
            $table->foreignId('cafe_id')
                ->constrained()
                ->cascadeOnDelete();

            // 勉強時間（分）
            $table->integer('study_minutes');

            // 満足度（1～5）
            $table->tinyInteger('satisfaction');

            // 利用日
            $table->date('visited_at');

            // メモ
            $table->text('memo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_logs');
    }
};
