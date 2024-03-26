<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dispositivo;
use App\Models\Plantilla;
use App\Models\PlantillaOid;
use App\Models\AlarmaActivaEquipo;

class InfoAlarma extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispositivo_id',
        'plantilla_id',
        'plantilla_oid_id',
        'data',
    ];

    public function dispositivo(): BelongsTo
    {
        return $this->belongsTo(Dispositivo::class);
    }

    public function plantilla(): BelongsTo
    {
        return $this->belongsTo(Plantilla::class);
    }

    public function plantillaOid(): BelongsTo
    {
        return $this->belongsTo(PlantillaOid::class);
    }

    public function alarmaActivaEquipo(): BelongsTo
    {
        return $this->belongsTo(AlarmaActivaEquipo::classs);
    }

}
