<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reported_by')->nullable();
            $table->string('request_by')->nullable();
            $table->string('status')->nullable();
            $table->string('og_status')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('acknowledge_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('assisted_by')->nullable();
            $table->string('accomplished_by')->nullable();
            $table->string('category')->nullable();
            $table->string('sys_category')->nullable();
            $table->string('lop')->nullable();
            $table->longText('concerns')->nullable();
            $table->longText('recommendation')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->boolean('is_new')->default(true);
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
        Schema::dropIfExists('m_tickets');
    }
}
