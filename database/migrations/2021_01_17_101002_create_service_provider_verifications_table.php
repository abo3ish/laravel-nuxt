<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained();
            $table->string('type');  // Syndicate_id  // nation_id  // practicing_id  // lisense_id
            $table->string('number');  // 2235345  // 132342343  // 4234324
            $table->string('image');  // test.jpg  // national_id.jgp  // practicing_id.jpg
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
        Schema::dropIfExists('service_provider_verifications');
    }
}
