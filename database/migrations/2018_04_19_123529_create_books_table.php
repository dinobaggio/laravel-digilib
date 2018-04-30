<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id_book')->nullable();
            $table->integer('id_file')->unsigned();
            $table->string('judul')->nullable();
            $table->timestamps();
        });
        Schema::table('books', function(Blueprint $table){
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
        Schema::dropIfExists('books');
    }
    
}
