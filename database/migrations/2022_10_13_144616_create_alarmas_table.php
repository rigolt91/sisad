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
        Schema::create('alarmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispositivo_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('oid_id')->default(0);
            $table->integer('codigo');
            $table->string('titulo');
            $table->string('message');
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
        Schema::dropIfExists('alarmas');
        $table->dropForeign('dispositivos_dispositivo_id_foreign');
    }
};
