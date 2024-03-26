<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use FreeDSx\Snmp\Requests;
use FreeDSx\Snmp\SnmpClient;
use FreeDSx\Snmp\Exception\ConnectionException;
use FreeDSx\Snmp\Exception\SnmpRequestException;

class ResetComandoDispositivo extends Controller
{
    public function resetComando($dispositivo, $oid)
    {
        $snmp = new SnmpClient([
            'host'      => $dispositivo->ip_address,
            'version'   => $dispositivo->version_snmp,
            'community' => $dispositivo->comunidad,
        ]);

       try {

            $snmp->getValue($oid).PHP_EOL;

            return ['status' => true, 'message' => 'El comando se ha ejecutado correctamente.'];

        } catch (ConnectionException $e) {
            return ['status' => false, 'message' => 'No es posible establecer conexión con el equipo.'];
        }
    }
}
