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
            $table->string('nome_social',70)->nullable();
            $table->string('nome_artistico',70)->nullable();
            $table->tinyInteger('documento_tipo_id')->nullable();
            $table->string('rg_rne', 100)->nullable();
            $table->char('ccm', 11)->nullable();
            $table->char('cpf', 14)->nullable();
            $table->string('passaporte',10)->nullable();
            $table->date('data_nascimento')->nullable();
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
