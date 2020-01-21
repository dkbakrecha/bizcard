<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNullToCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('email_address')->nullable()->change();
            $table->string('contact_primary')->nullable()->change();
            $table->string('contact_secondary')->nullable()->change();
            $table->text('keywords')->nullable()->change();
            $table->string('card_image')->nullable()->change();
            $table->string('search_words')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            //
        });
    }
}
