<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dispositivo;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function dispositivo() {
        return $this->hasMany(Dispositivo::class);
    }
}
