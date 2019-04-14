@extends('elementos.main')

@section('headTitle', $title. ' | GDS')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        <div>
            <button id="btnADD" onclick="addFamilia(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
        </div>
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this)" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/familia/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <img id="card-img" class="w-100 d-block" src="" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <input tabindex="1" placeholder="Orden" maxlength="3" name="orden" type="text" class="form-control text-uppercase text-center"/>
                                        </div>
                                        <div class="col-6">
                                            <button tabindex="3" type="submit" class="btn btn-block btn-success mr-1"><i class="fas fa-check"></i></button>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="custom-file">
                                                <input onchange="readURL(this);" required type="file" name="img" accept="image/*" class="custom-file-input" lang="es">
                                                <label data-invalid="Seleccione archivo - 304x293" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
                                            </div>
                                            <small class="form-text text-muted">
                                            La dimensión de la imagen es la recomendada
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <input tabindex="2" placeholder="Nombre" name="titulo" type="text" class="form-control"/>
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
                <table class="table table-img-4 mt-2 mb-0" id="tabla">
                    <thead class="thead-dark">
                        <th class="text-uppercase">Orden</th>
                        <th class="text-uppercase">Imagen</th>
                        <th class="text-uppercase">Nombre</th>
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @if(count($familias) != 0)
                            @foreach($familias AS $familia)
                                <tr data-id="{{ $familia['id'] }}">
                                    <td class="text-uppercase">{!! $familia["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($familia['img']) }}?t=<?php echo time(); ?>" /></td>
                                    <td>{!! $familia["titulo"] !!}</td>
                                    <td>
                                        <button type="button" onclick="editFamilia({{ $familia['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteFamilia({{ $familia['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
let deleteFamilia = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/familia/delete') }}/${id}`;
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
                switch(parseInt(msg)) {
                    case -1:
                        mensaje = "NO SE PUEDE ELIMINAR.\nExisten PRODUCTOS ACTIVOS relacionados, para procecder suprima estos desde la sección correspondiente y vuelva a intentar";
                }
                
                if(parseInt(msg) == 0) {
                    $("#tabla").find(`tr[data-id="${id}"]`).remove();
                    if($("#tabla").find("tbody").html().trim() == "")
                        $("#tabla").find("tbody").html('<tr><td colspan="4" class="text-uppercase text-center">sin datos</td></tr>');
                } else {
                    alert(mensaje);
                    $(t).removeAttr("disabled");
                }
            })
    };
    promiseFunction();
};
editFamilia = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/familia/edit') }}/${id}`;
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
                addFamilia($("#btnADD"),parseInt(id),data);
            })
    };
    promiseFunction();
};
addFamilia = function(t, id = 0, data = null) {
    let btn = $(t);
    if(btn.is(":disabled"))
        btn.removeAttr("disabled");
    else
        btn.attr("disabled",true);
    $("#wrapper-form").toggle(800,"swing");

    $("#wrapper-tabla").toggle("fast");

    if(id != 0)
        action = `{{ url('/adm/familia/update/') }}/${id}`;
    else
        action = "{{ url('/adm/familia/store') }}";
    if(data !== null) {
        console.log(data)
        $(`[name="orden"]`).val(data.orden);
        $(`[name="titulo"]`).val(data.titulo);
        $("#card-img").attr("src",`{{ url('/') }}/${data.img}`);
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
    addFamilia($("#btnADD"));
    $(`[name="orden"],[name="img"],[name="titulo"]`).val("");
    $("#card-img").attr("src","");
};
</script>
@endpush