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
        Schema::create('plantilla_oids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('identificador');
            $table->string('tipo_oid');
            $table->string('status_ok')->nullable();
            $table->string('oid');
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
        Schema::dropIfExists('plantilla_oids');
        $table->dropForeign('plantillas_plantilla_id_foreign');
    }
};
