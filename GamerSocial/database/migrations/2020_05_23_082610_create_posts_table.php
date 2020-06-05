<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("post_id")->unsigned()->nullable();
            $table->bigInteger("project_id")->unsigned()->nullable();
            $table->text("text");
            $table->timestamps();

            $table->foreign("user_id")
            ->references("id")
            ->on("users")
            ->onDelete("cascade")
            ->onUpdate("cascade");


            $table->foreign("post_id")
            ->references("id")
            ->on("posts")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->foreign("project_id")
            ->references("id")
            ->on("projects")
            ->onDelete("cascade")
            ->onUpdate("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
