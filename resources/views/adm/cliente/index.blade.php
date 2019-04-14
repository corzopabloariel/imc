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
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/familia/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row justify-content-md-center w-100">
                            <div class="col-md-6">
                                <img id="card-img" class="w-100 d-block" src="" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
                            </div>
                            <div class="col-md-6 d-flex align-items-center container-form">
                                
                            </div>
                        </div>
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
                        <th class="text-uppercase">Nombre</th>
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @if(count($clientes) != 0)
                            @foreach($clientes AS $cliente)
                                <tr data-id="{{ $cliente['id'] }}">
                                    <td class="text-uppercase">{!! $cliente["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($cliente['image']) }}?t=<?php echo time(); ?>" /></td>
                                    <td>{!! $cliente["nombre"] !!}</td>
                                    <td>
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
window.seccion = new Pyrus("cliente");
deleteCliente = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/cliente/delete') }}/${id}`;
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
        let url = `{{ url('/adm/cliente/edit') }}/${id}`;
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
        action = `{{ url('/adm/cliente/update/') }}/${id}`;
    else
        action = "{{ url('/adm/cliente/store') }}";
    if(data !== null) {
        console.log(data)
        $(`[name="orden"]`).val(data.orden);
        $(`[name="nombre"]`).val(data.nombre);
        $("#card-img").attr("src",`{{ url('/') }}/${data.image}`);
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
    $(`[name="orden"],[name="img"],[name="titulo"]`).val("");
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