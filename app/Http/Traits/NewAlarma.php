<?php
namespace App\Http\Traits;

use App\Models\Alarma;

trait NewAlarma {

    public $error = 0;
    public $success = 1;
    public $warning = 2;

    public function newAlarma($alarma)
    {
        Alarma::create($alarma);
    }

    public function errorConexion()
    {
        $search = $this->searchError($this->error);

        if($search->count() > 0)
        {
            $alarma = Alarma::find($search[0]->id);
            $alarma->activo = true;
            $alarma->update();
        }else{
            $this->newAlarma([
                'dispositivo_id' => $this->dispositivo->id,
                'codigo' => $this->error,
                'titulo' => 'Error de conexción',
                'message' => "No se recive mensaje del dispositivo."
            ]);
        }

        $search = $this->searchError($this->success);

        if($search->count() > 0)
        {
            $alarma = Alarma::find($search[0]->id);
            $alarma->activo = false;
            $alarma->update();
        }
    }

    public function cadenaVacia($oid)
    {
        $this->newAlarma([
            'dispositivo_id' => $this->dispositivo->id,
            'codigo' => $this->warning,
            'titulo' => 'Cadena vacía',
            'message' => "Se devolvio cadena vacia del dispositivo al realizar peticion de oid ($oid->identificador)."
        ]);
    }

    public function errorSolicitud($oid)
    {
        $search = $this->searchError($this->warning);

        if($search->count() > 0)
        {
            $alarma = Alarma::find($search[0]->id);
            $alarma->activo = true;
            $alarma->update();
        }else{
            $this->newAlarma([
                'dispositivo_id' => $this->dispositivo->id,
                'codigo' => $this->error,
                'titulo' => 'Error de solicitud',
                'message' => "Al realizar la petición al dispositivo no se obtuvieron datos del oid ($oid->identificador)."
            ]);
        }
    }

    public function successConexion()
    {
        $search = $this->searchError($this->error);

        if($search->count() > 0)
        {
            $alarma = Alarma::find($search[0]->id);
            $alarma->activo = false;
            $alarma->update();
        }

        $search = $this->searchError($this->success);

        if($search->count() > 0)
        {
            $alarma = Alarma::find($search[0]->id);
            $alarma->activo = true;
            $alarma->update();
        }else{
            $this->newAlarma([
                'dispositivo_id' => $this->dispositivo->id,
                'codigo' => $this->success,
                'titulo' => 'Conexión establecida',
                'message' => "Conexión establecida correctamente con el dispositivo."
            ]);
        }
    }

    public function successPeticion($oid)
    {
        $search = $this->searchError($this->warning);

        if($search->count() > 0)
        {
            $alarma = Alarma::find($search[0]->id);
            $alarma->activo = false;
            $alarma->update();
        }
    }

    public function searchError($codigo)
    {
        return Alarma::where('dispositivo_id', $this->dispositivo->id)->where('codigo', $codigo)->where('activo', true)->get();
    }
}
