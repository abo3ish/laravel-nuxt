<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->constrained('service_provider_types');
            $table->string('phone');
            $table->foreignId('area_id')->constrained();
            $table->string('address');
            $table->string('email');
            $table->integer('age');
            $table->string('photo')->nullable();
            $table->string('password');
            $table->integer('rate')->default(5);
            $table->text('note')->nullable();
            $table->boolean('status')->default(true);
            $table->dateTime('last_seen')->nullable();
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
        Schema::dropIfExists('service_providers');
    }
}
