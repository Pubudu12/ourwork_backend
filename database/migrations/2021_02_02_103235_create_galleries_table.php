<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
<<<<<<< HEAD
            $table->string('video');
            $table->enum('video_type',['vimeo','youtube']);
            $table->string('text');
            $table->enum('gallery_item_type',['image','video']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
=======
            $table->string('video')->nullable()->comment = 'This field will null if it is a image';
            $table->enum('video_type',['vimeo','youtube'])->nullable()->comment = 'This field will null if it is a image';;
            $table->string('text')->nullable()->comment = 'This is an optional field';;
            $table->enum('item_type',['image','video']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
      
>>>>>>> 4ec32497339145742e449c838d3e0c5a67f99205
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
