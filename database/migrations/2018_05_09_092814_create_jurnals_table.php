<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->increments('id_jurnal')->nullable();
            $table->integer('id_file')->unsigned();
            $table->longText('abstrak')->nullable();
            $table->timestamps();
        });
        Schema::table('jurnals', function(Blueprint $table){
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
        Schema::dropIfExists('jurnals');
    }
}
