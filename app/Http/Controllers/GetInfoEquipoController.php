<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use FreeDSx\Snmp\Requests;
use FreeDSx\Snmp\SnmpClient;
use FreeDSx\Snmp\Exception\ConnectionException;
use FreeDSx\Snmp\Exception\SnmpRequestException;

use App\Models\Dispositivo;
use App\Models\InfoEquipo;
use App\Models\Alarma;

class GetInfoEquipoController extends Controller
{
    public $error   = 0;
    public $success = 1;
    public $warning = 2;
    public $error_request   = 6;
    public $success_request = 7;

    public function __construct($id)
    {
        $equipo = Dispositivo::find($id);

        $datas = [];

        $snmp = new SnmpClient([
            'host'      => $equipo->ip_address,
            'version'   => $equipo->version_snmp,
            'community' => $equipo->comunidad,
        ]);

        $oids = $equipo->plantilla->plantillaOid->where('tipo_oid', 2);

        try {
            $conexion = $snmp->getValue($oids->first()->oid).PHP_EOL;

            if ($conexion)
            {
                $this->successConexion($equipo->id);

                foreach($oids as $oid)
                {
                    $datas[] = [
                        'dispositivo_id'    => $equipo->id,
                        'plantilla_id'      => $equipo->plantilla->id,
                        'plantilla_oid_id'  => $oid->id,
                        'data'              => $this->getValue($snmp, $oid, $equipo->id),
                    ];
                }
            }

        } catch (ConnectionException $e) {
            $this->errorConexion($equipo->id);
        }

        $this->saveData($datas);
    }

    public function getValue($snmp, $oid, $equipo)
    {
        try {

            $value = $snmp->getValue($oid->oid).PHP_EOL;

            if(empty($value) || is_null($value))
            {
                $this->warningRequest($equipo, $oid);
            } else {
                $this->successRequest($equipo, $oid, $value);
            }

        } catch (SnmpRequestException $e) {

            $this->errorRequest($equipo, $oid);
        }

        return $value;
    }

    public function saveData($datas)
    {
        foreach ($datas as $data)
        {
            $infoEquipo = InfoEquipo::whereDispositivoId($data['dispositivo_id'])->wherePlantillaId($data['plantilla_id'])->wherePlantillaOidId($data['plantilla_oid_id'])->get();

            if($infoEquipo->count() > 0)
            {
                $infoEquipo = InfoEquipo::find($infoEquipo[0]->id);
                $infoEquipo->dispositivo_id = $data['dispositivo_id'];
                $infoEquipo->plantilla_id = $data['plantilla_id'];
                $infoEquipo->plantilla_oid_id = $data['plantilla_oid_id'];
                $infoEquipo->data = $data['data'];
                $infoEquipo->update();
            } else {
                InfoEquipo::create($data);
            }
        }
    }

    public function successConexion($equipo)
    {
        $alarma_error = $this->search($equipo, $this->error);

        if($alarma_error->count() > 0)
        {
            $alarma_error = Alarma::find($alarma_error[0]->id);
            $alarma_error->activo = false;
            $alarma_error->update();
        }

        $alarma_success = $this->search($equipo, $this->success);

        if($alarma_success->count() > 0)
        {
            $alarma_success = Alarma::find($alarma_success[0]->id);
            $alarma_success->activo = true;
            $alarma_success->update();
        } else {
            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->success,
                'titulo' => 'Conexión establecida',
                'message' => "Conexión establecida correctamente con el dispositivo."
            ]);
        }
    }

    public function errorConexion($equipo)
    {
        $alarma = $this->search($equipo, $this->error);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = true;
            $alarma->update();
        } else {
            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->error,
                'titulo' => 'Error de conexción',
                'message' => "No se recive mensaje del dispositivo."
            ]);
        }
    }

    public function successRequest($equipo, $oid, $value)
    {
        $alarma = $this->search($equipo, $this->error_request);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = false;
            $alarma->update();

            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->success_request,
                'titulo' => 'Solicitud SNMP Satisfactoria',
                'message' => "La solicitud SNMP al OID con identificador ($oid->identificador) se completó de forma satisfactorio. Valor devuelto ($value)"
            ]);
        } else {
            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->success_request,
                'titulo' => 'Solicitud SNMP Satisfactoria',
                'message' => "La solicitud SNMP al OID con identificador ($oid->identificador) se completó de forma satisfactorio. Valor devuelto ($value)"
            ]);
        }

        $alarma = $this->search($equipo, $this->warning);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = false;
            $alarma->update();

            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->success_request,
                'titulo' => 'Solicitud SNMP Satisfactoria',
                'message' => "La solicitud SNMP al OID con identificador ($oid->identificador) se completó de forma satisfactorio. Valor devuelto ($value)"
            ]);
        }
    }

    public function warningRequest($equipo, $oid)
    {
        $alarma = $this->search($equipo, $this->warning);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = true;
            $alarma->update();
        } else {
            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->warning,
                'titulo' => 'Advertencia de Cadena Vacía',
                'message' => "Se devolvió cadena vacía en la solicitud SNMP al OID con identificador ($oid->identificador)."
            ]);
        }
    }

    public function errorRequest($equipo, $oid)
    {
        $alarma = $this->search($equipo, $this->error_request);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = true;
            $alarma->update();
        } else {
            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->error_request,
                'titulo' => 'Error de Solicitud SNMP',
                'message' => "Error en la solicitud SNMP al OID con identificador ($oid->identificador)."
            ]);
        }
    }

    public function search($equipo, $codigo)
    {
        return Alarma::whereDispositivoId($equipo)->whereCodigo($codigo)->whereActivo(true)->get();
    }
}
