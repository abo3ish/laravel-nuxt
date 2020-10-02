<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->integer('uuid')->unique()->index();
            $table->foreignId('user_id')->costrained();
            $table->foreignId('service_provider_type_id')->costrained();
            $table->foreignId('service_provider_id')->nullable()->costrained()->onDelete('set null');
            $table->float('price_to_pay')->default(0)->nullable();
            $table->float('tax_price')->default(0);
            $table->float('discount_price')->default(0);
            $table->float('actual_price')->nullable();
            $table->foreignId('address_id');
            $table->integer('status')->default(0);
            $table->boolean('is_collected')->default(false);
            $table->enum('type', ['service', 'pharmacy']);
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
