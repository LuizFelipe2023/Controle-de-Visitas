<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionamentosTable extends Migration
{
    public function up()
    {
        Schema::create('versionamentos', function (Blueprint $table) {
            $table->id();
            $table->string('modulo'); 
            $table->text('descricao');
            $table->string('versao')->nullable(); 
            $table->unsignedBigInteger('usuario_id')->nullable(); 
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('versionamentos');
    }
}
