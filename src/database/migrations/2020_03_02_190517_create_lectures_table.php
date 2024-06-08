<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('title');
            $table->string('place');
            $table->timestamp('beginning')->nullable();
            $table->timestamp('end')->nullable();
            $table->string('last')->nullable();
            $table->string('cr_body')->nullable();
            $table->string('provider')->nullable();
            $table->decimal('cfp', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectures');
    }
}
