<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('brand_name')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('brand_image')->nullable();
            $table->string('registration_license')->nullable();
            $table->string('nin_document')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'brand_name', 'phone', 'address',
                'brand_image', 'registration_license', 'nin_document'
            ]);
        });
    }
};
