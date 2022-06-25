<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            $table->text('title');  // Title of our blog post          
            $table->text('body');   // Body of our blog post                  
            $table->unsignedBigInteger('user_id'); // user_id of our blog post author
            $table->index('user_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function($table)
        {
            $table->dropForeign('blog_posts_user_id_foreign');
            $table->dropIndex('blog_posts_user_id_index');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('blog_posts');
    }
};
