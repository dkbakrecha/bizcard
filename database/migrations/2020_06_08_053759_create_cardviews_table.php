<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_views', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->increments('id');
            $table->integer("card_id");
            $table->string("titleslug");
            $table->string("url");
            $table->string("session_id");
            $table->string("user_id");
            $table->string("ip");
            $table->string("agent");
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
        Schema::dropIfExists('card_views');
    }
}
