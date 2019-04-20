<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Symfony\Component\HttpFoundation\StreamedResponse;
use Session;
use DB;
use View;
use App\User;
use App\Usuariocliente;
use App\Userpassword;

class ServidorController extends Controller
{
    
    public function serve() {
        
        $user = Userpassword::where('estado', '=', 0)->first();
        if($user != null) {
            $user_id = $user["user_id"];
            $id = $user["id"];
            
            $response = new StreamedResponse();
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->setCallback( function() use($user_id,$id) {
                $json = "{user_id:'{$user_id}'}";
                $event = "claveCliente";
                
                echo "id: {$id}" . PHP_EOL;
                echo "data: {$json}" . PHP_EOL;
                echo "event: {$event}" . PHP_EOL;
                echo PHP_EOL;
                ob_flush();
                flush();
            });
            $response->send();
            $user->fill(["estado" => 1]);
            $user->save();
        } else {
            $response = new StreamedResponse();
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->setCallback( function() {
                echo PHP_EOL;
                ob_flush();
                flush();
            });
            $response->send();
        }
    }
    
    public function password($username) {
        $u = Usuariocliente::where("username",$username)->first();
        $aux = Userpassword::where("user_id",$u['id'])->first();
        if(is_null($aux)) {
            if(is_null($u))
                return 0;
            else {
                Userpassword::create(["estado" => 0,"user_id" => $u["id"]]);
                return 1;
            }
        } else {   
            $aux->fill(["estado" => 0]);
            $aux->save();
            return 1;
        }
    }
}