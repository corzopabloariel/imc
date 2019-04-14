<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Productosimg;
use App\Familia;
use App\Proyecto;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Productos";
        $productos = Producto::orderBy('orden')->get();
        $familias = Familia::orderBy('orden')->pluck('titulo', 'id');
        return view('adm.familia.producto',compact('title','productos','familias'));
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
        
        $model = new Producto();
        $ARR_data = [];
        foreach($model->getFillable() AS $f) {
            if($f == "data") {
                $ARR_data[$f] = [];
                $ARR_data[$f]["descripcion"] = "";
                $ARR_data[$f]["detalle"] = "";
                $ARR_data[$f]["video"] = null;
                $ARR_data[$f]["caracteristicas"] = [];
                continue;
            }
            if($f == "destacado") {
                $ARR_data[$f] = !empty($datosRequest[$f]) ? 1 : 0;
                continue;
            }

            if(isset($datosRequest[$f]))
                $ARR_data[$f] = $datosRequest[$f];
        }
        $ARR_data["data"]["especificaciones"] = null;
        if(isset($datosRequest["video"]))
            $ARR_data["data"]["video"] = $datosRequest["video"];
        if(isset($datosRequest["descripcion"]))
            $ARR_data["data"]["descripcion"] = $datosRequest["descripcion"];
        if(isset($datosRequest["detalle"]))
            $ARR_data["data"]["detalle"] = $datosRequest["detalle"];
        // data: {descripcion: “”, detalle: “”, caracteristicas: [], video: “”}
        /**
         * 
         */
        if(is_null($data)) {
            
            if(isset($datosRequest["nombre"])) {
                $files = $request->file('img_opcion');
                for($i = 0; $i < count($datosRequest["nombre"]); $i++) {
                    $img = null;
                    
                    if(!is_null($files[$i])) {
                        $path = public_path('images/familias/productos/');
                        if (!file_exists($path))
                            mkdir($path, 0777, true);
                        
                        $imageName = time().'_caracteristicas_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                        $files[$i]->move($path, $imageName);
                        $img = "images/familias/productos/{$imageName}";
                    }
                    $ARR_data["data"]["caracteristicas"][] = ["img" => $img,"nombre" => $datosRequest["nombre"][$i]];
                }
            }
            $file = $request->file('especificaciones');
            if(!is_null($file)) {
                $path = public_path('documents/');
                if (!file_exists($path))
                    mkdir($path, 0777, true);
                $imageName = time().'_documents.'.$file->getClientOriginalExtension();
                $file->move($path, $imageName);
                $ARR_data["data"]["especificaciones"] = "documents/{$imageName}";
            }

            $ARR_data["data"] = json_encode($ARR_data["data"]);
            $producto = Producto::create($ARR_data);
            $producto->productos()->sync($request->get('productos'));

            $Arr = [];
            $files = $request->file('img');
            if(!is_null($files)) {
                $path = public_path('images/familias/productos/');
                if (!file_exists($path))
                    mkdir($path, 0777, true);
                for($i = 0; $i < count($files); $i++) {
                    $imageName = time().'_producto_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                    $files[$i]->move($path, $imageName);
                    $img = "images/familias/productos/{$imageName}";
                    Productosimg::create([
                        "producto_id" => $producto["id"],
                        "img" => $img,
                        "orden" => $i + 1
                    ]);
                }
            }
            
        } else {
            /* -------------------------------------------------
                CARACTERÍSTICAS DE PRODUCTO
            -------------------------------------------------- */
            if(isset($datosRequest["nombreCar"])) {
                
                $files = $request->file('img_opcion');
                $A_caracteristicas = [];
                for($i = 0; $i < count($datosRequest["nombreCar"]); $i++) {
                    $img = null;
                    $caracteristica = null;
                    /**
                     * TRUE: img nueva
                     */
                    if(is_numeric($datosRequest["nombreCar"][$i])) {
                        $filesAux = $files[$i];
                        
                        $path = public_path('images/familias/productos/');
                        if (!file_exists($path))
                            mkdir($path, 0777, true);
                        
                        $imageName = time().'_caracteristicas_' . ($i + 1) . '.'.$filesAux->getClientOriginalExtension();
                        
                        $filesAux->move($path, $imageName);
                        $img = "images/familias/productos/{$imageName}";
                    } else {
                        for($j = 0; $j < count($data["data"]["caracteristicas"]); $j++) {
                            if(strcasecmp($data["data"]["caracteristicas"][$j]["img"], $datosRequest["nombreCar"][$i]) == 0) {
                                
                                $A_caracteristicas[] = $data["data"]["caracteristicas"][$j]["img"];
                                $img = $data["data"]["caracteristicas"][$j]["img"];
                                break;
                            }
                        }
                    }
                    $ARR_data["data"]["caracteristicas"][] = ["img" => $img,"nombre" => $datosRequest["nombre"][$i]];
                }
                
                for($j = 0; $j < count($data["data"]["caracteristicas"]); $j++) {
                    if(!in_array($data["data"]["caracteristicas"][$j]["img"],$A_caracteristicas))  {
                        $filename = public_path() . "/" . $data["data"]["caracteristicas"][$j]["img"];
                        if (file_exists($filename))
                            unlink($filename);
                    }
                }
            } else {
                for($j = 0; $j < count($data["data"]["caracteristicas"]); $j++) {
                    $filename = public_path() . "/" . $data["data"]["caracteristicas"][$j]["img"];
                    if (file_exists($filename))
                        unlink($filename);
                }
            }
            $file = $request->file('especificaciones');
            if(!is_null($file)) {
                $filename = public_path() . "/" . $data["data"]["especificaciones"];
                if(!empty($data["data"]["especificaciones"])) {
                    if (file_exists($filename))
                        unlink($filename);
                }
                $path = public_path('documents/');
                if (!file_exists($path))
                    mkdir($path, 0777, true);
                $imageName = time().'_documents.'.$file->getClientOriginalExtension();
                $file->move($path, $imageName);
                $ARR_data["data"]["especificaciones"] = "documents/{$imageName}";
            }
            $ARR_data["data"] = json_encode($ARR_data["data"]);
            $imagenesAux = [];
            $imagenes = $data["imagenes"];
            unset($data["imagenes"]);
            unset($data["productos"]);
            
            $data->fill($ARR_data);
            $data->save();
            $data->productos()->sync($request->get('productos'));
            /* -------------------------------------------------
                IMAGENES DE PRODUCTO
            -------------------------------------------------- */
            $files = $request->file('img');
            
            if(isset($datosRequest["nombreImg"])) {
                for($i = 0; $i < count($datosRequest["nombreImg"]); $i++) {
                    $image = null;
                    $img = null;
                    if(is_numeric($datosRequest["nombreImg"][$i])) {
                        if(!is_null($files)) {
                            $filesAux = $files[$i];
                            $path = public_path('images/familias/productos/');
                            if (!file_exists($path))
                                mkdir($path, 0777, true);
                            $imageName = time().'_producto_' . ($i + 1) . '.'.$filesAux->getClientOriginalExtension();
                            $filesAux->move($path, $imageName);
                            $img = "images/familias/productos/{$imageName}";
                        }
                        Productosimg::create([
                            "producto_id" => $data["id"],
                            "img" => $img,
                            "orden" => $i + 1
                        ]);
                    } else {
                        for($j = 0; $j < count($imagenes); $j++) {
                            if(strcasecmp($imagenes[$j]["img"], $datosRequest["nombreImg"][$i]) == 0) {
                                
                                $imagenes[$j]->fill(["orden" => $i + 1]);
                                $imagenes[$j]->save();
                                $imagenes[$j]["sigue"] = 1;
                            }
                        }
                        
                    }
                    
                }
                for($j = 0; $j < count($imagenes); $j++) {
                    if(!isset($imagenes[$j]["sigue"])) {
                        $filename = public_path() . "/" . $imagenes[$j]["img"];
                        if (file_exists($filename))
                            unlink($filename);
                        Productosimg::destroy($imagenes[$j]["id"]);
                    }
                }
            }
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
        $data = Producto::find($id);
        $data["imagenes"] = $data->imagenes;
        $data["productos"] = $data->productos;
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
        $data["data"] = json_decode($data["data"],true);
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
        $prev_search = Proyecto::where("producto_id",$id)->get();
        if(!empty($prev_search))
            return -1;

        $data = self::edit($id);
        $data["data"] = json_decode($data["data"],true);
        /** ELIMINO características */
        for($i = 0; $i < count($data["data"]["caracteristicas"]); $i ++) {
            $filename = public_path() . "/" . $data["data"]["caracteristicas"][$i]["img"];
            if (file_exists($filename))
                unlink($filename);
        }
        /** ELIMINO imagenes */
        foreach($data["imagenes"] AS $img) {
            $filename = public_path() . "/" . $img["img"];
            if (file_exists($filename))
                unlink($filename);
        }
        Proyecto::destroy($id);
        return  0;
    }
}
