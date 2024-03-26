<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use FreeDSx\Snmp\Requests;
use FreeDSx\Snmp\SnmpClient;
use FreeDSx\Snmp\Exception\ConnectionException;
use FreeDSx\Snmp\Exception\SnmpRequestException;

use App\Models\Dispositivo;
use App\Models\InfoEquipo;
use App\Models\InfoAlarma;
use App\Models\InfoGrafica;
use App\Models\Alarma;


class GetDatosController extends Controller
{
    public $error   = 0;
    public $success = 1;
    public $warning = 2;
    public $error_alarma_status     = 3;
    public $success_alarma_status   = 4;
    public $warning_alarma_status   = 5;
    public $error_request   = 6;
    public $success_request = 7;

    public function __construct($equipo = null)
    {
        if(!is_null($equipo))
        {
            $datas = [];

            $snmp = new SnmpClient([
                'host'      => $equipo->ip_address,
                'version'   => $equipo->version_snmp,
                'community' => $equipo->comunidad,
            ]);

            $oid = $equipo->plantilla->plantillaOid->where('tipo_oid', 1)->first();

            try {
                $conexion = $snmp->getValue($oid).PHP_EOL;

                if ($conexion)
                {
                    $this->successConexion($equipo->id);

                    $this->getInfoAlarmas($equipo, $snmp);
                    $this->getInfoEquipo($equipo, $snmp);
                    $this->getInfoGrafica($equipo, $snmp);
                }

            } catch (ConnectionException $e) {
                $this->errorConexion($equipo->id);
            }
        }
    }

    public function getInfoAlarmas($equipo, $snmp)
    {
        $oids = $equipo->plantilla->plantillaOid->where('tipo_oid', 1);

        foreach($oids as $oid)
        {
            $datas[] = [
                'dispositivo_id'    => $equipo->id,
                'plantilla_id'      => $equipo->plantilla->id,
                'plantilla_oid_id'  => $oid->id,
                'data'              => $this->getValue($snmp, $oid, $equipo->id),
            ];
        }

        $this->saveDataInfoAlarma($datas);
    }

    public function getInfoEquipo($equipo, $snmp)
    {
        $oids = $equipo->plantilla->plantillaOid->where('tipo_oid', 2);

        foreach($oids as $oid)
        {
            $datas[] = [
                'dispositivo_id'    => $equipo->id,
                'plantilla_id'      => $equipo->plantilla->id,
                'plantilla_oid_id'  => $oid->id,
                'data'              => $this->getValue($snmp, $oid, $equipo->id),
            ];
        }

        $this->saveDataInfoEquipo($datas);
    }

    public function getInfoGrafica($equipo, $snmp)
    {
        $oids = $equipo->plantilla->plantillaOid->where('tipo_oid', 3);

        foreach($oids as $oid)
        {
            $datas[] = [
                'dispositivo_id'    => $equipo->id,
                'plantilla_id'      => $equipo->plantilla->id,
                'plantilla_oid_id'  => $oid->id,
                'data'              => $this->getValue($snmp, $oid, $equipo->id),
            ];
        }

        $this->saveDataInfoGrafica($datas);
    }

    public function getValue($snmp, $oid, $equipo)
    {
        try {

            $value = $snmp->getValue($oid->oid).PHP_EOL;

            if($value != $oid->status_ok)
            {
                $this->errorAlarmaStatus($equipo, $oid, $value);
            } else {
                $this->successAlarmaStatus($equipo, $oid, $value);
            }

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

    public function saveDataInfoAlarma($datas)
    {
        foreach ($datas as $data)
        {
            $infoAlarma = InfoAlarma::whereDispositivoId($data['dispositivo_id'])->wherePlantillaId($data['plantilla_id'])->wherePlantillaOidId($data['plantilla_oid_id'])->get();

            if($infoAlarma->count() > 0)
            {
                $infoAlarma = InfoEquipo::find($infoAlarma[0]->id);
                $infoAlarma->dispositivo_id = $data['dispositivo_id'];
                $infoAlarma->plantilla_id = $data['plantilla_id'];
                $infoAlarma->plantilla_oid_id = $data['plantilla_oid_id'];
                $infoAlarma->data = $data['data'];
                $infoAlarma->update();
            } else {
                InfoAlarma::create($data);
            }
        }
    }

    public function saveDataInfoEquipo($datas)
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

    public function saveDataInfoGrafica($datas)
    {
        foreach ($datas as $data)
        {
            InfoGrafica::create($data);
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

    public function errorAlarmaStatus($equipo, $oid, $value)
    {
        $alarma = $this->search($equipo, $this->error_alarma_status);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = true;
            $alarma->update();
        } else {
            Alarma::create([
                'dispositivo_id' => $equipo,
                'codigo' => $this->error_alarma_status,
                'titulo' => 'Error de Alarma',
                'message' => "Estado de error en la alarma ($oid->identificador). Valor devuelto ($value)"
            ]);
        }
    }

    public function successAlarmaStatus($equipo, $oid, $value)
    {
        $alarma = $this->search($equipo, $this->error_alarma_status);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = false;
            $alarma->update();
        }

        Alarma::create([
            'dispositivo_id' => $equipo,
            'codigo' => $this->success_alarma_status,
            'titulo' => 'Alarma Satisfactoria',
            'message' => "Estado de alarma ($oid->identificador) restablecido en satisfactorio. Valor devuelto ($value)"
        ]);
    }

    public function successRequest($equipo, $oid)
    {
        $alarma = $this->search($equipo, $this->error_request);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = false;
            $alarma->update();
        }

        $alarma = $this->search($equipo, $this->warning);

        if($alarma->count() > 0)
        {
            $alarma = Alarma::find($alarma[0]->id);
            $alarma->activo = false;
            $alarma->update();
        }

        Alarma::create([
            'dispositivo_id' => $equipo,
            'codigo' => $this->success_request,
            'titulo' => 'Solicitud SNMP Satisfactoria',
            'message' => "La solicitud SNMP al OID con identificador ($oid->identificador) se completó de forma satisfactorio. Valor devuelto ($value)"
        ]);
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

