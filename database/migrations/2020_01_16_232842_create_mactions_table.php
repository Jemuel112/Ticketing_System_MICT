<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('actions');
            $table->bigInteger('id_mticket');
            $table->bigInteger('id_user');
            $table->boolean('shared')->default(1);
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
        Schema::dropIfExists('mactions');
    }
}
