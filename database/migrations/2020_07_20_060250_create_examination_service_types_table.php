<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_service_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('examination_service_id')->constrained();
            $table->string('icon')->nullable();
            $table->integer('parent_id')->nullable();
            $table->float('estimation_from')->default(100);
            $table->float('estimation_to')->default(100);
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
        Schema::dropIfExists('examination_service_types');
    }
}
