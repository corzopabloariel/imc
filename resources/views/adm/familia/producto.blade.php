@extends('elementos.main')

@section('headTitle', $title. ' | GDS')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        <div>
            <button id="btnADD" onclick="addProducto(this)" class="btn btn-primary text-uppercase" type="button">Agregar<i class="fas fa-plus ml-2"></i></button>
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
                                    <textarea placeholder="Texto" id="descripcion" name="descripcion" class="validate ckeditor w-100"></textarea>
                                </fieldset>
                                <fieldset class="bg-light">
                                    <legend>Detalle</legend>
                                    <textarea placeholder="detalle" id="detalle" name="detalle" class="validate ckeditor w-100"></textarea>
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
                                                <label class="input-group-text" for="familia">Familia de productos</label>
                                            </div>
                                            <select class="custom-select" name="familia_id" id="familia_id">
                                                @foreach ($familias as $id => $v)
                                                    <option value="{{$id}}">{{$v}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <input required type="file" name="especificaciones" accept="application/pdf,image/jpeg" class="custom-file-input" lang="es">
                                            <label data-invalid="Seleccione especificaciones" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
                                        </div>
                                        <small class="form-text text-muted">
                                        Acepta archivos con extensión PDF y JPG
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="familia">Productos relacionados</label>
                                            </div>
                                            <select class="custom-select" name="productos[]" id="productos" multiple>
                                                @foreach ($productos as $p)
                                                    <option value="{{$p['id']}}">{{$p["titulo"]}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <small class="form-text text-muted">
                                        CTRL + click para seleccionar más elementos
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <fieldset class="position-relative bg-light">
                                            <div class="input-group position-relative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon3">youtube.com/watch?v=</span>
                                                </div>
                                                <input value="" type="text" class="form-control" name="video" aria-describedby="basic-addon3">
                                                <i onclick="link(this);" class="position-absolute link-video fab fa-youtube"></i>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="destacado" value="1" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Producto destacado?
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">
                                        Aperecerá en el HOME
                                        </small>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <fieldset>
                                            <legend class="legend-btn"><button id="btnCaracteristicas" type="button" onclick="addOpciones(this)" class="btn btn-dark">Características <i class="fas fa-plus"></i></button></legend>
                                            <div id="wrapper-opciones">
                                            </div>
                                            <small class="text-muted">Arrestre los elementos para ordernar</small>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row mt-4">
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
                        <th class="text-uppercase">Nombre</th>
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @if(count($productos) != 0)
                            @foreach($productos AS $producto)
                                @php
                                $producto["imagenes"] = $producto->imagenes;
                                $img = null;
                                $familia = App\Familia::find($producto["familia_id"]);
                                if(isset($producto["imagenes"][0])) 
                                    $img = asset($producto["imagenes"][0]["img"]) . "?t=" . time();
                                @endphp
                                <tr data-id="{{ $producto['id'] }}">
                                    <td class="text-uppercase">{!! $producto["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ $img }}" /></td>
                                    <td>
                                        @if($producto["destacado"])
                                            <i class="fas fa-star text-warning mr-2" title="Destacado"></i>
                                        @endif
                                        {!! $producto["titulo"] !!}
                                        <small class="ml-2">{{$familia["titulo"]}}</small>
                                    </td>
                                    <td>
                                        <button type="button" onclick="editProducto({{ $producto['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteProducto({{ $producto['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
    addProducto = function(t, id = 0, data = null) {
        let btn = $(t);
        if(btn.is(":disabled"))
            btn.removeAttr("disabled");
        else
            btn.attr("disabled",true);
        $("#wrapper-form").toggle(800,"swing");

        $("#wrapper-tabla").toggle("fast");

        if(id != 0)
            action = `{{ url('/adm/familia/producto/update/') }}/${id}`;
        else
            action = "{{ url('/adm/familia/producto/store') }}";
        if(data !== null) {
            data.data = JSON.parse(data.data);
            
            $(`[name="titulo"]`).val(data.titulo);
            $('[name="orden"]').val(data.orden);
            if(data.data.video !== null)
                $('[name="video"]').val(data.data.video)
            if(parseInt(data.destacado))
                $("[name='destacado']").attr("checked",true)
            // $("#wrapper-opciones,#wrapper-imagenes").html("");
            CKEDITOR.instances['descripcion'].setData(data.data.descripcion);
            CKEDITOR.instances['detalle'].setData(data.data.detalle);
            $("#familia_id").val(data.familia_id).trigger("change");
            data.data.caracteristicas.forEach(element => {
                addOpciones($("#btnCaracteristicas"),element);
            });
            data.imagenes.forEach(element => {
                addImagenes($("#btnImagenes"), element);
            });

            Arr = [];
            data.productos.forEach(function(p) {
                Arr.push(p.id);
            });
            $("#productos").val(Arr);
        }
        elmnt = document.getElementById("form");
        elmnt.scrollIntoView();
        $("#form").attr("action",action);
    };
    editProducto = function(id, t) {
        $(t).attr("disabled",true);
        let promise = new Promise(function (resolve, reject) {
            let url = `{{ url('/adm/familia/producto/edit') }}/${id}`;
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
                    $(`#productos option:disabled`).removeAttr('disabled')

                    $(`#productos option[value="${data.id}"]`).attr('disabled',true);
                    
                    addProducto($("#btnADD"),parseInt(id),data);
                })
        };
        promiseFunction();
    };
    addOpciones = function(t, data = null) {
        let target = $("#wrapper-opciones");
        let html = "";
        if(window.imgOpciones === undefined) window.imgOpciones = 0;
        window.imgOpciones ++;
        html += '<fieldset class="bg-dark border-dark">';
            html += '<div class="row">';
                html += '<div class="col-md-8 d-flex flex align-items-center">';
                    html += '<div>';
                        html += '<div class="custom-file">';
                            html += `<input onchange="readURL(this, '#card-car-${window.imgOpciones}');" required type="file" name="img_opcion[]" accept="image/*" class="custom-file-input" lang="es">`;
                            html += '<label data-invalid="Archivo - 83x83" data-valid="Archivo" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>';
                        html += '</div>';
                        html += '<input placeholder="Nombre" name="nombre[]" type="text" class="form-control mt-2"/>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="col-md-4 position-relative d-flex flex align-items-center">';
                    html += `<input name="nombreCar[]" type="hidden" value="${window.imgOpciones}"/>`;
                    html += `<img id="card-car-${window.imgOpciones}" class="w-100 d-block" src="" onError="this.src='{{ asset('images/general/no-img.png') }}'" />`;
                    html += `<i onclick="$(this).closest('fieldset.bg-dark').remove()" class="fas fa-backspace position-absolute text-danger"></i>`;
                html += '</div>';
            html += '</div>';
        html += '</fieldset>';
        target.append(html);

        if(data !== null) {
            target.find("> fieldset.bg-dark:last-child()").find(".row input[type='text']").val(data.nombre);
            imgAux = '{{ asset("/") }}' + data.img;
            target.find("> fieldset.bg-dark:last-child()").find(".row input[type='hidden']").val(data.img);
            target.find("> fieldset.bg-dark:last-child()").find(".row img").attr("src",imgAux);
        }
    }
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
                        html += '<label data-invalid="Archivo - 340x340" data-valid="Archivo" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>';
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
            imageAux = '{{ asset("/") }}' + data.img;
            target.find("> fieldset.bg-dark:last-child()").find(".row img").attr("src",imageAux);
            target.find("> fieldset.bg-dark:last-child()").find(".row input[type='hidden']").val(data.img);
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
    addDelete = function(t) {
        addProducto($("#btnADD"));
        $(`[name="orden"],[name="video"],[name="especificaciones"],[name="titulo"]`).val("");
        $("[name='destacado']").attr("checked",false);
        $("#wrapper-opciones,#wrapper-imagenes").html("");
        CKEDITOR.instances['descripcion'].setData('');
        CKEDITOR.instances['detalle'].setData('');
        $('#productos option:selected').removeAttr('selected');
        $("#productos").trigger('chosen:updated');
        $("#familia_id").val($("#familia_id option:first-child()").val()).trigger("change");
    };
    deleteProducto = function(id, t) {
        $(t).attr("disabled",true);
        let promise = new Promise(function (resolve, reject) {
            let url = `{{ url('/adm/familia/producto/delete') }}/${id}`;
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
                            mensaje = "NO SE PUEDE ELIMINAR.\nExisten PROYECTOS ACTIVOS relacionados, para procecder suprima estos desde la sección correspondiente y vuelva a intentar";
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
    $("#wrapper-opciones,#wrapper-imagenes").sortable({
        axis: "y",
        revert: true,
        scroll: false,
        placeholder: "sortable-placeholder",
        cursor: "move"
    }).disableSelection();
</script>
@endpush