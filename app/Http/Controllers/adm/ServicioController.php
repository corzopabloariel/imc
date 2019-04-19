<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;
class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $title = "Servicios";
        $servicios = Servicio::orderBy('orden')->get();
        return view('adm.servicio.index',compact('title','servicios'));
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
        //dd($datosRequest);
        $tipo = $datosRequest["tipo"];
        $idiomas = ["esp","ing","ita"];
        $ARR_data = [];
        $ARR_data["icon"] = is_numeric($datosRequest["iconText"]) ? null : $datosRequest["iconText"];
        $ARR_data["tipo"] = $tipo;
        $ARR_data["orden"] = $datosRequest["orden"];
        $ARR_data["data"] = [];
        $ARR_data["data"]["esp"] = [];
        $ARR_data["data"]["ing"] = [];
        $ARR_data["data"]["ita"] = [];
        $file = $request->file("icon");
        if(!is_null($file)) {
            if(!empty($datosRequest["iconText"])) {
                $filename = public_path() . "/" . $datosRequest["iconText"];
                if (file_exists($filename))
                    unlink($filename);
            }

            $path = public_path("images/iconos/{$tipo}/");
            if (!file_exists($path))
                mkdir($path, 0777, true);
            $imageName = time()."_{$tipo}_icon.".$file->getClientOriginalExtension();
            $file->move($path, $imageName);
            $ARR_data["icon"] = "images/iconos/{$tipo}/{$imageName}";
        }

        if($tipo == "ALQ") {
            $Arr_images = [];
            $ARR_data["data"]["esp"] = [];
            $ARR_data["data"]["ing"] = [];
            $ARR_data["data"]["ita"] = [];
            for($idioma = 0 ; $idioma < count($idiomas) ; $idioma ++) {
                $auxGaleria = [
                    "titulo" => $datosRequest["titulo_{$idiomas[$idioma]}"],
                    "descripcion" => $datosRequest["descripcion_{$idiomas[$idioma]}"],
                    "galeria" => []];
                for($galeria = 0; $galeria < count($datosRequest["galerias"]); $galeria ++) {
                    $aux = ["image" => null, "descripcion" => null];
                    
                    if(!isset($Arr_images[$galeria])) {
                        $Arr_images[$galeria] = null;
                        $file = $request->file("image_galeria-{$datosRequest["galerias"][$galeria]}")[0];
                        if(!is_null($file)) {
                            $path = public_path("images/servicios/{$tipo}");
                            if (!file_exists($path))
                                mkdir($path, 0777, true);
                            $imageName = time()."_galeria-{$datosRequest["galerias"][$galeria]}.".$file->getClientOriginalExtension();
                            $file->move($path, $imageName);
                            $Arr_images[$galeria] = "images/servicios/{$tipo}/{$imageName}";
                            if(!empty($datosRequest["imageURL-{$datosRequest["galerias"][$galeria]}"])) {
                                $filename = public_path() . "/" . $datosRequest["imageURL-{$datosRequest["galerias"][$galeria]}"];
                                if (file_exists($filename))
                                    unlink($filename);
                            }
                        } else {
                            if(!empty($datosRequest["imageURL-{$datosRequest["galerias"][$galeria]}"]))
                                $Arr_images[$galeria] = $datosRequest["imageURL-{$datosRequest["galerias"][$galeria]}"];
                        }
                    }
                    $aux["image"] = $Arr_images[$galeria];
                    $aux["descripcion"] = $datosRequest["descripcion_galeria-{$datosRequest["galerias"][$galeria]}"][$idioma];
                    $auxGaleria["galeria"][] = $aux;
                }
                $ARR_data["data"][$idiomas[$idioma]] = $auxGaleria;
            }
        } else {
            $aux = ["titulo" => null, "descripcion" => null, "seccion" => []];
            $ARR_data["data"]["esp"] = $aux;
            $ARR_data["data"]["ing"] = $aux;
            $ARR_data["data"]["ita"] = $aux;

            $Arr_images = [];
            if(isset($datosRequest["numeroSeccion"])) {
                for($idioma = 0 ; $idioma < count($idiomas) ; $idioma++) {
                    for($seccion = 0 ; $seccion < count($datosRequest["numeroSeccion"]) ; $seccion++) {
                        $aux_seccion = ["titulo" => null, "descripcion" => null, "images" => [], "detalle" => []];
                        $seccionDATA = $datosRequest["numeroSeccion"][$seccion];
                        foreach($aux_seccion AS $kkk => $vvv) {
                            if($kkk == "images") {
                                // OJO ACA -> son mucha cantidad de imágenes en distintas partes
                                // Se guarda imágenes distintas en secciones diferentes
                                // Antes de discriminar la sección, lo hace en idiomas
                                if(isset($datosRequest["numeroImagenes-{$seccionDATA}"])) {
                                    for($image = 0 ; $image < count($datosRequest["numeroImagenes-{$seccionDATA}"]) ; $image ++) {
                                        $imageDATA = $datosRequest["numeroImagenes-{$seccionDATA}"][$image];
                                        $imageURL = "imageURL-{$seccionDATA}_{$imageDATA}";
                                        $aux_images = [];
                                        $aux_images["image"] = is_numeric($datosRequest[$imageURL]) ? null : $datosRequest[$imageURL];
                                        /**
                                         * Si la variable image_image aparece, significa que la imagen debe ser cargada y es nueva
                                         * En el caso que cumpla, se utilizará el dato de imageURL-X_Y para eliminar el archivo *.image
                                         */
                                        //dd(isset($datosRequest["image_image-{$seccionDATA}-{$imageDATA}"]));
                                        if(isset($datosRequest["image_image-{$seccionDATA}-{$imageDATA}"])) {
                                            $file = $request->file("image_image-{$seccionDATA}-{$imageDATA}")[0];
                                            
                                            if(!is_null($file)) {
                                                if(!isset($Arr_images[$seccionDATA]))
                                                    $Arr_images[$seccionDATA] = [];
                                                if(!isset($Arr_images[$seccionDATA][$imageDATA])) {
                                                    $Arr_images[$seccionDATA][$imageDATA] = null;
                                                    // Si la codición pasa, se reemplaza la imagen con una nueva y se elimina 
                                                    // la actual del servidor
                                                    if(!empty($aux_images["image"])) {
                                                        $filename = public_path() . "/" . $aux_images["image"];
                                                        $aux_images["image"] = null;
                                                        if (file_exists($filename))
                                                            unlink($filename);
                                                    }

                                                    $path = public_path('images/servicios/EMP/');
                                                    if (!file_exists($path))
                                                        mkdir($path, 0777, true);
                                                    $imageName = time()."_EMP_{$seccionDATA}-{$imageDATA}.".$file->getClientOriginalExtension();
                                                    $file->move($path, $imageName);
                                                    $Arr_images[$seccionDATA][$imageDATA] = "images/servicios/EMP/{$imageName}";
                                                }
                                                $aux_images["image"] = $Arr_images[$seccionDATA][$imageDATA];
                                            }
                                        }
                                        $aux_images["descripcion"] = $datosRequest["descripcion_image-{$seccionDATA}-{$imageDATA}"][$idioma];
                                        $aux_seccion[$kkk][] = $aux_images;
                                    }
                                }
                                continue;
                            }
                            if($kkk == "detalle") {
                                // DETALLE
                                // Español  0 +3
                                // Inglés   1 +3
                                // Italiano 2 +3
                                if(isset($datosRequest["titulo_detalle-{$seccionDATA}"])) {
                                    for($detalle = $idioma ; $detalle < $datosRequest["titulo_detalle-{$seccionDATA}"] ; $detalle += 3) {
                                        if(!isset($datosRequest["titulo_detalle-{$seccionDATA}"][$detalle])) break;
                                        $aux_seccion["detalle"][] = $datosRequest["titulo_detalle-{$seccionDATA}"][$detalle];
                                    }
                                }
                                continue;
                            }
                            $aux_seccion[$kkk] = $datosRequest["{$kkk}_servicio-{$seccionDATA}"][$idioma];
                        }
                        
                            
                        $ARR_data["data"][$idiomas[$idioma]]["seccion"][] = $aux_seccion;
                    }
                }
            }
            foreach($ARR_data["data"] AS $k => $v) {
                foreach($ARR_data["data"][$k] AS $kk => $vv) {
                    if($kk == "detalle" || $kk == "seccion")
                        continue;
                    
                    $ARR_data["data"][$k][$kk] = $datosRequest["{$kk}_{$k}"];
                }
            }
        }
        $ARR_data["data"] = json_encode($ARR_data["data"]);
        
        if(is_null($data)) {//NUEVO
            Servicio::create($ARR_data);
        } else {
            
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
        $data = Servicio::find($id);
        $data["data"] = json_decode($data["data"],true);
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
        $data["data"] = json_decode($data["data"],true);
        if(!empty($data["icon"])) {
            $filename = public_path() . "/" . $data["icon"];
            if (file_exists($filename))
                unlink($filename);
        }
        if($data["tipo"] == "ALQ") {

        }
        for($i = 0; $i < count($data["img"]); $i ++) {
            $filename = public_path() . "/" . $data["img"][$i];
            if (file_exists($filename))
                unlink($filename);
        }

        Proyecto::destroy($id);
        return 1;
    }
}
