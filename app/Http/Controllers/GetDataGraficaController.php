<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoGrafica;
use Carbon\Carbon;

class GetDataGraficaController extends Controller
{
    public $dispositivo;
    public $plantilla;
    public $graficas;
    public $date;

    public function setDatas($graficas, $dispositivo, $plantilla, $date)
    {
        $this->graficas = $graficas;
        $this->dispositivo = $dispositivo;
        $this->plantilla = $plantilla;
        $this->date = $date;
    }

    public function responseData(Request $request)
    {
        $this->graficas = $request->graficas;
        $this->dispositivo = $request->dispositivo;
        $this->plantilla = $request->plantilla;
        $this->date = $request->date;

        $result = $this->getDataPrueba();

        return response()->json(['result' => $result, 'date' => $this->date]);
    }

    public function getDataPrueba()
    {
        $datas = [];

        foreach ($this->graficas as $key => $grafica) {
            $data = $this->getDatosGraficar($grafica['id']);

            $datas[] = [
                'identificador' => $grafica['identificador'],
                'datas' => $data
            ];
        }

        return $datas;
    }

    public function getDatas()
    {
        foreach ($this->graficas as $key => $grafica) {
            $datas[] = [
                'identificador' => $grafica['identificador'],
                'datas' => $this->getDatosGraficar($grafica['id'])
            ];
        }

        return $datas;
    }

    public function getDatosGraficar($plantilla_oid_id)
    {
        $data = [];

        if($this->date == '0')
        {
            $date = Carbon::now()->subMinutes(5);

            $data_graficas = InfoGrafica::select('data', 'created_at')->where('dispositivo_id', $this->dispositivo)
                ->where('plantilla_id', $this->plantilla)
                ->where('plantilla_oid_id', $plantilla_oid_id)
                ->where('created_at', '>=', $date)
                ->take(10)
                ->latest()
                ->get();
        } elseif($this->date == '1') {
            $date = Carbon::now()->subHour();

            $data_graficas = InfoGrafica::select('data', 'created_at')->where('dispositivo_id', $this->dispositivo)
                ->where('plantilla_id', $this->plantilla)
                ->where('plantilla_oid_id', $plantilla_oid_id)
                ->where('created_at', '>=', $date)
                ->latest()
                ->get();
        } else {
            $data_graficas = InfoGrafica::select('data', 'created_at')->where('dispositivo_id', $this->dispositivo)
                ->where('plantilla_id', $this->plantilla)
                ->where('plantilla_oid_id', $plantilla_oid_id)
                ->take(50)
                ->latest()
                ->get();
        }

        foreach($data_graficas as $data_grafica)
        {
            $data[] = $data_grafica->data;
            $created_at[] = date($data_grafica->created_at->format('H:i:s'));
        }

        $array = [];

        if(count($data) > 0)
        {
            $array = [
                'data_actual' => end($data),
                'data' => array_reverse($data),
                'created_at' => array_reverse($created_at)
            ];
        }

        return $array;
    }
}
