<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        // Make status a string with enough length
        $table->string('status', 20)->default('pending')->change();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        // Rollback to original type (adjust if needed)
        $table->enum('status', ['pending', 'paid', 'shipped'])->default('pending')->change();
    });
}

};
