<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RRHH;
class RRHHcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Recursos humanos";
        $trabajos = RRHH::orderBy('orden')->get();
        return view('adm.rrhh.index',compact('title','trabajos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $data = null)
    {
        $aux = ["nombre" => null,"experiencia" => null,"rango" => null,"orientacion" => null];
        $datosRequest = $request->all();
        $ARR_data = [];
        $ARR_data["provincia"] = $datosRequest["provincia"];
        $ARR_data["orden"] = $datosRequest["orden"];
        $ARR_data["data"] = [];
        $ARR_data["data"]["esp"] = $aux;
        $ARR_data["data"]["ing"] = $aux;
        $ARR_data["data"]["ita"] = $aux;

        foreach($ARR_data["data"] AS $k => $v) {
            foreach($ARR_data["data"][$k] AS $kk => $vv)
            $ARR_data["data"][$k][$kk] = $datosRequest["{$kk}_{$k}"];
        }
        $ARR_data["data"] = json_encode($ARR_data["data"]);

        if(is_null($data))
            RRHH::create($ARR_data);
        else {
            $data->fill($ARR_data);
            $data->save();
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return RRHH::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = self::edit($id);
        self::store($request,$data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
