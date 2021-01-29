<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRessourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('content');
            $table->string('ressource_url')->nullable();
            $table->integer('count_view');
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->timestamps();

            $table->foreign('zone_id')->references('id')->on('zone')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('set null');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ressources');
    }
}
