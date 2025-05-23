<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('imagem');
            $table->string('cnpj')->unique();
            $table->string('nome_franquia');
            $table->string('nome_unidade');
            $table->string('categoria');
            $table->string('descricao');
            $table->decimal('classificacao');
            $table->string('telefone');
            $table->string('email_contato')->unique();
            $table->string('cep');
            $table->string('estado');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('endereco');
            $table->string('numero');
            $table->string('complemento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishment');
    }
};
