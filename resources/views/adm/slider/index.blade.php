@extends('elementos.main')

@section('headTitle', $title. ' | IMC')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        <div>
            <button id="btnADD" onclick="addSlider(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
        </div>
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <img id="card-img" class="card-img-top" src="" onError="this.src='{{ asset('images/general/no-img.png') }}'" />

                <div class="card-body">
                    <button onclick="addDelete(this)" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/slider/' . strtolower($seccion) . '/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="container-form"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mt-2" id="wrapper-tabla">
            <div class="card-body">
                <table class="table table-img-4 mt-2 mb-0" id="tabla">
                    <thead class="thead-dark">
                        <th class="text-uppercase">Orden</th>
                        <th class="text-uppercase">Imagen</th>
                        @if($seccion != "ecobruma")
                        <th class="text-uppercase">Texto</th>
                        @endif
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @if(count($sliders) != 0)
                            @foreach($sliders AS $slider)
                                @php
                                $texto = "";
                                $textoJSON = json_decode($slider["texto"], true);
                                foreach($textoJSON AS $k => $v) {
                                    $texto .= "<fieldset>";
                                        $texto .= "<legend>${k}</legend>";
                                        $texto .= $v;
                                    $texto .= "</fieldset>";
                                }
                                @endphp
                                <tr data-id="{{ $slider['id'] }}">
                                    <td class="text-uppercase">{!! $slider["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($slider['image']) }}?t=<?php echo time(); ?>" /></td>
                                    <td>{!! $texto !!}</td>
                                    <td>
                                        <button type="button" onclick="editSlider({{ $slider['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteSlider({{ $slider['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                @if($seccion != "ecobruma")
                                    <td colspan="4" class="text-uppercase text-center">
                                        sin datos
                                    </td>
                                @else
                                    <td colspan="3" class="text-uppercase text-center">
                                        sin datos
                                    </td>
                                @endif
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script>
$(document).on("ready",function() {
    
    $(".ckeditor").each(function () {
        CKEDITOR.replace( $(this).attr("name") );
    });
});
window.seccion = new Pyrus("slider");
readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $("#card-img").attr(`src`,`${e.target.result}`);
        };
        reader.readAsDataURL(input.files[0]);
    }
    
};

let deleteSlider = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/slider/delete') }}/${id}`;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, true );
        
        xmlHttp.send( null );
        resolve(xmlHttp.responseText);
    });

    promiseFunction = () => {
        promise
            .then(function(msg) {
                console.log(msg)
                $("#tabla").find(`tr[data-id="${id}"]`).remove();
                if($("#tabla").find("tbody").html().trim() == "")
                    $("#tabla").find("tbody").html('<tr><td colspan="4" class="text-uppercase text-center">sin datos</td></tr>');
            })
    };
    promiseFunction();
};
editSlider = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/slider/edit') }}/${id}`;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.responseType = 'json';
        xmlHttp.open( "GET", url, true );
        xmlHttp.onload = function() {
            resolve(xmlHttp.response);
        }
        xmlHttp.send( null );
    });

    promiseFunction = () => {
        promise
            .then(function(data) {
                console.log(data)
                $(t).removeAttr("disabled");
                addSlider($("#btnADD"),parseInt(id),data);
            })
    };
    promiseFunction();
};
addSlider = function(t, id = 0, data = null) {
    let btn = $(t);
    if(btn.is(":disabled"))
        btn.removeAttr("disabled");
    else
        btn.attr("disabled",true);
    $("#wrapper-form").toggle(800,"swing");

    $("#wrapper-tabla").toggle("fast");

    if(id != 0)
        action = `{{ url('/adm/slider/update/') }}/${id}`;
    else
        action = "{{ url('/adm/slider/' . strtolower($seccion) . '/store') }}";
    if(data !== null) {
        data.texto = JSON.parse(data.texto);
        $(`[name="orden"]`).val(data.orden);
        CKEDITOR.instances['texto_esp'].setData(data.texto.esp);
        CKEDITOR.instances['texto_ing'].setData(data.texto.ing);
        CKEDITOR.instances['texto_ita'].setData(data.texto.ita);
        $("#card-img").attr("src",`{{ url('/') }}/${data.img}`);
    }
    elmnt = document.getElementById("form");
    elmnt.scrollIntoView();
    $("#form").attr("action",action);
};
addDelete = function(t) {
    addSlider($("#btnADD"));
    $(`[name="orden"],[name="img"]`).val("");
    CKEDITOR.instances['texto'].setData('');
    $("#card-img").attr("src","");
};
init = function() {
    console.log("CONSTRUYENDO FORMULARIO")
    /** */
    $("#form .container-form").html(window.seccion.formulario());
}
/** */
init();
</script>
@endpush