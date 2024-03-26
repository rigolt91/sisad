<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Plantilla;
use App\Models\Provincia;
use App\Models\Municipio;
use App\Models\Ubicacion;
use App\Models\InfoEquipo;
use App\Models\InfoGrafica;
use App\Models\InfoAlarma;
use App\Models\Alarma;

class Dispositivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ip_address',
        'comunidad',
        'descripcion',
        'observacion',
        'plantilla_id',
        'provincia_id',
        'municipio_id',
        'ubicacion_id',
        'imagen',
        'version_snmp',
        'favorito'
    ];

    public function plantilla()
    {
        return $this->belongsTo(Plantilla::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function infoEquipo()
    {
        return $this->hasOne(InfoEquipo::class);
    }

    public function infoGrafica()
    {
        return $this->hasOne(InfoGrafica::class);
    }

    public function infoAlarma()
    {
        return $this->hasOne(InfoAlarma::class);
    }

    public function alarma()
    {
        return $this->hasOne(Alarma::class);
    }
}
