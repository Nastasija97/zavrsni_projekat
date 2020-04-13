<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->comment('Blog Name');
            $table->text('description')->nullable();
            $table->bigInteger('blog_category_id');
            $table->bigInteger('tag_id');
            $table->string('url')->nullable();
            $table->string('author')->nullable()->comment('Blog Author from the Users Table');
            $table->boolean('important')->default(0)->comment('If product should be displayed on index page');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('blogs');
    }

}
