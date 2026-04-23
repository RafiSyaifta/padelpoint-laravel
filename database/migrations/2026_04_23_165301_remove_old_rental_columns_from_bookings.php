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
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['racket_count', 'ball_count', 'water_count']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('racket_count')->default(0)->after('end_time');
            $table->integer('ball_count')->default(0)->after('racket_count');
            $table->integer('water_count')->default(0)->after('ball_count');
        });
    }
};
