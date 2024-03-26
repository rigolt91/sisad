<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oid_alarma_comandos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_oid_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('comando_id')->unique();
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
        Schema::dropIfExists('oid_alarma_comandos');
        $table->dropForeign('plantilla_oids_plantilla_oid_id_foreign');
    }
};
