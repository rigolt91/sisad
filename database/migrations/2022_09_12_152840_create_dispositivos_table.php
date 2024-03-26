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
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->ipAddress('ip_address')
                ->unique();
            $table->string('comunidad');
            $table->string('descripcion');
            $table->string('observacion')
                ->nullable();
            $table->foreignId('plantilla_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('provincia_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('municipio_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('ubicacion_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('imagen')
                ->nullable();
            $table->integer('version_snmp');
            $table->integer('favorito');
            $table->boolean('activo')->default(true);
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
        Schema::dropIfExists('dispositivos');
        $table->dropForeign('plantillas_plantilla_id_foreign');
        $table->dropForeign('provincias_provincia_id_foreign');
        $table->dropForeign('municipios_municipio_id_foreign');
        $table->dropForeign('ubicacions_ubicacion_id_foreign');
    }
};
