<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{
    public function index() {
        $title = "";
        return view('adm.index.index',compact('title'));
    }
    /** */
    public function logout() {
        Auth::logout();
    	return redirect()->to('/adm');
    }
}
