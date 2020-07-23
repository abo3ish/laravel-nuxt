<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->costrained();
            $table->foreignId('examination_service_type_id')->costrained();
            $table->float('subtotal_price');
            $table->float('tax_price')->default(0);
            $table->float('discount_price')->default(0);
            $table->float('total_price');
            $table->foreignId('address_id');
            $table->unsignedBigInteger('examiner_id')->nullable();
            $table->string('model_namespace');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('examination_orders');
    }
}
