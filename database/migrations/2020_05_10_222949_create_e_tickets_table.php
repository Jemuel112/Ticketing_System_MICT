<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateETicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('dept_id');
            $table->integer('quantity');
            $table->longText('equipment');
            $table->integer('service_type');
            $table->integer('section_tpye');
            $table->string('technician_id');
            $table->integer('status');
            $table->longText('details');
            $table->longText('remarks');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->boolean('is_new')->default(true);
            $table->dateTime('finished_at')->nullable();
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
        Schema::dropIfExists('e_tickets');
    }
}
