<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->enum('type', ['Editoria', 'Formazione'])->nullable();
            $table->enum('category', ['Vendita beni', 'Archiviazione', 'Editoria', 'Software', 'Formazione'])->nullable();
            $table->string('provider_name')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->timestamps();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
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
        Schema::dropIfExists('products');
    }
}
