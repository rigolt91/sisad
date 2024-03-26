<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dispositivo;
use App\Models\PlantillaOid;
use App\Models\AlarmaEquipo;
use App\Models\InfoAlarma;
use App\Models\InfoEquipo;
use App\Models\InfoGrafica;
use App\Models\GraficaEquipo;

class Plantilla extends Model
{
    use HasFactory;

    public $fillable = ['nombre'];

    public function plantillaOid() {
        return $this->hasMany(PlantillaOid::class);
    }

    public function dispositivo() {
        return $this->hasMany(Dispositivo::class);
    }

    public function infoAlarma()
    {
        return $this->hasOne(InfoAlarma::class);
    }

    public function infoEquipo()
    {
        return $this->hasOne(InfoEquipo::class);
    }

    public function infoGrafica()
    {
        return $this->hasOne(InfoGrafica::class);
    }

    public function alarmaEquipo()
    {
        return $this->hasOne(AlarmaEquipo::class);
    }

    public function graficaEquipo()
    {
        return $this->hasOne(GraficaEquipo::class);
    }

    public function getDispositivos($plantilla_id, $provincia_id, $municipio_id, $ubicacion_id)
    {
        return Dispositivo::where('plantilla_id', $plantilla_id)
            ->where('provincia_id', 'like', '')
            ->orderBy('ubicacion_id', 'asc')
            ->get();
    }
}
