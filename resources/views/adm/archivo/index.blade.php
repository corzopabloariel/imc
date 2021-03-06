@extends('elementos.main')

@section('headTitle', $title. ' | IMC')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        @if(count($archivos) != 2)
        <div>
            <button id="btnADD" onclick="addArchivo(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
        </div>
        @endif
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this)" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/archivo/store/'. $seccion) }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="container-form"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mt-2" id="wrapper-tabla">
            <div class="card-body">
                <table class="table mt-2 mb-0" id="tabla">
                    <thead class="thead-dark">
                        <th class="text-uppercase text-center" style="width: 100px;">Orden</th>
                        <th class="text-uppercase">Documento</th>
                        <th class="text-uppercase text-center" style="width: 150px;">acción</th>
                    </thead>
                    <tbody>
                        @if(count($archivos) != 0)
                            @foreach($archivos AS $archivo)
                                @php
                                $documentosTD = "";
                                $documentos = json_decode($archivo["documento"], true);
                                $nombres = json_decode($archivo["nombre"], true);
                                
                                foreach($documentos AS $i => $d) {
                                    $href = asset('/').$documentos[$i];
                                    $nombre = $nombres[$i];
                                    $documentosTD .= "<p class='mb-0'><a target='blank' href='{$href}'>{$nombre}<i class='fas fa-external-link-alt ml-2'></i></a></p>";
                                }
                                @endphp
                                <tr data-id="{{ $archivo['id'] }}">
                                    <td class="text-uppercase text-center">{!! $archivo["orden"] !!}</td>
                                    <td>{!! $documentosTD !!}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="editArchivo({{ $archivo['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteArchivo({{ $archivo['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-uppercase text-center">
                                    sin datos
                                </td>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).on("ready",function() {
    $(".ckeditor").each(function () {
        CKEDITOR.replace( $(this).attr("name") );
    });
});
window.seccion = new Pyrus("archivo");
deleteArchivo = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/archivo/delete') }}/${id}`;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, true );
        
        xmlHttp.onload = function() {
            resolve(xmlHttp.responseText);
        }
        xmlHttp.send( null );
    });

    promiseFunction = () => {
        promise
            .then(function(msg) {
                $("#tabla").find(`tr[data-id="${id}"]`).remove();
                if($("#tabla").find("tbody").html().trim() == "")
                    $("#tabla").find("tbody").html('<tr><td colspan="4" class="text-uppercase text-center">sin datos</td></tr>');
                
            })
    };
    promiseFunction();
};
editArchivo = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/archivo/edit') }}/${id}`;
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
                $(t).removeAttr("disabled");
                addArchivo($("#btnADD"),parseInt(id),data);
            })
    };
    promiseFunction();
};
addArchivo = function(t, id = 0, data = null) {
    let btn = $(t);
    if(btn.is(":disabled"))
        btn.removeAttr("disabled");
    else
        btn.attr("disabled",true);
    $("#wrapper-form").toggle(800,"swing");

    $("#wrapper-tabla").toggle("fast");

    if(id != 0)
        action = `{{ url('/adm/archivo/update/') }}/${id}`;
    else
        action = "{{ url('/adm/archivo/store/'. $seccion) }}";
    if(data !== null) {
        data.nombre = JSON.parse(data.nombre);
        data.documento = JSON.parse(data.documento);
        console.log(data)
        $(`[name="orden"]`).val(data.orden);
        $(`[name="nombre_esp"]`).val(data.nombre.esp);
        $(`[name="nombre_ing"]`).val(data.nombre.ing);
        $(`[name="nombre_ita"]`).val(data.nombre.ita);
    }
    elmnt = document.getElementById("form");
    elmnt.scrollIntoView();
    $("#form").attr("action",action);
};
readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#card-img").attr(`src`,`${e.target.result}`);
        };
        reader.readAsDataURL(input.files[0]);
    }
};
addDelete = function(t) {
    addArchivo($("#btnADD"));
    $(`input`).val("");
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