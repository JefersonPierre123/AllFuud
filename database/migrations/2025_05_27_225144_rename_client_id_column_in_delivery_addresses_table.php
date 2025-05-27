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
        Schema::table('delivery_addresses', function (Blueprint $table) {
            // Primeiro, remova a chave estrangeira existente
            $table->dropForeign(['clientId']);

            // Em seguida, renomeie a coluna
            $table->renameColumn('clientId', 'client_id');
        });

        // Depois, recrie a foreign key com o nome novo
        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->renameColumn('client_id', 'clientId');
        });

        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->foreign('clientId')->references('id')->on('clients')->onDelete('cascade');
        });
    }
};
