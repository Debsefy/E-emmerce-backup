<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('delivery_address')->nullable()->change();
        $table->string('delivery_country')->nullable()->change();
        $table->string('delivery_region')->nullable()->change();
        $table->string('sender_mobile')->nullable()->change();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('delivery_address')->nullable(false)->change();
        $table->string('delivery_country')->nullable(false)->change();
        $table->string('delivery_region')->nullable(false)->change();
        $table->string('sender_mobile')->nullable(false)->change();
    });
}

};
