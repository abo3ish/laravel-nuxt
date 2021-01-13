<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('percentage');
            $table->double('max_price', 8, 2)->default(1000);
            $table->integer('usage_total')->default(0);
            $table->integer('usage_limit')->default(1000);
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('discountable_type');    // App\Models\ServiceProviderType or App\Models\DrugCategory
            $table->integer('discountable_id');
            $table->boolean('status')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('discounts');
    }
}
