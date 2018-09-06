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
            $table->integer('uid');
            $table->string('topic');
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('tbl_articals_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('tbl_articals_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('visits');
            $table->string('ip');
            $table->timestamp('date');
        });

        Schema::create('tbl_articals_favorite', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('article_id');
            $table->integer('status');
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
        Schema::dropIfExists('tbl_articals_views');
        Schema::dropIfExists('tbl_articals_favorite');
    }
}
