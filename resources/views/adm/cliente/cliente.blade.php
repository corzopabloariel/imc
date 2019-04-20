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
                    <form id="form" class="pt-2" action="{{ url('/adm/clienteG/store') }}" method="post" enctype="multipart/form-data">
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
                        <th class="text-uppercase">Usuario</th>
                        <th class="text-uppercase">Nombre</th>
                        <th class="text-uppercase">Estado</th>
                        <th class="text-uppercase text-center">Fecha</th>
                        <th class="text-uppercase text-center">acción</th>
                    </thead>
                    <tbody>
                        @if(count($clientes) != 0)
                            @foreach($clientes AS $cliente)
                                <tr data-id="{{ $cliente['id'] }}">
                                    <td class="">{!! $cliente["username"] !!}</td>
                                    <td class="text-uppercase">{!! $cliente["name"] !!}</td>
                                    <td>@if(!$cliente["estado"]) Activo @else Bloqueado @endif</td>
                                    <td class="text-uppercase text-center">{!! $cliente["fecha"] !!}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="editCliente({{ $cliente['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteCliente({{ $cliente['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
window.seccion = new Pyrus("clienteG");
deleteCliente = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/clienteG/delete') }}/${id}`;
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
        let url = `{{ url('/adm/clienteG/edit') }}/${id}`;
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
        action = `{{ url('/adm/cliente/updateG/') }}/${id}`;
    else
        action = "{{ url('/adm/cliente/storeG') }}";
    if(data !== null) {
        console.log(data)
        $(`[name="username"]`).val(data.username);
        $(`[name="name"]`).val(data.name);
    }
    elmnt = document.getElementById("form");
    elmnt.scrollIntoView();
    $("#form").attr("action",action);
};
addDelete = function(t) {
    addCliente($("#btnADD"));
    $(`[name="name"],[name="username"],[name="fecha"],[name="password"]`).val("");
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