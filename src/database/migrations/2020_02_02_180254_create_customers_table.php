<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title')->nullable();
            $table->string('bus_name')->nullable();
            $table->string('cus_code');
            $table->string('tax_code')->nullable();
            $table->string('vat_num')->nullable();
            $table->string('univ_code')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('pec')->unique()->nullable();
            $table->string('office_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('region')->nullable();
            $table->enum('rating', ['Standard', 'Vip', 'Prospect'])->nullable();
            $table->enum('category', ['Fiscale', 'Legale', 'Notaio', 'Lavoro', 'Tecnico', 'Azienda/Ente', 'Altro'])->nullable();
            $table->enum('handler', ['Fiscale', 'Legale', 'Altro'])->nullable();
            $table->string('ref_name')->nullable();
            $table->string('ref_surname')->nullable();
            $table->string('ref_title')->nullable();
            $table->string('ref_phone')->nullable();
            $table->string('ref_email')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
