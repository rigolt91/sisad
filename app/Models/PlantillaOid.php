<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Plantilla;
use App\Models\OidAlarmaComando;
use App\Models\InfoEquipo;
use App\Models\InfoAlarma;
use App\Models\InfoGrafica;
use App\Models\AlarmaEquipo;
use App\Models\GraficaEquipo;

class PlantillaOid extends Model
{
    use HasFactory;

    protected $fillable = [
        'plantilla_id',
        'identificador',
        'tipo_oid',
        'status_ok',
        'oid',
        'comando'
    ];

    public function plantilla() {
        return $this->belongsTo(Plantilla::class);
    }

    public function oidAlarmaComando() {
        return $this->hasOne(OidAlarmaComando::class);
    }

    public function infoEquipo()
    {
        return $this->hasMany(InfoEquipo::class);
    }

    public function infoAlarma()
    {
        return $this->hasMany(InfoAlarma::class);
    }

    public function infoGrafica()
    {
        return $this->hasMany(InfoGrafica::class);
    }

    public function alarmaEquipo()
    {
        return $this->hasOne(AlarmaEquipo::class);
    }

    public function graficaEquipo()
    {
        return $this->hasOne(GraficaEquipo::class);
    }
}
