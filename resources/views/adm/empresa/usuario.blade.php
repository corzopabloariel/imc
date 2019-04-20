@extends('elementos.main')

@section('headTitle', $title. ' | GDS')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>
<section class="mt-3">
    <div class="container-fluid">
        <div>
            <button id="btnADD" onclick="addUsuario(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
        </div>
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this,'wrapper-form')" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/empresa/usuario/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="container-form"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mt-2" id="wrapper-tabla">
            <div class="card-body">
                <table class="table table-meta-4 mt-2 mb-0" id="tabla">
                    <thead class="thead-dark">
                        <th class="text-uppercase">Usuario</th>
                        <th class="text-uppercase">Nombre completo</th>
                        <th class="text-uppercase">Tipo</th>
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @foreach($usuarios AS $usuario)
                        <tr data-id="{{$usuario['id']}}">
                            <td>{{$usuario["username"]}}</td>
                            <td class="text-uppercase">{{$usuario["name"]}}</td>
                            <td>{!! ($usuario["is_admin"] ? "Administrador" : "Usuario") !!}</td>
                            <td>
                                @if(Auth::user()["id"] != $usuario["id"])
                                    <button type="button" onclick="editUsuario({{ $usuario['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" onclick="deleteUsuario({{ $usuario['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                @else
                                    <button type="button" onclick="editUsuario({{ $usuario['id'] }}, this, 1)" class="btn btn-dark mr-1"><i class="fas fa-pencil-alt"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if(Auth::user()["is_admin"])
        <div class="alert alert-warning mt-2" role="alert">
            <h4 class="alert-heading">Usuario Administrativo</h4>
            <p>Solo los usuarios de este nivel tienen la facultad de editar datos de otros usuarios.</p>
            <hr/>
            <p class="mb-0">Deje la contraseña vacía para mantener la misma; caso contrario, agregue para cambiar.</p>
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
window.seccion = new Pyrus("usuario");
deleteUsuario = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/empresa/usuario/delete') }}/${id}`;
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
addUsuario = function(t, id = 0, data = null, yo = 0, target = null) {
    let btn = $(t);
    if(btn.is(":disabled"))
        btn.removeAttr("disabled");
    else
        btn.attr("disabled",true);
    $("#wrapper-form").toggle(800,"swing");
    
    $("#wrapper-tabla").toggle("fast");

    if(id != 0)
        action = `{{ url('/adm/empresa/usuario/update/') }}/${id}`;
    else
        action = "{{ url('/adm/empresa/usuario/store') }}";
    if(data !== null) {
        if(parseInt(yo))
            $(`[name="is_admin"]`).parent().addClass("d-none");
        else
            $(`[name="is_admin"]`).parent().removeClass("d-none");
        $(`[name="name"]`).val(data.name);
        $(`[name="username"]`).val(data.username);
        $(`[name="is_admin"]`).val(data.is_admin).trigger("change");
        $('[name="username"]').attr("readonly",true);
    }
    elmnt = document.getElementById("form");
    elmnt.scrollIntoView();
    $("#form").attr("action",action);
};
editUsuario = function(id, t, yo = 0) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/empresa/usuario/edit') }}/${id}`;
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
                addUsuario($("#btnADD"),parseInt(id),data,yo);
            })
    };
    promiseFunction();
};
addDelete = function(t, target) {
    addUsuario($("#btnADD"));
    $(`[name="is_admin"]`).parent().removeClass("d-none");
    $(`[name="is_admin"]`).val($(`[name="is_admin"] option:first-child`).val()).trigger("change");
    $(`[name="name"],[name="username"],[name="password"]`).val("");
    $('[name="username"]').removeAttr("readonly");
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