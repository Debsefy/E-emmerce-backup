<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('vendors', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // link to users table
        $table->string('business_name');
        $table->string('logo')->nullable();
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->boolean('featured')->default(false); // for homepage showcase
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('vendors');
}

};
