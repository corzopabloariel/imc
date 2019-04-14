<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dato;
use App\Metadato;
use App\User;
class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $title = "Datos de la empresa";
        $seccion = "empresa";
        $datos = Dato::first();
        $datos["redes"] = json_decode($datos["redes"], true);
        $datos["img"] = json_decode($datos["img"], true);
        $datos["domicilio"] = json_decode($datos["domicilio"], true);
        $datos["tel"] = json_decode($datos["tel"], true);
        $datos["email"] = json_decode($datos["email"], true);
        
        return view('adm.empresa.index',compact('title','seccion','datos'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $seccion)
    {
        $datosRequest = $request->all();
        $ARR_datos = [];
        switch($seccion) {
            case "empresa":
                $datosEmpresa = Dato::first();
                $datosEmpresa["img"] = json_decode($datosEmpresa["img"], true);
                $model = new Dato();
                $ARR_data = [];
                foreach($model->getFillable() AS $f) {
                    $ARR_data[$f] = [];
                }
                $ARR_data["img"] = [
                    "logo" => null,
                    "favicon" => null,
                    "logo_footer" => null,
                    "data_fiscal" => null
                ];
                $ARR_data["tel"] = $datosRequest["telefono"];
                $ARR_data["domicilio"] = [
                    "calle" => $datosRequest["calle"],
                    "altura" => $datosRequest["altura"],
                    "localidad" => $datosRequest["localidad"],
                    "cp" => $datosRequest["cp"]
                ];
                $ARR_data["redes"] = [
                    "facebook" => $datosRequest["facebook"],
                    "youtube" => $datosRequest["youtube"]
                ];
                for($i = 0; $i < count($datosRequest["email"]); $i++) {
                    if(empty($datosRequest["email"][$i]))
                        continue;

                    $ARR_data["email"][] = [
                        "e" => $datosRequest["email"][$i],
                        "n" => $datosRequest["email_nombre"][$i]
                    ];
                }
                $file_logo = $request->file('logotipo');
                $file_logoFooter = $request->file('logotipo_footer');
                $file_favicon = $request->file('favicon');

                if(!is_null($file_logo)) {
                    $path = public_path('images/empresa/');
                    if (!file_exists($path))
                        mkdir($path, 0777, true);
                    
                    if(!empty($datosEmpresa["img"]["logo"])) {
                        $filename = public_path() . "/" . $datosEmpresa["img"]["logo"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                    $imageName = 'logo.'.$file_logo->getClientOriginalExtension();
                    $file_logo->move($path, $imageName);
                    
                    $ARR_data["img"]["logo"] = "images/empresa/{$imageName}";
                } else
                    $ARR_data["img"]["logo"] = $datosEmpresa["img"]["logo"];
                if(!is_null($file_logoFooter)) {
                    $path = public_path('images/empresa/');
                    if (!file_exists($path))
                        mkdir($path, 0777, true);
                    
                    if(!empty($datosEmpresa["img"]["logo_footer"])) {
                        $filename = public_path() . "/" . $datosEmpresa["img"]["logo_footer"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                    $imageName = 'logo_footer.'.$file_logoFooter->getClientOriginalExtension();
                    $file_logoFooter->move($path, $imageName);
                    
                    $ARR_data["img"]["logo_footer"] = "images/empresa/{$imageName}";
                } else
                    $ARR_data["img"]["logo_footer"] = $datosEmpresa["img"]["logo_footer"];
                if(!is_null($file_favicon)) {
                    $path = public_path('images/empresa/');
                    if (!file_exists($path))
                        mkdir($path, 0777, true);
                    
                    if(!empty($datosEmpresa["img"]["favicon"])) {
                        $filename = public_path() . "/" . $datosEmpresa["img"]["favicon"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                    $imageName = 'favicon.'.$file_favicon->getClientOriginalExtension();
                    $file_favicon->move($path, $imageName);
                    
                    $ARR_data["img"]["favicon"] = ["i" => "images/empresa/{$imageName}","e" => $file_favicon->getClientOriginalExtension()];
                } else
                    $ARR_data["img"]["favicon"] = $datosEmpresa["img"]["favicon"];

                foreach($model->getFillable() AS $f) {
                    $ARR_data[$f] = json_encode($ARR_data[$f]);
                }
                $datosEmpresa->fill($ARR_data);
                $datosEmpresa->save();
                break;
        }
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
    /** */
    public function metadatos() {

        $title = "Metadatos";
        $seccion = "metadato";
        $metadatos = Metadato::orderBy('seccion')->get();
        
        return view('adm.empresa.index',compact('title','seccion','metadatos'));
    }
    /** */
    public function metadato($id) {
        return Metadato::find($id);
    }
    /** */
    public function metadatoPOST(Request $request, $id) {
        $data = metadato::find($id);
        $datosRequest = $request->all();
        unset($datosRequest["_token"]);
        unset($datosRequest["_method"]);

        $data->fill($datosRequest);
        $data->save();

        return back();
    }
    /** */
    public function usuarios() {
        $title = "Usuarios";
        $seccion = "";
        $usuarios = User::orderBy('username')->get();
        return view('adm.empresa.usuario',compact('title','seccion','usuarios'));
    }
}
