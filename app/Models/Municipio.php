<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dispositivo;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'provincia_id'
    ];

    public function dispositivo() {
        return $this->hasMany(Dispositivo::class);
    }
}
