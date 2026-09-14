<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cafes', function (Blueprint $table) {
            // address → station に変更
            $table->renameColumn('address', 'station');

            // 平均予算（円）
            $table->integer('average_price')->nullable()->after('station');

            // 総合評価（1～5）
            $table->tinyInteger('rating')->nullable()->after('quiet_level');
        });
    }

    public function down(): void
    {
        Schema::table('cafes', function (Blueprint $table) {
            $table->renameColumn('station', 'address');
            $table->dropColumn(['average_price', 'rating']);
        });
    }
};
