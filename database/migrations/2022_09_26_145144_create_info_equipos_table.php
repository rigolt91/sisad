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
        Schema::create('info_equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispositivo_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('plantilla_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('plantilla_oid_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('data');
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
        Schema::dropIfExists('info_equipos');
        $table->dropForeign('dispositivos_dispositivo_id_foreign');
        $table->dropForeign('plantillas_plantilla_id_foreign');
        $table->dropForeign('plantilla_oids_plantilla_oid_id_foreign');
    }
};
