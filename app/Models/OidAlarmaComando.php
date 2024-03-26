<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PlantillaOid;

class OidAlarmaComando extends Model
{
    use HasFactory;

    public $fillable = [
        'plantilla_oid_id',
        'comando_id'
    ];

    public function plantillaOid() {
        return $this->belongsTo(PlantillaOid::class);
    }

    public function comando($id) {
        return PlantillaOid::find($id);
    }
}
