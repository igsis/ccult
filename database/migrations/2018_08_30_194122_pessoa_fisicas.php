<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PessoaFisicas extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pessoa_fisicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',70);
            $table->string('nome_social',70);
            $table->string('nome_artistico',70);
            $table->tinyInteger('documento_tipo_id');
            $table->string('rg_rne', 100);
            $table->char('ccm', 11);
            $table->char('cpf', 14);
            $table->string('passaporte',10);
            $table->date('data_nascimento');
            $table->string('email')->unique();
            $table->string('password');
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
        Schema::dropIfExists('pessoa_fisicas');
    }
}
