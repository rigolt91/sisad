<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InfoEquipo;

class AlarmaActivaEquipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'info_equipo_id'
    ];

    public function infoEquipo()
    {
        return $this->hasOne(InfoEquipo::class);
    }
}
