<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id_file');
            
            $table->string('judul')->nullable();
            $table->string('kategori')->nullable();           
            $table->string('nama_asli')->nullable();
            $table->string('hash_name')->nullable();
            $table->string('mime_file')->nullable();
            $table->string('extension')->nullable();
            $table->string('path')->nullable();
            $table->integer('size')->default(0);

            $table->integer('id_user')->unsigned(); // foreign key

            $table->timestamps();
        });

        Schema::table('files', function(Blueprint $table){
            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
