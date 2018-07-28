<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseMytube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create categroy table
        Schema::create('tbl_mytube_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status');
        });

        // create channel table
        Schema::create('tbl_mytube_channel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('status');
        });

        // create comment table
        Schema::create('tbl_mytube_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('video_id');
            $table->text('comment');
            $table->timestamp('date');
            $table->integer('status');
        });

        // create favorite table
        Schema::create('tbl_mytube_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('video_id');
            $table->integer('status');
        });

        // create likecount table
        Schema::create('tbl_mytube_likecount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('video_id');
            $table->timestamp('date');
            $table->integer('status');
        });

        // create subscribe table
        Schema::create('tbl_mytube_subscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('channel_id');
            $table->integer('status');
        });

        // create videos table
        Schema::create('tbl_mytube_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('channel_id');
            $table->text('thumbnail');
            $table->text('url');
            $table->string('title');
            $table->text('description');
            $table->string('privacy');
            $table->timestamp('date');
            $table->char('videohash',32);
            $table->integer('status')->default('1');
        });

        // create subscribe table
        Schema::create('tbl_mytube_viewcount', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id');
            $table->integer('visits');
            $table->string('ip');
            $table->timestamp('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_mytube_categroy');
        Schema::dropIfExists('tbl_mytube_channel');
        Schema::dropIfExists('tbl_mytube_comment');
        Schema::dropIfExists('tbl_mytube_favorite');
        Schema::dropIfExists('tbl_mytube_likecount');
        Schema::dropIfExists('tbl_mytube_subscribe');
        Schema::dropIfExists('tbl_mytube_videos');
        Schema::dropIfExists('tbl_mytube_viewcount');
    }
}
