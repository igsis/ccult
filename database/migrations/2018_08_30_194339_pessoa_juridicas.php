<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PessoaJuridicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_juridicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();;
            $table->string('razao_social', 100)->nullable();;
            $table->string('cnpj', 18)->nullable();;
            $table->char('ccm', 11)->nullable();;
            $table->string('email')->unique();
            $table->string('password');
            $table->string('representante_legal1_id')->nullable();;
            $table->string('representante_legal2_id')->nullable();;
            $table->rememberToken();
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
        Schema::dropIfExists('pessoa_juridicas');
    }
}
