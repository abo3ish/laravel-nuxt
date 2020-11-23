<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('service_provider_type_id')->constrained();
            $table->float('estimation_from');
            $table->float('estimation_to');
            $table->double('price', 8, 2);
            $table->foreignId('examination_id')->constrained();
            $table->integer('parent_id')->nullable();
            $table->string('slug');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('services');
    }
}
