<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('videos')){
            Schema::create('videos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('storage_id');
                $table->string('user_id');
                $table->string('name');
                $table->string('description')->default("");
                $table->integer('likes')->default(0);
                $table->integer('dislikes')->default(0);
                $table->integer('views')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
