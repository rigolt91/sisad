<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\Dispositivo;
use App\Models\Plantilla;
use App\Models\PlantillaOid;
use App\Models\AlarmaActivaEquipo;

class InfoEquipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispositivo_id',
        'plantilla_id',
        'plantilla_oid_id',
        'data',
        'tipo_oid'
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

    public function getData($dispositivo, $id)
    {
        return $this->where([
            ['dispositivo_id', $dispositivo->id],
            ['plantilla_id', $dispositivo->plantilla_id],
            ['plantilla_oid_id', $id]
        ]);
    }

    public function last($dispositivo, $id)
    {
        return $this->where([
            ['dispositivo_id', $dispositivo->id],
            ['plantilla_id', $dispositivo->plantilla_id],
            ['plantilla_oid_id', $id]
        ])->latest()->first();
    }
}
