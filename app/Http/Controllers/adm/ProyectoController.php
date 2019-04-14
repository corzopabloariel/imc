<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyecto;
use App\Producto;
class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $title = "Proyectos";
        $proyectos = Proyecto::orderBy('orden')->get();
        $productos = Producto::orderBy('orden')->pluck('titulo', 'id');
        return view('adm.proyecto.index',compact('title','seccion','proyectos','productos'));
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
        
        $model = new Proyecto();
        $ARR_data = [];
        foreach($model->getFillable() AS $f) {
            if($f == "img") {
                $ARR_data[$f] = [];
                continue;
            }
            if(isset($datosRequest[$f]))
                $ARR_data[$f] = $datosRequest[$f];
        }
        
        if(is_null($data)) {//NUEVO
            
            if(isset($datosRequest["nombreImg"])) {
                $files = $request->file('img');
                for($i = 0; $i < count($datosRequest["nombreImg"]); $i++) {
                    $img = null;
                    
                    if(!is_null($files[$i])) {
                        $path = public_path('images/proyectos/');
                        if (!file_exists($path))
                            mkdir($path, 0777, true);
                        
                        $imageName = time().'_proyecto_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                        $files[$i]->move($path, $imageName);
                        $img = "images/proyectos/{$imageName}";
                    }
                    $ARR_data["img"][] = $img;
                }
                $ARR_data["img"] = json_encode($ARR_data["img"]);
            }
            Proyecto::create($ARR_data);
        } else {
            $A_caracteristicas = [];
            if(isset($datosRequest["nombreImg"])) {
                $files = $request->file('img');
                for($i = 0; $i < count($datosRequest["nombreImg"]); $i++) {
                    $img = null;
                    if(is_numeric($datosRequest["nombreImg"][$i])) {
                        if(!is_null($files[$i])) {
                            $path = public_path('images/proyectos/');
                            if (!file_exists($path))
                                mkdir($path, 0777, true);
                            
                            $imageName = time().'_proyecto_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                            $files[$i]->move($path, $imageName);
                            $img = "images/proyectos/{$imageName}";
                        }
                    } else {
                        for($j = 0; $j < count($data["img"]); $j++) {
                            if(strcasecmp($data["img"][$j], $datosRequest["nombreImg"][$i]) == 0) {
                                
                                $A_caracteristicas[] = $data["img"][$j];
                                $img = $data["img"][$j];
                                break;
                            }
                        }
                    }
                    
                    $ARR_data["img"][] = $img;
                }
                for($j = 0; $j < count($data["img"]); $j++) {
                    if(!in_array($data["img"][$j],$A_caracteristicas))  {
                        $filename = public_path() . "/" . $data["img"][$j];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                }
            } else {
                for($j = 0; $j < count($data["img"]); $j++) {
                    if(!in_array($data["img"][$j],$A_caracteristicas))  {
                        $filename = public_path() . "/" . $data["img"][$j];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                }
            }
            $ARR_data["img"] = json_encode($ARR_data["img"]);
            $data->fill($ARR_data);
            $data->save();
        }

        return back();
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
        $data = Proyecto::find($id);
        
        return $data;
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
        $data["img"] = json_decode($data["img"],true);
        
        // dd($request->all());
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
        $data["img"] = json_decode($data["img"],true);
        for($i = 0; $i < count($data["img"]); $i ++) {
            $filename = public_path() . "/" . $data["img"][$i];
            if (file_exists($filename))
                unlink($filename);
        }

        Proyecto::destroy($id);
        return 1;
    }
}
