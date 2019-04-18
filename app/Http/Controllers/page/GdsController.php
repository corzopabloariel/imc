<?php

namespace App\Http\Controllers\page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use App\Slider;
use App\Contenido;
use App\Archivo;
use App\Servicio;
use App\RRHH;
use App\Empresa;

use App\Familia;
use App\Trabajo;
use App\Cliente;

use App\User;
//use App\Usuariocliente;

//use App\Newsletter;

class GdsController extends Controller
{
    public function empresa() {
        $empresa = Empresa::first();
        $empresa["contactos"] = json_decode($empresa["contactos"], true);
        $empresa["images"] = json_decode($empresa["images"], true);
        $empresa["domicilio"] = json_decode($empresa["domicilio"], true);
        $empresa["metadatos"] = json_decode($empresa["metadatos"], true);

        return $empresa;
    }
    public function redirect() {
        return redirect('index/es/');
    }
    public function index($idioma) {
        if($idioma == "es") {
            App::setLocale('es');
            $languages = "esp";
        } else if($idioma == "it") {
            App::setLocale('it');
            $languages = "ita";
        } else {
            App::setLocale('en');
            $languages = "ing";
        }
        $empresa = self::empresa();
        $slider = Slider::where('seccion','home')->orderBy('orden')->get();
        $home = json_decode(Contenido::where('seccion','home')->first()["data"], true)[$languages];
        $nosotros = json_decode(Contenido::where('seccion','nosotros')->first()["data"], true)[$languages];
        $calidad = json_decode(Contenido::where('seccion','calidad')->first()["data"], true)[$languages];
        $prensa = json_decode(Contenido::where('seccion','prensa')->first()["data"], true)[$languages];
        $archivosCalidad = Archivo::where('seccion','calidad')->orderBy('orden')->get();
        $archivosPrensa = Archivo::where('seccion','prensa')->orderBy('orden')->get();
        $ofertas = RRHH::orderBy('provincia')->orderBy('orden')->get();
        
        $familias = Familia::orderBy('orden')->pluck('nombre', 'id');
        $clientes = Cliente::orderBy('orden')->pluck('image', 'id');
        $trabajos = Trabajo::orderBy('familia_id')->orderBy('orden')->get();
        /**
         * 
         */
        
        foreach($familias AS $k => $v)
            $familias[$k] = json_decode($v, true)[$languages];

        for($i = 0; $i < count($ofertas); $i++)
            $ofertas[$i]["data"] = json_decode($ofertas[$i]["data"], true)[$languages];

        for($i = 0; $i < count($slider); $i++)
            $slider[$i]["texto"] = json_decode($slider[$i]["texto"], true)[$languages];
        
        for($i = 0; $i < count($trabajos); $i++) {
            $trabajos[$i]["data"] = json_decode($trabajos[$i]["data"], true)[$languages];
            $trabajos[$i]["imagenes"] = $trabajos[$i]->imagenes;
        }
        
        for($i = 0; $i < count($archivosCalidad); $i++) {
            $archivosCalidad[$i]["nombre"] = json_decode($archivosCalidad[$i]["nombre"], true)[$languages];
            $archivosCalidad[$i]["documento"] = json_decode($archivosCalidad[$i]["documento"], true)[$languages];
        }
        for($i = 0; $i < count($archivosPrensa); $i++) {
            $archivosPrensa[$i]["nombre"] = json_decode($archivosPrensa[$i]["nombre"], true)[$languages];
            $archivosPrensa[$i]["documento"] = json_decode($archivosPrensa[$i]["documento"], true)[$languages];
        }
        
        $servicios = Servicio::orderBy('tipo','DESC')->orderBy('orden')->get();
        for($i = 0; $i < count($servicios); $i++) {
            $servicios[$i]["data"] = json_decode($servicios[$i]["data"], true)[$languages];
        }
        
        return view('welcome',compact('idioma','languages','empresa','slider','home','nosotros','calidad','archivosCalidad','servicios','prensa','archivosPrensa','ofertas','familias','trabajos','clientes'));
    }

    public function rrhh($idioma, $id) {
        if($idioma == "es") {
            App::setLocale('es');
            $languages = "esp";
        } else if($idioma == "it") {
            App::setLocale('it');
            $languages = "ita";
        } else {
            App::setLocale('en');
            $languages = "ing";
        }
        $empresa = self::empresa();
        $oferta = Rrhh::find($id);
        $oferta["data"] = json_decode($oferta["data"],true)[$languages];

        return view('page.rrhh',compact('empresa','idioma','languages','oferta'));
    }
    
    public function servicio($idioma, $id) {
        if($idioma == "es") {
            App::setLocale('es');
            $languages = "esp";
        } else if($idioma == "it") {
            App::setLocale('it');
            $languages = "ita";
        } else {
            App::setLocale('en');
            $languages = "ing";
        }
        $empresa = self::empresa();
        $servicio = Servicio::find($id);
        $servicio["data"] = json_decode($servicio["data"], true)[$languages];
        
        return view('page.servicio',compact('empresa','languages','idioma','servicio'));
    }

    public function datosEmpresa() {
        $empresa = Dato::first();
        $empresa["img"] = json_decode($empresa["img"], true);
        $empresa["domicilio"] = json_decode($empresa["domicilio"], true);
        $empresa["tel"] = json_decode($empresa["tel"], true);
        $empresa["email"] = json_decode($empresa["email"], true);
        $empresa["redes"] = json_decode($empresa["redes"], true);
        return $empresa;
    }

    public function form(Request $request, $seccion) {
        $datosRequest = $request->all();
        if($seccion == "ecobruma") {

        } if($seccion == "contacto") {
            
        } else {//presupuesto

        }
        dd($datosRequest);
    }
}
//6LfyY50UAAAAAJGHw1v6ixJgvBbUOasaTT6Wz-od
//6LfyY50UAAAAALNyCZnnP3Rt_pTi69EgSABJ0ehz