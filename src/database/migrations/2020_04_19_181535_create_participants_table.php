<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('lecture_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('role', ['Professionista', 'Dipendente', 'Finanziato', 'Uditore'])->nullable();
            $table->boolean('payed')->default(false);
            $table->timestamps();
        
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('lecture_id')
                ->references('id')
                ->on('lectures')
                ->onDelete('cascade')
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
        Schema::dropIfExists('participants');
    }
}
