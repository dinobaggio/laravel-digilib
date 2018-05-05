<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;
use App\File;

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
            $table->string('kategori')->nullable();           
            $table->string('nama_asli')->nullable();
            $table->string('hash_name')->nullable();
            $table->string('mime_file')->nullable();
            $table->string('extension')->nullable();
            $table->string('path')->nullable();
            $table->integer('size')->default(0);

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
        $files = $this->files_data();
        for ($i=0;$i<count($files);$i++) {
            Storage::delete($files[0]['path']);
        }
        Schema::dropIfExists('files');
    }

    public function files_data () {
        $files = File::select('path')->get();
        return $files;
    }
}
