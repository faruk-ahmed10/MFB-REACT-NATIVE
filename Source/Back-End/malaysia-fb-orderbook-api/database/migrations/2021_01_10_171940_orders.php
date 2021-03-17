<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_canceled')->default(0);
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'COMPLETED'])->default('PENDING');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('comment', 256)->nullable();
            $table->double('total_price', 15, 2);
            $table->bigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
