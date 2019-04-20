<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Cliente;
use App\Usuariocliente;
use App\Newsletter;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Clientes";
        $clientes = Cliente::orderBy('orden')->get();
        return view('adm.cliente.index',compact('title','clientes'));
    }

    public function clientes() {
        $title = "Clientes";
        $clientes = Usuariocliente::get();
        return view('adm.cliente.cliente',compact('title','clientes'));
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
        $datosRequest = $request->all();
        $ARR_data = [];
        $ARR_data["nombre"] = $datosRequest["titulo"];
        $ARR_data["orden"] = $datosRequest["orden"];
        $ARR_data["image"] = null;
        
        $file = $request->file("image");
        if(!is_null($file)) {
            
            $path = public_path('images/clientes/');
            if (!file_exists($path))
                mkdir($path, 0777, true);
            
            $imageName = time().'.'.$file->getClientOriginalExtension();
            $file->move($path, $imageName);
            $ARR_data["image"] = "images/familias/{$imageName}";
        }
        
        if(is_null($data))
            Cliente::create($ARR_data);
        else {
            
            if(isset($data["image"])) {
                $filename = public_path() . "/" . $data["image"];
                if (file_exists($filename))
                    unlink($filename);
            }
            $data->fill($ARR_data);
            $data->save();
        }
        return back();
    }
    public function storeG(Request $request, $data = null, $new = 1)
    {
        $datosRequest = $request->all();
        $ARR_data = [];
        $ARR_data["name"] = $datosRequest["name"];
        $ARR_data["username"] = $datosRequest["username"];
        $ARR_data["fecha"] = $datosRequest["fecha"];

        if($new) {
            if(empty($datosRequest["password"]))
                return back()->withErrors(['mssg' => 'La contraseña no puede estar vacio']);
            $aux = Usuariocliente::where("username",$datosRequest["username"])->first();
            if(!empty($aux))
                return back()->withErrors(['mssg' => 'Usuario existente']);
            $ARR_data["password"] = Hash::make($datosRequest["password"]);
        }
        
        if(is_null($data))
            Usuariocliente::create($ARR_data);
        else {
            if(!$new) {
                if(empty($datosRequest["password"]))
                    $ARR_data["password"] = $data["password"];
                else
                    $ARR_data["password"] = Hash::make($datosRequest["password"]);
            }
            $ARR_data["estado"] = 0;
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
        return Cliente::find($id);
    }
    public function editG($id)
    {
        return Usuariocliente::find($id);
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
    public function updateG(Request $request, $id)
    {
        $data = self::editG($id);
        self::storeG($request,$data,0);
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
        $filename = public_path() . "/" . $data["image"];
        if (file_exists($filename))
            unlink($filename);

        Cliente::destroy($id);
        return 0;
    }
    public function destroyG($id)
    {
        Usuariocliente::destroy($id);
        return 0;
    }

    public function newsletters() {
        $title = "Newsletter";
        $news = Newsletter::orderBy("idioma")->orderBy("email")->get();
        return view('adm.cliente.newsletter',compact('title','news'));
    }

    public function newsDelete($id) {
        Newsletter::destroy($id);
        return 0;
    }
}
