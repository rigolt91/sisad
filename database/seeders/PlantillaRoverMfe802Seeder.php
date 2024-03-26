<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PlantillaOid;

class PlantillaRoverMfe802Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create([
            //Definicion de variables para los OID específicos de Alarmas
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Ethernet 1',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.3.1.2.1.1',
                'status_ok' => 1
            ],
            /*[
                'plantilla_id' => 2,
                'identificador' => 'Alarma Ethernet 2',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.3.1.2.1.2',
                'status_ok' => 1
            ],*/
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 1 Sync Loss',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.1.1',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 2 Sync Loss',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.2.1',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 3 Sync Loss',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.3.1',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 4 Sync Loss',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.4.1',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 1 Bitrate',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.1.2',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 2 Bitrate',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.2.2',
                'status_ok' => 2
            ],
            /*[
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 3 Bitrate',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.3.2',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Asi 4 Bitrate',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.4.2.1.1.2.1.4.2',
                'status_ok' => 2
            ],*/
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Temperatura',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.2.7.1.1.1.1',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Psu A Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.1.1.2.2',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Psu B Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.1.1.2.3',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Lock',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.3.20.0',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Slot 1',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.2.1.2.1',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Slot 2',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.2.1.2.2',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Slot 3',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.2.1.2.3',
                'status_ok' => 2
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Alarma Slot 4',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.2.1.2.4',
                'status_ok' => 2
            ],
            /*[
                'plantilla_id' => 2,
                'identificador' => 'Alarma Unit',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.4.3.1.2.1',
                'status_ok' => 2
            ],*/
            //Definicion de variables para los OID específicos de Informacion Estatica
            [
                'plantilla_id' => 2,
                'identificador' => 'Model Equipo',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.1.1.1.13.1.2.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Fw Release',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.1.1.1.15.1.3.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Serial Number Equipo',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.1.1.1.6.0',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Serial Id Equipo',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.1.1.1.6.0',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Ip Address',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.2.5.1.0',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Modelo',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.1.5.1.3.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Feature',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.1.5.1.4.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Sw Release',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.3.1.1.1.9.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Fpga Version',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.3.1.1.1.7.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Serial Number',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.1.1.4.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Serial Id',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.1.1.5.1',
                'status_ok' => ''
            ],
            //Definición de variables para los OID específicos de la Información a Graficar
            [
                'plantilla_id' => 2,
                'identificador' => 'Bitrate Ethernet In 1',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.3.1.5.1.1',
                'status_ok' => ''
            ],
            /*[
                'plantilla_id' => 2,
                'identificador' => 'Bitrate Ethernet In 2',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.3.1.5.1.2',
                'status_ok' => ''
            ],*/
            [
                'plantilla_id' => 2,
                'identificador' => 'Bitrate Asi Out 1',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.2.1.8.1.1',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Bitrate Asi Out 2',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.2.1.8.1.2',
                'status_ok' => ''
            ],
            /*[
                'plantilla_id' => 2,
                'identificador' => 'Bitrate Asi Out 3',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.2.1.8.1.3',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Bitrate Asu Out 4',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.4.7.3.2.1.8.1.4',
                'status_ok' => ''
            ],*/
            [
                'plantilla_id' => 2,
                'identificador' => 'Temperatura Equipo',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.3.1.0',
                'status_ok' => ''
            ],
            [
                'plantilla_id' => 2,
                'identificador' => 'Temperatura Fuente',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.2.1.3.1.3.1.0',
                'status_ok' => ''
            ],
            //Definición de variables para los OID específicos de comandos del sistema
            [
                'plantilla_id' => 2,
                'identificador' => 'Slot #1',
                'tipo_oid' => 4,
                'oid' => '1.2.3.4.5.6.7.8.9.0',
                'status_ok' => ''
            ],
            //Definición de variables para los OID específicos de comandos del sistema
            [
                'plantilla_id' => 2,
                'identificador' => 'Slot #2',
                'tipo_oid' => 4,
                'oid' => '1.2.3.4.5.6.7.8.9.0.0',
                'status_ok' => ''
            ],
            //Definición de variables para los OID específicos de comandos del sistema
            [
                'plantilla_id' => 2,
                'identificador' => 'Slot #3',
                'tipo_oid' => 4,
                'oid' => '1.2.3.4.5.6.7.8.9.0.0.0',
                'status_ok' => ''
            ],
            //Definición de variables para los OID específicos de comandos del sistema
            [
                'plantilla_id' => 2,
                'identificador' => 'Slot #4',
                'tipo_oid' => 4,
                'oid' => '1.2.3.4.5.6.7.8.9.0.0.0.0',
                'status_ok' => ''
            ],
        ]);
    }

    public function create($plantilla_oids)
    {
        foreach ($plantilla_oids as $plantilla_oid) {
            PlantillaOid::create([
                'plantilla_id' => $plantilla_oid['plantilla_id'],
                'identificador' => $plantilla_oid['identificador'],
                'tipo_oid' => $plantilla_oid['tipo_oid'],
                'oid' => $plantilla_oid['oid'],
                'status_ok' => $plantilla_oid['status_ok']
             ]);
        }
    }
}
