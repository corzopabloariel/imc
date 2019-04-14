<?php

namespace App\Http\Controllers\adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Familia;
use App\Producto;
class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Familias";
        $familias = Familia::orderBy('orden')->get();
        return view('adm.familia.index',compact('title','familias'));
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
        $model = new Familia();
        $ARR_data = [];
        foreach($model->getFillable() AS $f) {
            if($f == "img") {
                $file = $request->file($f);
                if(is_null($file))
                    continue;
                $path = public_path('images/familias/');
                if (!file_exists($path))
                    mkdir($path, 0777, true);
                
                $imageName = time().'.'.$file->getClientOriginalExtension();
                $file->move($path, $imageName);
                $ARR_data[$f] = "images/familias/{$imageName}";
                continue;
            }
            if(isset($datosRequest[$f]))
                $ARR_data[$f] = $datosRequest[$f];
        }
        if(is_null($data))
            Familia::create($ARR_data);
        else {
            
            if(isset($data["img"])) {
                $filename = public_path() . "/" . $data["img"];
                if (file_exists($filename))
                    unlink($filename);
            }
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
        return Familia::find($id);
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
        $prev_search = Producto::where("familia_id",$id)->get();
        if(!empty($prev_search))
            return -1;

        $data = self::edit($id);
        $filename = public_path() . "/" . $data["img"];
        if (file_exists($filename))
            unlink($filename);

        Familia::destroy($id);
        return 0;
    }
}
