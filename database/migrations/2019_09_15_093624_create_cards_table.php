<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('business_name');
            $table->string('business_person');
            $table->text('description');
            $table->text('address');
            $table->string('email_address');
            $table->string('contact_primary');
            $table->string('contact_secondary');
            $table->text('keywords');
            $table->string('card_image');
            $table->integer('business_category')->default(0);
            $table->string('search_words');
            $table->integer('status')->default(0)->comment = "0 = idle, 1 = approved/active, 2 = reject, 3 = verification pending";
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
        Schema::dropIfExists('cards');
    }
}
