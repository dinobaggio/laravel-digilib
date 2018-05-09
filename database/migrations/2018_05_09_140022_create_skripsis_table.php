<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkripsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skripsis', function (Blueprint $table) {
            $table->increments('id_skripsi')->nullable();
            $table->integer('id_file')->unsigned();
            $table->timestamps();
        });
        Schema::table('skripsis', function(Blueprint $table){
            $table->foreign('id_file')
            ->references('id_file')
            ->on('files')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skripsis');
    }
}
