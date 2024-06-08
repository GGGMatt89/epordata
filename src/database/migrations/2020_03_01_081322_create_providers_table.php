<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bus_name');
            $table->string('code');
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
            $table->enum('category', ['Generalista', 'Partner', 'Sponsor', 'Docente'])->nullable();
            $table->string('ref_name')->nullable();
            $table->string('ref_surname')->nullable();
            $table->string('ref_title')->nullable();
            $table->string('ref_phone')->nullable();
            $table->string('ref_email')->nullable();
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
        Schema::dropIfExists('providers');
    }
}
