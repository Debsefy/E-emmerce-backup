<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::table('carts', function (Blueprint $table) {
        // Drop the foreign key constraint first
        $table->dropForeign(['customer_id']);

        // Then drop the column
        $table->dropColumn('customer_id');
    });
}

public function down()
{
    Schema::table('carts', function (Blueprint $table) {
        $table->unsignedBigInteger('customer_id')->nullable();

        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
    });
}

};
