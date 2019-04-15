<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trabajo;
use App\Trabajoimagen;
use App\Familia;
class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Trabajos";
        $trabajos = Trabajo::orderBy('orden')->get();
        $familias = Familia::orderBy('orden')->pluck('nombre', 'id');
        return view('adm.familia.trabajo',compact('title','trabajos','familias'));
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
        $aux = ["titulo" => null,"descripcion" => null,"tiempo" => null];
        $datosRequest = $request->all();
        
        $ARR_data = [];
        $ARR_data["nombre"] = $datosRequest["nombre"];
        $ARR_data["empresa"] = $datosRequest["empresa"];
        $ARR_data["ubicacion"] = $datosRequest["ubicacion"];
        $ARR_data["volumen"] = $datosRequest["volumen"];
        $ARR_data["familia_id"] = $datosRequest["familia_id"];
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
        
        if(is_null($data)) {
            $trabajo = Trabajo::create($ARR_data);
            $imagenes = $request->file('image_image');
            if(!is_null($imagenes)) {
                $path = public_path('images/trabajos/');
                if (!file_exists($path))
                    mkdir($path, 0777, true);
                for($i = 0; $i < count($files); $i++) {
                    $imageName = time().'_trabajo_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                    $files[$i]->move($path, $imageName);
                    $img = "images/trabajos/{$imageName}";
                    Trabajoimagen::create([
                        "producto_id" => $trabajo["id"],
                        "img" => $img,
                        "orden" => $datosRequest["orden_image"][$i]
                    ]);
                }
            }
        } else {
            $imagenesDATA = $data["imagenes"];
            unset($data["imagenes"]);
            
            $data->fill($ARR_data);
            $data->save();
            /* -------------------------------------------------
                IMAGENES
            -------------------------------------------------- */
            $imageURL = $datosRequest["imageURL"];
            $Arr_imagen = [];
            $imagenes = $request->file('image_image');
            $path = public_path('images/trabajos/');
            if (!file_exists($path))
                mkdir($path, 0777, true);
            for($i = 0 ; $i < count($imageURL) ; $i++) {
                if(isset($imagenes[$i])) {
                    $imageName = time().'_trabajo_' . ($i + 1) . '.'.$imagenes[$i]->getClientOriginalExtension();
                    $imagenes[$i]->move($path, $imageName);
                    
                    Trabajoimagen::create([
                        "trabajo_id" => $data["id"],
                        "image" => "images/trabajos/{$imageName}",
                        "orden" => $datosRequest["orden_image"][$i]
                    ]);
                    if(!is_numeric($imageURL[$i])) {
                        $filename = public_path() . "/{$imageURL[$i]}";
                        if (file_exists($filename))
                            unlink($filename);
                        $aux = $data->imagenes()->where('image', $imageURL[$i])->first();
                        Trabajoimagen::destroy($aux["id"]);
                    }
                    continue;
                }
                $aux = $data->imagenes()->where('image', $imageURL[$i])->first();
                $Arr_imagen[] = $aux["id"];
                $aux->fill(["orden" => $datosRequest["orden_image"][$i]]);
                $aux->save();
            }
            if(count($imagenesDATA) != count($Arr_imagen)) {
                foreach($imagenesDATA AS $i) {
                    if(in_array($i["id"],$Arr_imagen))
                        continue;
                    $filename = public_path() . "/{$i["image"]}";
                    if (file_exists($filename))
                        unlink($filename);
                    Trabajoimagen::destroy($i["id"]);
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
        $data = Trabajo::find($id);
        $data["imagenes"] = $data->imagenes;
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
        $data = self::edit($id);
        /** ELIMINO imagenes */
        foreach($data["imagenes"] AS $img) {
            $filename = public_path() . "/" . $img["image"];
            if (file_exists($filename))
                unlink($filename);
        }
        Trabajo::destroy($id);
        return  0;
    }
}
