<?php

namespace App\Http\Controllers\page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

use App\Newsletter;

use App\User;
use App\Usuariocliente;

use App\Mail\Sendbymail;
use App\Mail\Sendrecuperar;
use App\Mail\SendCotizador;
use Illuminate\Support\Facades\Mail;
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

    public function prensa($idioma) {
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
        $prensa = json_decode(Contenido::where('seccion','prensa')->first()["data"], true)[$languages];
        
        $archivosPrensa = Archivo::where('seccion','prensa')->orderBy('orden')->get();
        foreach($archivosPrensa AS $p) {
            $p["nombre"] = json_decode($p["nombre"], true)[$languages];
            $p["documento"] = json_decode($p["documento"], true)[$languages];
        }
        return view('page.prensa',compact('empresa','languages','idioma','prensa','archivosPrensa'));
    }

    public function newsletters(Request $request, $idioma) {
        $datosRequest = $request->all();
        $err = ["esp" => "Email no puede estar vacío", "ing" => "Email can not be empty","ita" => "l'email non può essere vuota"];
        $err_no = ["esp" => "Se encuentra suscrito", "ing" => "You are subscribed","ita" => "Sei iscritto"];
        $success = ["esp" => "Se suscribió correctamente", "ing" => "Subscribed correctly", "ita" => "Iscritto correttamente"];
        if(empty($datosRequest["email"]))
            return back()->withErrors(['mssg' => $err[$idioma],'ubicacion' => 'scroll-contacto']);
        $aux = Newsletter::where("email",$datosRequest["email"])->first();
        if(!empty($aux))
            return back()->withErrors(['mssg' => $err_no[$idioma],'ubicacion' => 'scroll-contacto']);
        
        Newsletter::create(["email" => $datosRequest["email"], "idioma" => $idioma]);
        return back()->withSuccess(['mssg' => $success[$idioma]]);
    }
    public function verificar(Request $request) {
        $datosRequest = $request->all();
        $languages = $datosRequest["idioma"];
        
        $user = Usuariocliente::where('username',$datosRequest['username'])->first();

        $usuario = ["esp" => "Usuario no encontrado","ing" => "User not found", "ita" => "Utente non trovato"];
        $acceso = ["esp" => "Usuario bloqueado", "ing" => "Access denied", "ita" => "Accesso negato"];
        $password = ["esp" => "Contraseña incorrecta", "ing" => "Incorrect password", "ita" => "password errata"];
        
        if(empty($user))
            return ["msg" => $usuario[$languages], "estado" => 0];
        if($user["estado"] == 1)
            return ["msg" => $acceso[$languages], "estado" => -1];
        
        $create_time = strtotime($user["created_at"]);
        $fecha_time = strtotime($user["fecha"]);
        $hoy_time = strtotime("now");
        
        if($hoy_time > $fecha_time) {
            $user->fill(["estado" => 1]);
            $user->save();
            return ["msg" => $acceso[$languages], "estado" => -1];
        }
            
        if(Hash::check($datosRequest["password"], $user["password"])) {
            $archivosPrensa = Archivo::where('seccion','prensa')->orderBy('orden')->get();
            $Arr_link = [];
            foreach($archivosPrensa AS $p)
                $Arr_link[$p["tipo"]] = json_decode($p["documento"], true)[$languages];
            
            return ["archivos" => $Arr_link];
        } else
            return ["msg" => $password[$languages], "estado" => 0];
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

    /**
     * @param id - trabajo
     */
    public function envio(Request $request, $id, $idioma) {
        $datosRequest = $request->all();
        unset($datosRequest["_token"]);
        unset($datosRequest["_method"]);
        $ok = [
            "esp" => "El mensaje se ha enviado exitosamente.",
            "ing" => "El mensaje se ha enviado exitosamente.",
            "ita" => "El mensaje se ha enviado exitosamente."
        ];
        $err = [
            "email" => [
                "esp" => "Archivo necesario",
                "ing" => "Archivo necesario",
                "ita" => "Archivo necesario"
            ],
            "campos" => [
                "esp" => "Los campos <strong>nombre</strong>, <strong>apellido</strong> y <strong>email</strong> son obligatorios",
                "ing" => "Los campos <strong>nombre</strong>, <strong>apellido</strong> y <strong>email</strong> son obligatorios",
                "ita" => "Los campos <strong>nombre</strong>, <strong>apellido</strong> y <strong>email</strong> son obligatorios"
            ],
            "gral" => [
                "esp" => "Ha ocurrido un error.",
                "ing" => "Ha ocurrido un error.",
                "ita" => "Ha ocurrido un error."
            ]
        ];
        $trabajo = RRHH::find($id);
        $trabajo["data"] = json_decode($trabajo["data"],true)["esp"];
        //
        $archivo = null;
        if ($request->hasFile('archivo')) {
            if ($request->file('archivo')->isValid()) {
                $file = $request->file('archivo');

                $path = public_path('images/archivos/');
                $request->file('archivo')->move($path, time().'_'.$file->getClientOriginalName());
                $archivo = 'images/archivos/' . time().'_'.$file->getClientOriginalName();
            }
        }
        if(is_null($archivo))
            return back()->withErrors(['mssg' => $err["email"][$idioma]]);
        if(empty($datosRequest["nombre"]) || empty($datosRequest["apellido"]) || empty($datosRequest["email"]))
            return back()
                ->withErrors(['mssg' => $err["campos"][$idioma]]);
                
        Mail::send('emails.welcome', ["data" => $datosRequest,"trabajo" => $trabajo["data"],"provincia" => $trabajo["provincia"]], function ($message) use ($archivo) {
            $message->from("send@imcarg.com", "RR.HH.");
            $message->to("corzo.pabloariel@gmail.com");
            $message->attach($archivo);

            $message->subject("RR.HH.");
        });
        if (Mail::failures())
            return back()->withErrors(['mssg' => $err["gral"][$idioma], 'ubicacion' => 'scroll-rrhh']);
        
        return back()->withSuccess(['mssg' => $ok[$idioma]]);
    }
}
//6LfyY50UAAAAAJGHw1v6ixJgvBbUOasaTT6Wz-od
//6LfyY50UAAAAALNyCZnnP3Rt_pTi69EgSABJ0ehz