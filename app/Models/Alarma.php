<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dispositivo;
use Carbon\Carbon;

class Alarma extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispositivo_id',
        'oid_id',
        'codigo',
        'titulo',
        'message',
        'activo',
    ];

    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class);
    }

    public function errors($id)
    {
        return $this->whereCodigo(0)->where('dispositivo_id', $id)->whereDay('created_at', date('14'))->count();
    }

    public function success($id)
    {
        return $this->whereCodigo(1)->where('dispositivo_id', $id)->whereDay('created_at', date('14'))->count();
    }

    public function warning($id)
    {
        return $this->whereCodigo(2)->where('dispositivo_id', $id)->whereDay('created_at', date('14'))->count();
    }

    public function getAlarma($dispositivo, $date, $codigo)
    {
        if($date == 0)
        {
            $date = Carbon::now()->subMinutes(5);
        } elseif($date == 1)
        {
            $date = Carbon::now()->subHours(1);
        }
        return $this->whereDispositivoId($dispositivo)->whereActivo(1)->whereCodigo($codigo)->where('updated_at', '>=', $date)->count();
    }
}
