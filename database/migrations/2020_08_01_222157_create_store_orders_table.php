<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->costrained();
            $table->foreignId('service_provider_id')->costrained()->onDelete('set null');
            $table->float('price_to_pay')->default(0);
            $table->float('tax_price')->default(0);
            $table->float('discount_price')->default(0);
            $table->float('actual_price');
            $table->foreignId('address_id');
            $table->boolean('status')->default(false);
            $table->boolean('is_collected')->default(false);
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
        Schema::dropIfExists('store_orders');
    }
}
