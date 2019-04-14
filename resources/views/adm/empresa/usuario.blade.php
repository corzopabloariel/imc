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
        <div style="display: none;" id="wrapper-form-edit-3" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this,'wrapper-form-edit-3')" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/empresa/usuario/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="yo" value="0" />
                        <div class="row justify-content-md-center">
                            <div class="col-5">
                                <input placeholder="Contraseña nueva" name="password_new" type="password" class="form-control"/>
                            </div>
                            <div class="col-5">
                                <input placeholder="Repita Contraseña nueva" name="password_new2" type="password" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-block btn-success mr-1"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="display: none;" id="wrapper-form-edit-2" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this,'wrapper-form-edit-2')" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/empresa/usuario/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="yo" value="1" />
                        <div class="row justify-content-md-center">
                            <div class="col-5">
                                <input placeholder="Usuario" name="username" type="text" class="form-control"/>
                            </div>
                            <div class="col-5">
                                <input placeholder="Contraseña" name="password" type="password" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-block btn-success mr-1"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="display: none;" id="wrapper-form-edit" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this,'wrapper-form-edit')" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/empresa/usuario/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="yo" value="1" />
                        <div class="row justify-content-md-center">
                            <div class="col-5">
                                <input placeholder="Contraseña vieja" name="password_old" type="password" class="form-control"/>
                            </div>
                            <div class="col-5">
                                <input placeholder="Contraseña nueva" name="password_new" type="password" class="form-control"/>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-block btn-success mr-1"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this,'wrapper-form')" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/empresa/usuario/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <input placeholder="Nombre completo" name="name" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <input placeholder="Usuario" name="username" type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <select class="form-control" name="is_admin">
                                                <option value="1">Administrador</option>
                                                <option value="0">Usuario</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-block btn-success mr-1"><i class="fas fa-check"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <input placeholder="Contraseña" name="password" type="password" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <tr>
                            <td>{{$usuario["username"]}}</td>
                            <td>{{$usuario["name"]}}</td>
                            <td>{!! ($usuario["is_admin"] ? "Administrador" : "Usuario") !!}</td>
                            <td>
                                @if(Auth::user()["id"] != $usuario["id"])
                                    <p><a style="cursor:pointer" onclick="editUsuario({{$usuario['id']}},this, -1)">Editar contraseña</a></p>
                                    <p class="mb-0"><a style="cursor:pointer" onclick="deleteUsuario({{$usuario['id']}},this)">Eliminar usuario</a></p>
                                    @else
                                    <p><a style="cursor:pointer" onclick="editUsuario({{$usuario['id']}},this, 1)">Editar contraseña</a></p>
                                    <p class="mb-0"><a style="cursor:pointer" onclick="editUsuario({{$usuario['id']}},this, 2)">Editar usuario</a></p>
                                    @endif
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>

addUsuario = function(t, id = 0, data = null, yo = 0, target = null) {
    let btn = $(t);
    if(btn.is(":disabled"))
        btn.removeAttr("disabled");
    else
        btn.attr("disabled",true);
    if(yo == 0)
        $("#wrapper-form").toggle(800,"swing");
    else if(yo == 1)
        $("#wrapper-form-edit").toggle(800,"swing");
    else if(yo == 2)
        $("#wrapper-form-edit-2").toggle(800,"swing");
    else if(yo == -1)
        $("#wrapper-form-edit-3").toggle(800,"swing");
    $("#wrapper-tabla").toggle("fast");

    if(id != 0)
        action = `{{ url('/adm/empresa/usuario/update/') }}/${id}`;
    else
        action = "{{ url('/adm/empresa/usuario/store') }}";
    if(data !== null) {
        console.log(data)
        $(`[name="name"]`).val(data.name);
        $(`[name="username"]`).val(data.username);
        $(`[name="is_admin"]`).val(data.is_admin).trigger("change");
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
    let yo = 0;
    if(target == "wrapper-form") yo = 0;
    if(target == "wrapper-form-edit") yo = 1;
    if(target == "wrapper-form-edit-2") yo = 2;
    if(target == "wrapper-form-edit-3") yo = -1;
    
    addUsuario($("#btnADD"), 0, null, yo);
    $(`[name="name"],[name="username"],[name="password"]`).val("");
};
</script>
@endpush