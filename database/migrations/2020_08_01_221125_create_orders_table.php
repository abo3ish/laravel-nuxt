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

            // $table->foreignId('address_id');
            $table->foreignId('area_id')->constrained();
            $table->string('street');
            $table->string('building_number')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('flat_number')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();

            $table->foreignId('service_provider_type_id')->costrained();
            $table->foreignId('service_provider_id')->nullable()->costrained()->onDelete('set null');
            $table->foreignId('bill_cycle_id')->costrained()->onDelete('set null');
            $table->enum('type', ['service', 'pharmacy']);
            $table->integer('status')->default(1);
            $table->integer('rate')->nullable();
            $table->double('tax_price', 8, 2)->default(0);
            // $table->foreignId('discount_id')->nullable()->costrained()->onDelete('set null');
            $table->double('discount_price', 8, 2)->nullable();
            $table->double('actual_price', 8, 2)->nullable();
            $table->double('subtotal', 8, 2)->nullable();
            $table->double('delivery_price', 8, 2)->nullable();
            $table->double('price_to_pay', 8, 2)->nullable();
            $table->boolean('is_collected')->default(false);
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('arrived_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->integer('profit_percentage');
            $table->double('actual_profit', 8, 2)->default(0);  // price
            $table->double('company_profit', 8, 2)->default(0); // price
            $table->double('service_provider_profit', 8, 2)->default(0); // price
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
