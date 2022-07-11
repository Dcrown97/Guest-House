<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_mode')->after('amount');
        });

        Schema::table('food_orders', function (Blueprint $table) {
            $table->string('payment_mode')->after('ordered_food_price');
        });

        Schema::table('order_drinks', function (Blueprint $table) {
            $table->string('payment_mode')->after('ordered_drink_price');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->string('payment_mode')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_mode');
        });

        Schema::table('food_orders', function (Blueprint $table) {
            $table->dropColumn('payment_mode');
        });

        Schema::table('order_drinks', function (Blueprint $table) {
            $table->dropColumn('payment_mode');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('payment_mode');
        });
        
    }
};
