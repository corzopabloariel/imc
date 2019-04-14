<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cliente;
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
        $datosRequest = $request->all();dd($datosRequest);
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
        $data = self::edit($id);
        $filename = public_path() . "/" . $data["image"];
        if (file_exists($filename))
            unlink($filename);

        Cliente::destroy($id);
        return 0;
    }
}
