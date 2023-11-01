<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dogoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogoods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->text('title');
            $table->text('description');
            $table->text('thumb')->nullable();
            $table->date('post_date')->useCurrent();
            $table->enum('highlight',[1,0])->default(1);
            $table->enum('status',[1,0])->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dogoods');
    }
}
