<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('excerpt')->default('');
            $table->text('body');
            $table->string('preview_title');
            $table->string('preview_subtitle')->default('');
            $table->date('beginning')->default(Carbon\Carbon::now());
            $table->date('expiration')->default(Carbon\Carbon::now()->addMonth());
            $table->string('image_path')->default('/img/offers/default.png')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
