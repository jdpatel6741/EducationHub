<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseArtical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_articals_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('sid');
            $table->string('topic');
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('tbl_articals_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_articals_topics');
        Schema::dropIfExists('tbl_articals_subjects');
    }
}
