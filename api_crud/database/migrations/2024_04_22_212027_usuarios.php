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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idusuario');
            $table->string('username', 50);
            $table->string('password', 50);
            $table->string('mail', 120);
            $table->char('sesionactiva', 1);
            $table->unsignedBigInteger('idpersona');
            $table->string('estado', 20);
            $table->timestamps();

            $table->foreign('idpersona')->references('idpersona')->on('persona')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
