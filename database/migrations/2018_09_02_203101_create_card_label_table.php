<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_label', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('card_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->foreign('card_id')->references('id_carte')->on('cards')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('label_id')->references('id_label')->on('labels')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_label');
    }
}
