<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Cth: #ORD-8921
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('address');
            $table->string('service_name');
            $table->float('estimated_weight');
            $table->date('pickup_date');
            $table->string('pickup_time');
            $table->decimal('total_price', 12, 2);
            $table->string('status')->default('Menunggu Jemput'); // Menunggu Jemput, Diproses, Selesai, Dibatalkan
            $table->enum('order_type', ['online', 'offline'])->default('online');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};