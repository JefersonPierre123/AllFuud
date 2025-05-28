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
        Schema::table('users', function (Blueprint $table) {
            // Primeiro, remova a chave estrangeira existente
            $table->dropForeign(['clientId']);
            $table->dropForeign(['establishmentId']);

            // Em seguida, renomeie a coluna
            $table->renameColumn('clientId', 'client_id');
            $table->renameColumn('establishmentId', 'establishment_id');
        });

        // Depois, recrie a foreign key com o nome novo
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->renameColumn('client_id', 'clientId');
            $table->dropForeign(['establishment_id']);
            $table->renameColumn('establishment_id', 'establishmentId' );
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('establishmentId')->references('id')->on('establishments')->onDelete('cascade');
        });
    }
};