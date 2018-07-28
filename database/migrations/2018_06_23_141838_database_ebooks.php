<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseEbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ebooks_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('title');
            $table->text('description');
            $table->string('privacy');
            $table->text('url');
            $table->text('thumbnail');
            $table->char('ebookhash',32);
            $table->integer('status')->default('1');
            $table->timestamps();
        });

        Schema::create('tbl_ebooks_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('book_id');
            $table->integer('status')->default('1');
            $table->timestamps();
        });

        // create subscribe table
        Schema::create('tbl_ebooks_subscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('status')->default('1');
        });

        // create categroy table
        Schema::create('tbl_ebooks_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status');
        });

        // create categroy table
        Schema::create('tbl_ebooks_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book_id');
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
        Schema::dropIfExists('tbl_ebooks_books');
        Schema::dropIfExists('tbl_ebooks_favorite');        
        Schema::dropIfExists('tbl_ebooks_subscribe');
        Schema::dropIfExists('tbl_ebooks_category');
        Schema::dropIfExists('tbl_ebooks_views');
    }
}
