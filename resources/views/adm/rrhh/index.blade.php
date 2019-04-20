@extends('elementos.main')

@section('headTitle', $title. ' | IMC')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        <div>
            <button id="btnADD" onclick="addCliente(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
        </div>
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this)" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/recursos/store') }}" method="post" enctype="multipart/form-data">
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
                        <th class="text-uppercase text-center">Orden</th>
                        <th class="text-uppercase">Información</th>
                        <th class="text-uppercase text-center">acción</th>
                    </thead>
                    <tbody>
                        @if(count($trabajos) != 0)
                            @foreach($trabajos AS $trabajo)
                                @php
                                $data = json_decode($trabajo["data"], true);
                                $dataTD = "";
                                $idiomas = ["esp" => "español","ing" => "inglés","ita"=>"italiano"];
                                foreach($data AS $k => $v) {
                                    $dataTD .= '<fieldset>';
                                        $dataTD .= "<legend>{$idiomas[$k]}</legend>";
                                        $dataTD .= "<p><strong>Nombre</strong> {$v["nombre"]}</p>";
                                        $dataTD .= "<p><strong>Edades</strong> {$v["rango"]}</p>";
                                        $dataTD .= "<p><strong>Orientación</strong> {$v["orientacion"]}</p>";
                                        $dataTD .= "<p><strong>Experiencia</strong> {$v["experiencia"]}</p>";
                                    $dataTD .= '</fieldset>';
                                }
                                @endphp
                                <tr data-id="{{ $trabajo['id'] }}">
                                    <td class="text-uppercase text-center">{!! $trabajo["orden"] !!} - {{ $trabajo["provincia"] }}</td>
                                    <td>{!! $dataTD !!}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="editCliente({{ $trabajo['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteCliente({{ $trabajo['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
window.seccion = new Pyrus("rrhh");
deleteCliente = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/recursos/delete') }}/${id}`;
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
editCliente = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/recursos/edit') }}/${id}`;
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
                addCliente($("#btnADD"),parseInt(id),data);
            })
    };
    promiseFunction();
};
addCliente = function(t, id = 0, data = null) {
    let btn = $(t);
    if(btn.is(":disabled"))
        btn.removeAttr("disabled");
    else
        btn.attr("disabled",true);
    $("#wrapper-form").toggle(800,"swing");

    $("#wrapper-tabla").toggle("fast");

    if(id != 0)
        action = `{{ url('/adm/recursos/update/') }}/${id}`;
    else
        action = "{{ url('/adm/recursos/store') }}";
    if(data !== null) {
        data.data = JSON.parse(data.data);
        $(`[name="orden"]`).val(data.orden);
        $(`[name="provincia"]`).val(data.provincia);
        for(let x in data.data) {
            for(let y in data.data[x])
                $(`[name="${y}_${x}"]`).val(data.data[x][y]);
        }
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
    addCliente($("#btnADD"));
    $(`input[type="text"]`).val("");
    $(`select[name="provincia"]`).val($(`select[name="provincia"] option:first-child`).val()).trigger("change");
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