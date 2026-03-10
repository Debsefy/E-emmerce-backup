<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   // customer
            $table->unsignedBigInteger('vendor_id'); // vendor
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            // Foreign keys (optional, if you want strict relations)
           $table->unsignedBigInteger('customer_id')->nullable()->change();
$table->unsignedBigInteger('user_id')->nullable()->change();

        });
    }
   
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
