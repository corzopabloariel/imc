@extends('elementos.main')

@section('headTitle', $title. ' | GDS')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        <div>
            <button id="btnADD" onclick="addProyecto(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
        </div>
        <div style="display: none;" id="wrapper-form" class="mt-2">
            <div class="card">
                <div class="card-body">
                    <button onclick="addDelete(this)" type="button" class="close" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/familia/producto/store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                                <input placeholder="Título" name="titulo" type="text" class="form-control" value=""/>
                                <fieldset class="bg-light">
                                    <legend>Descripción</legend>
                                    <textarea placeholder="Texto" id="texto" name="texto" class="validate ckeditor w-100"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <input placeholder="Orden" maxlength="3" name="orden" type="text" class="form-control text-uppercase text-center"/>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-block btn-success mr-1"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="producto_id">Tipo de producto</label>
                                            </div>
                                            <select class="custom-select" name="producto_id" id="producto_id">
                                                <option selected hidden value="0">Seleccione opción</option>
                                                @foreach ($productos as $id => $v)
                                                    <option value="{{$id}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset>
                                            <legend class="legend-btn"><button id="btnImagenes" type="button" onclick="addImagenes(this)" class="btn btn-dark">Imágenes <i class="fas fa-plus"></i></button></legend>
                                            <div id="wrapper-imagenes">
                                            </div>
                                            <small class="text-muted">Arrestre los elementos para ordernar. La primera imagen será la portada</small>
                                        </fieldset>
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
                        <th class="text-uppercase">Título / Texto</th>
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @if(count($proyectos) != 0)
                            @foreach($proyectos AS $proyecto)
                                @php
                                $proyecto["img"] = json_decode($proyecto["img"], true);
                                $img = null;
                                
                                if(count($proyecto["img"]) > 0)
                                    $img = $proyecto["img"][0];
                                @endphp
                                <tr data-id="{{ $proyecto['id'] }}">
                                    <td class="text-uppercase">{!! $proyecto["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($img) }}?t=<?php echo time(); ?>" /></td>
                                    <td>
                                        <p style="font-size: 27px" class="title">{{$proyecto["titulo"]}}</p>
                                        {!! $proyecto["texto"] !!}
                                    </td>
                                    <td>
                                        <button type="button" onclick="editProyecto({{ $proyecto['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteProyecto({{ $proyecto['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
    addProyecto = function(t, id = 0, data = null) {
        let btn = $(t);
        if(btn.is(":disabled"))
            btn.removeAttr("disabled");
        else
            btn.attr("disabled",true);
        $("#wrapper-form").toggle(800,"swing");

        $("#wrapper-tabla").toggle("fast");

        if(id != 0)
            action = `{{ url('/adm/proyecto/update/') }}/${id}`;
        else
            action = "{{ url('/adm/proyecto/store') }}";
        if(data !== null) {
            data.img = JSON.parse(data.img);
            
            $(`[name="titulo"]`).val(data.titulo);
            $('[name="orden"]').val(data.orden);

            CKEDITOR.instances['texto'].setData(data.texto);
            
            $("#producto_id").val(data.producto_id).trigger("change");
            
            data.img.forEach(element => {
                addImagenes($("#btnImagenes"), element);
            });
        }
        elmnt = document.getElementById("form");
        elmnt.scrollIntoView();
        $("#form").attr("action",action);
    };
    editProyecto = function(id, t) {
        $(t).attr("disabled",true);
        let promise = new Promise(function (resolve, reject) {
            let url = `{{ url('/adm/proyecto/edit') }}/${id}`;
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
                    addProyecto($("#btnADD"),parseInt(id),data);
                })
        };
        promiseFunction();
    };
    deleteProyecto = function(id, t) {
        $(t).attr("disabled",true);
        let promise = new Promise(function (resolve, reject) {
            let url = `{{ url('/adm/proyecto/delete') }}/${id}`;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", url, true );
            
            xmlHttp.send( null );
            resolve(xmlHttp.responseText);
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
    addDelete = function(t) {
        addProyecto($("#btnADD"));
        $(`[name="orden"],[name="titulo"]`).val("");
        
        $("#wrapper-imagenes").html("");
        CKEDITOR.instances['texto'].setData('');
        $("#producto_id").val($("#producto_id option:first-child()").val()).trigger("change");
    };
    addImagenes = function(t, data = null) {
        let target = $("#wrapper-imagenes");
        let html = "";
        if(window.img === undefined) window.img = 0;
        window.img ++;
        html += '<fieldset class="bg-dark border-dark">';
            html += '<div class="row">';
                html += '<div class="col-md-8 d-flex flex align-items-center">';
                    html += '<div class="custom-file">';
                        html += `<input onchange="readURL(this, '#card-img-${window.img}');" required type="file" name="img[]" accept="image/*" class="custom-file-input" lang="es">`;
                        html += '<label data-invalid="Archivo - 829x476" data-valid="Archivo" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="col-md-4 position-relative d-flex flex align-items-center">';
                    html += `<input name="nombreImg[]" type="hidden" value="${window.img}"/>`;
                    html += `<img id="card-img-${window.img}" class="w-100 d-block" src="" onError="this.src='{{ asset('images/general/no-img.png') }}'" />`;
                    html += `<i onclick="$(this).closest('fieldset.bg-dark').remove()" class="fas fa-backspace position-absolute text-danger"></i>`;
                html += '</div>';
            html += '</div>';
        html += '</fieldset>';
    
        target.append(html);
        if(data !== null) {
            imageAux = '{{ asset("/") }}' + data;
            target.find("> fieldset.bg-dark:last-child()").find(".row img").attr("src",imageAux);
            target.find("> fieldset.bg-dark:last-child()").find(".row input[type='hidden']").val(data);
        }
    }
    readURL = function(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target).attr(`src`,`${e.target.result}`);
            };
            reader.readAsDataURL(input.files[0]);
            $(`${target}`).parent().find("input[type='hidden']").val(0);
        }
    };
    $("#wrapper-imagenes").sortable({
        axis: "y",
        revert: true,
        scroll: false,
        placeholder: "sortable-placeholder",
        cursor: "move"
    }).disableSelection();
</script>
@endpush