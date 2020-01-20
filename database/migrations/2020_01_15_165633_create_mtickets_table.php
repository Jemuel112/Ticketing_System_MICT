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
            $table->bigIncrements('ticket_number');
            $table->string('reported_by');
            $table->string('request_by');
            $table->string('status');
            $table->string('og_status')->nullable();
            $table->string('acknowledge_by')->nullable();
            $table->string('assigned_by')->nullable();
            $table->string('assisted_by')->nullable();
            $table->string('accomplished_by')->nullable();
            $table->string('category');
            $table->string('sys_category')->nullable();
            $table->string('lop')->nullable();
            $table->longText('concerns');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
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
