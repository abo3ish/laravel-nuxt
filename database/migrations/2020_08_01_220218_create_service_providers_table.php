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
            $table->foreignId('type_id');
            $table->string('national_id', 14)->unique()->nullable();
            $table->string('phone')->unique();
            $table->foreignId('area_id');
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->integer('rate')->default(5);
            $table->integer('rate_count')->default(0);
            $table->text('note')->nullable();
            $table->integer('status')->default(7);
            $table->string('push_token')->nullable();
            $table->dateTime('last_seen')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
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
        Schema::dropIfExists('service_providers');
    }
}
