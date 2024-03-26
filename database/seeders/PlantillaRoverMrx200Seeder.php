<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PlantillaOid;

class PlantillaRoverMrx200Seeder extends Seeder
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
                'plantilla_id' => 1,
                'identificador' => 'Alarma Voltaje PSU',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.5.2.1.0',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Corriente PSU',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.5.2.2.0',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Fan',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.5.2.3.1.2.1',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma PSU',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.5.2.4.0',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Temperatura',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.4.1.2.0',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Video Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.7.5.1.2.1.3.2',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma TS Chanel Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.7.5.1.2.1.3.3',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Audio Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.7.5.1.2.1.3.4',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Service Encrypted Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.7.5.1.2.1.3.5',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Black Video Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.7.5.1.2.1.3.6',
                'status_ok' => 1
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Alarma Still Video Status',
                'tipo_oid' => 1,
                'oid' => '.1.3.6.1.4.1.19324.2.3.7.5.1.2.1.3.7',
                'status_ok' => 1
            ],

            //Definicion de variables para los OID específicos de Informacion Estatica
            [
                'plantilla_id' => 1,
                'identificador' => 'Serial Number',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.1.1.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'FW Version',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.1.2.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'HW Version',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.1.3.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'FPGA Version',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.1.4.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Fecha',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.1.4.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Hora',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.2.2.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Ip Address',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.3.6.1.2.1'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'TSOIP',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.9.1.1.1.6.1'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Puerto TSOIP',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.9.1.1.1.7.1'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Link Value',
                'tipo_oid' => 2,
                'oid' => '.1.3.6.1.4.1.19324.2.3.9.2.1.0'
            ],

            //Definicion de variables para los OID específicos de la Informacion a Graificar
            [
                'plantilla_id' => 1,
                'identificador' => 'RPM Fan',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.3.1.1.5.1'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Voltage PSU',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.3.1.1.2.1'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Corriente PSU',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.3.1.1.3.1'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Temperatura Equipo',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.3.1.2.3.0'
            ],
            [
                'plantilla_id' => 1,
                'identificador' => 'Temperatura Fuente',
                'tipo_oid' => 3,
                'oid' => '.1.3.6.1.4.1.19324.2.3.11.3.1.1.4.1'
            ]
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
             ]);
        }
    }
}
