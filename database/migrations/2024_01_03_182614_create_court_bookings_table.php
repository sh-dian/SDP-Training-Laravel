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
        Schema::create('court_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('court_id')->constrained();
            $table->unsignedBigInteger('customer_id')->constrained();
            $table->integer('hour');
            $table->date('date');
            $table->time('start_time');
            $table->integer('total_player');
            $table->decimal('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_bookings');
    }
};
