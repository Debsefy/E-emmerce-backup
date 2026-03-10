<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        if (Schema::hasColumn('orders', 'tracking_url')) {
            $table->dropColumn('tracking_url');
        }
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('tracking_url')->nullable()->after('tracking_number');
    });
}

};
