<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('name', 255)->comment('Blog Name');
            
            $table->bigInteger('blog_category_id');
            $table->bigInteger('tag_id');
           $table->string('url');
           $table->string('author')->comment('Blog Author');
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
        Schema::dropIfExists('blogs');
    }
}
