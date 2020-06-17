<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('job_title');
            $table->string('company');
            $table->text('address');
            $table->string('email_address');
            $table->string('contact_primary');
            $table->string('contact_secondary');
            $table->string('website');
            $table->text('notes');
            $table->integer('status')->default(0)->comment = "1 = approved/active, 2 = Delete";
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
        Schema::dropIfExists('personal_cards');
    }
}
