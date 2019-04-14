<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contenido;
class ContenidoController extends Controller
{
    public function index($seccion) {}

    public function edit($seccion) {
        $contenido = json_decode(Contenido::where("seccion",$seccion)->first()["data"], true);

        $title = "Contenido: " . strtoupper($seccion);
        return view('adm.contenido.edit',compact('title','seccion','contenido'));
    }
    public function update(Request $request, $seccion) {
        $datosRequest = $request->all();
        $contenido = Contenido::where('seccion',$seccion)->first();
        $contenido["data"] = json_decode($contenido["data"], true);
        
        switch($seccion) {
            case "home":
            case "calidad":
            case "prensa":
                $data = [];
                $data["esp"] = $datosRequest["texto_esp"];
                $data["ing"] = $datosRequest["texto_ing"];
                $data["ita"] = $datosRequest["texto_ita"];
                break;
            case "nosotros":
                $data = [];
                $data["esp"] = [];
                $data["ing"] = [];
                $data["ita"] = [];

                $data["esp"]["texto"] = $datosRequest["nosotros_esp"];
                $data["esp"]["mercado"] = $datosRequest["mercado_esp"];
                $data["ing"]["texto"] = $datosRequest["nosotros_ing"];
                $data["ing"]["mercado"] = $datosRequest["mercado_ing"];
                $data["ita"]["texto"] = $datosRequest["nosotros_ita"];
                $data["ita"]["mercado"] = $datosRequest["mercado_ita"];
                
                break;
            case "empresa":
                $data = [
                    "acerca" => [
                        "titulo" => $datosRequest["acercaTitulo"],
                        "texto" => $datosRequest["acerca"],
                        "opciones" => []
                    ],
                    "mision" => [
                        "titulo" => $datosRequest["misionTitulo"],
                        "texto" => $datosRequest["mision"],
                    ],
                    "valor" => [
                        "titulo" => $datosRequest["valorTitulo"],
                        "texto" => $datosRequest["valor"],
                    ]
                ];
                for($i = 0; $i < count($datosRequest["numero"]); $i++)
                    $data["acerca"]["opciones"][] = [
                        "numero" => $datosRequest["numero"][$i],
                        "nombre" => $datosRequest["nombre"][$i]
                    ];
                break;
            case "ecobruma":
                $data = [
                    "texto" => $datosRequest["ecobruma"],
                    "video" => $datosRequest["video"],
                    "dinamica" => [
                        "titulo" => $datosRequest["dinamicaTitulo"],
                        "texto" => $datosRequest["dinamica"],
                    ],
                    "aplicaciones" => [
                        "titulo" => $datosRequest["aplicacionesTitulo"],
                        "texto" => $datosRequest["aplicaciones"],
                    ],
                    "caracteristicas" => []
                ];
                $A_caracteristicas = [];
                if(isset($datosRequest["nombreCar"])) {
                    $files = $request->file('img_opcion');
                    for($i = 0; $i < count($datosRequest["nombreCar"]); $i++) {
                        $img = null;
                        if(is_numeric($datosRequest["nombreCar"][$i])) {
                            if(!is_null($files[$i])) {
                                $path = public_path('images/general/')."{$seccion}";
                                if (!file_exists($path))
                                    mkdir($path, 0777, true);
                                
                                $imageName = time().'_caracteristicas_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                                $files[$i]->move($path, $imageName);
                                $img = "images/general/{$seccion}/{$imageName}";
                            }
                        } else {
                            $opcion = null;
            
                            for($j = 0; $j < count($contenido["data"]["caracteristicas"]); $j++) {
                                if(strcasecmp($contenido["data"]["caracteristicas"][$j]["titulo"], $datosRequest["nombre"][$i]) == 0) {
                                    $opcion = $contenido["data"]["caracteristicas"][$j];
                                    $A_caracteristicas[] = $contenido["data"]["caracteristicas"][$j]["img"];
                                    break;
                                }
                            }
                            if(!is_null($opcion))
                                $img = $opcion["img"];
                        }
                        
                        $data["caracteristicas"][] = ["img" => $img,"titulo" => $datosRequest["nombre"][$i]];
                    }
                    for($j = 0; $j < count($contenido["data"]["caracteristicas"]); $j++) {
                        if(!in_array($contenido["data"]["caracteristicas"][$j]["img"],$A_caracteristicas))  {
                            $filename = public_path() . "/" . $contenido["data"]["caracteristicas"][$j]["img"];
                            if (file_exists($filename))
                                unlink($filename);
                        }
                    }
                } else
                    $data = $contenido["data"];
                break;
            case "videos":
                $data = [];
                for($i = 0; $i < count($datosRequest["titulo"]); $i++) {
                    if(empty($datosRequest["video"][$i])) continue;
                    $data[] = ["titulo" => $datosRequest["titulo"][$i],"video" => $datosRequest["video"][$i]];
                }
                break;
            case "clientes":
                $data = [
                    "texto" => $datosRequest["texto"],
                    "listado" => []
                ];
                $A_caracteristicas = [];
                if(isset($datosRequest["nombreCar"])) {
                    $files = $request->file('img_opcion');
                    for($i = 0; $i < count($datosRequest["nombreCar"]); $i++) {
                        $opcion = null;
                        $img = null;
                        if(is_numeric($datosRequest["nombreCar"][$i])) {
                            if(!is_null($files[$i])) {
                                $path = public_path('images/general/')."{$seccion}";
                                if (!file_exists($path))
                                    mkdir($path, 0777, true);
                                
                                $imageName = time().'_clientes_' . ($i + 1) . '.'.$files[$i]->getClientOriginalExtension();
                                $files[$i]->move($path, $imageName);
                                $img = "images/general/{$seccion}/{$imageName}";
                            }
                        } else {
                            for($j = 0; $j < count($contenido["data"]["listado"]); $j++) {
                                if(strcasecmp($contenido["data"]["listado"][$j]["nombre"], $datosRequest["nombre"][$i]) == 0) {
                                    $opcion = $contenido["data"]["listado"][$j];
                                    $A_caracteristicas[] = $contenido["data"]["listado"][$j]["img"];
                                    break;
                                }
                            }
                            if(!is_null($opcion))
                                $img = $opcion["img"];
                        }
                        
                        $data["listado"][] = ["img" => $img,"nombre" => $datosRequest["nombre"][$i]];
                    }
                    for($j = 0; $j < count($contenido["data"]["listado"]); $j++) {
                        if(!in_array($contenido["data"]["listado"][$j]["img"],$A_caracteristicas))  {
                            $filename = public_path() . "/" . $contenido["data"]["listado"][$j]["img"];
                            if (file_exists($filename))
                                unlink($filename);
                        }
                    }
                } else
                    $data = $contenido["data"];
                break;
        }
        
        $contenido->fill(["data" => json_encode($data)]);
        $contenido->save();

        return back();
    }
}
