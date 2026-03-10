<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('receiver_name')->after('status');
        $table->string('sender_mobile')->after('receiver_name');
        $table->string('delivery_address')->after('sender_mobile');
        $table->string('delivery_country')->after('delivery_address');
        $table->string('delivery_region')->after('delivery_country');
        $table->string('delivery_city')->after('delivery_region');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn([
            'receiver_name',
            'sender_mobile',
            'delivery_address',
            'delivery_country',
            'delivery_region',
            'delivery_city',
        ]);
    });
}

};
