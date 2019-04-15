<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Archivo;
class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($seccion)
    {
        $seccion = strtoupper($seccion);
        $title = $seccion;
        $archivos = Archivo::where('seccion',strtolower($seccion))->orderBy('orden')->get();

        return view('adm.archivo.index', compact('title','seccion','archivos'));
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
    public function store(Request $request, $seccion, $data = null)
    {
        $aux = ["esp" => null,"ing" => null,"ita" => null];
        $datosRequest = $request->all();
        $ARR_data = [];
        $ARR_data["orden"] = $datosRequest["orden"];
        $ARR_data["seccion"] = $seccion;
        $ARR_data["nombre"] = $aux;
        $ARR_data["documento"] = $aux;
        
        foreach($ARR_data["documento"] AS $k => $v) {
            $file = $request->file("documento_{$k}");
            if(!is_null($file)) {
                $path = public_path('images/documents/')."{$seccion}";
                if (!file_exists($path))
                    mkdir($path, 0777, true);
                $documentoName = time().'.'.$request->file("documento_{$k}")->getClientOriginalExtension();
                $file->move($path, $documentoName);
                $ARR_data["documento"][$k] = "documents/{$seccion}/{$documentoName}";
                
                if(!is_null($data)) {
                    foreach($data["documento"] AS $k => $v) {
                        $filename = public_path() . "/" . $data["documento"]["k"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                }
            } else {
                if(!is_null($data))
                    $ARR_data["documento"] = $data["documento"];
            }
        }
        foreach($ARR_data["nombre"] AS $k => $v)
            $ARR_data["nombre"][$k] = $datosRequest["nombre_{$k}"];
        $ARR_data["nombre"] = json_encode($ARR_data["nombre"]);
        $ARR_data["documento"] = json_encode($ARR_data["documento"]);
        if(is_null($data))
            Archivo::create($ARR_data);
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
        return Archivo::find($id);
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
        $data["documento"] = json_decode($data["documento"],true);
        self::store($request,$data["seccion"],$data);
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
        $data = self::edit($id);
        foreach($data["documento"] AS $k => $v) {
            $filename = public_path() . "/" . $data["documento"]["k"];
            if (file_exists($filename))
                unlink($filename);
        }

        Archivo::destroy($id);
        return 1;
    }
}
