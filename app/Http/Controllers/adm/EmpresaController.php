<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Empresa;
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
        $datos = Empresa::first();
        $datos["contactos"] = json_decode($datos["contactos"], true);
        $datos["images"] = json_decode($datos["images"], true);
        $datos["domicilio"] = json_decode($datos["domicilio"], true);
        $datos["metadatos"] = json_decode($datos["metadatos"], true);
        
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
                $datosEmpresa = Empresa::first();
                $datosEmpresa["images"] = json_decode($datosEmpresa["images"], true);
                $ARR_data = [];
                $ARR_data["contactos"] = [];
                $ARR_data["contactos"]["email"] = [];
                $ARR_data["contactos"]["contacto"] = [];
                $ARR_data["contactos"]["contacto"]["ba"] = $datosRequest["telefono_ba"];
                $ARR_data["contactos"]["contacto"]["nq"] = $datosRequest["telefono_nq"];
                
                $ARR_data["images"] = $datosEmpresa["images"];
                $ARR_data["domicilio"] = [];
                $ARR_data["domicilio"]["ba"] = [
                    "calle" => $datosRequest["calle_ba"],
                    "altura" => $datosRequest["altura_ba"],
                    "cp" => $datosRequest["cp_ba"],
                    "localidad" => $datosRequest["localidad_ba"]
                ];
                $ARR_data["domicilio"]["nq"] = [
                    "calle" => $datosRequest["calle_nq"],
                    "altura" => $datosRequest["altura_nq"],
                    "mas" => $datosRequest["mas_nq"],
                    "localidad" => $datosRequest["localidad_nq"]
                ];

                $ARR_data["contactos"]["email"] = $datosRequest["email"];
                
                $file_logo = $request->file('logotipo');
                $file_favicon = $request->file('favicon');

                if(!is_null($file_logo)) {
                    $path = public_path('images/empresa/');
                    if (!file_exists($path))
                        mkdir($path, 0777, true);
                    
                    if(!empty($datosEmpresa["images"]["logo"])) {
                        $filename = public_path() . "/" . $datosEmpresa["images"]["logo"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                    $imageName = 'logo.'.$file_logo->getClientOriginalExtension();
                    $file_logo->move($path, $imageName);
                    
                    $ARR_data["images"]["logo"] = "images/empresa/{$imageName}";
                }
                if(!is_null($file_favicon)) {
                    $path = public_path('images/empresa/');
                    if (!file_exists($path))
                        mkdir($path, 0777, true);
                    
                    if(!empty($datosEmpresa["images"]["favicon"])) {
                        $filename = public_path() . "/" . $datosEmpresa["images"]["favicon"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                    $imageName = 'favicon.'.$file_favicon->getClientOriginalExtension();
                    $file_favicon->move($path, $imageName);
                    
                    $ARR_data["images"]["favicon"] = ["i" => "images/empresa/{$imageName}","e" => $file_favicon->getClientOriginalExtension()];
                }
                
                $ARR_data["contactos"] = json_encode($ARR_data["contactos"]);
                $ARR_data["domicilio"] = json_encode($ARR_data["domicilio"]);
                $ARR_data["images"] = json_encode($ARR_data["images"]);
                
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
        $metadatos = Metadato::get();
        
        return view('adm.empresa.index',compact('title','seccion','metadatos'));
    }
    /** */
    public function metadato($id) {
        return Metadato::find($id);
    }
    /** */
    public function metadatoPOST(Request $request, $id) {
        $data = Metadato::find($id);
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
    public function mis_datos() {
        $title = "Mis datos";
        $datos = User::find(Auth::user()["id"]);
        
        return view('adm.empresa.mis_datos',compact('title','datos'));
    }
    public function mis_datos_s(Request $request,$id) {
        $datosRequest = $request->all();
        unset($datosRequest["_token"]);
        $datos = User::find(Auth::user()["id"]);

        if(empty($datosRequest["password"]))
            $datosRequest["password"] = $datos["password"];
        else
            $datosRequest["password"] = Hash::make($datosRequest["password"]);
        $datos->fill($datosRequest);
        $datos->save();

        return back()->withSuccess(['mssg' => "Datos modificados"]);
    }
}
