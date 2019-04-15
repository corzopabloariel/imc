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
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/servicio/store') }}" method="post" enctype="multipart/form-data">
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
                        <th class="text-uppercase">Título / Descripción</th>
                        <th class="text-uppercase">acción</th>
                    </thead>
                    <tbody>
                        @if(count($servicios) != 0)
                            @foreach($servicios AS $servicio)
                                @php
                                $dataJSON = json_decode($servicio["data"], true);
                                $icon = $dataJSON["icon"];
                                unset($dataJSON["icon"]);
                                $titulo = "";
                                $descripcion = "";
                                foreach($dataJSON AS $k => $v) {
                                    if(!empty($titulo)) $titulo .= " / ";
                                    if(!empty($descripcion)) $descripcion .= " / ";
                                    
                                    $titulo .= $dataJSON[$k]["titulo"];
                                    $descripcion .= $dataJSON[$k]["descripcion"];
                                }
                                @endphp
                                <tr data-id="{{ $servicio['id'] }}">
                                    <td class="text-uppercase">{!! $servicio["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ asset($icon) }}?t=<?php echo time(); ?>" /></td>
                                    <td>
                                        <p style="font-size: 27px" class="title">{{$titulo}}</p>
                                        {!! $descripcion !!}
                                    </td>
                                    <td>
                                        <button type="button" onclick="editServicio({{ $servicio['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteServicio({{ $servicio['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
    window.seccion = new Pyrus("servicio");
    addProyecto = function(t, id = 0, data = null) {
        let btn = $(t);
        if(btn.is(":disabled"))
            btn.removeAttr("disabled");
        else
            btn.attr("disabled",true);
        $("#wrapper-form").toggle(800,"swing");

        $("#wrapper-tabla").toggle("fast");

        if(id != 0)
            action = `{{ url('/adm/servicio/update/') }}/${id}`;
        else
            action = "{{ url('/adm/servicio/store') }}";
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
    
    cambioTipo = function(t) {
        let tipo = $(t).val();
        let botones = "";
        if(!$(".container-form").find(".container-form-tipo").length)
            $(".container-form").append('<div class="container-form-tipo"></div>');
        if(tipo == "EMP") {
            let servicioEMP = new Pyrus("servicioEMP");
            
            botones += '<div class="row justify-content-center mt-3 pt-3 border-top">';
                botones += '<div class="col-md-2">';
                    botones += '<button type="button" onclick="addSeccion(this);" class="btn btn-block btn-info text-uppercase text-center">sección<i class="fas fa-plus ml-2"></i></button>';
                botones += '</div>';
            botones += '</div>';
            botones += '<div class="row justify-content-center mt-1">';
                botones += '<p class="mb-0">Cada <strong>sección</strong> puede contener un título, contenido, opciones e imágenes (con su descripción)</p>';
            botones += '</div>';
            botones += '<div class="row justify-content-center container-form-detalles" style="margin-top:0"></div>';
            $("#form .container-form .container-form-tipo").html(servicioEMP.formulario());

            $("#form .container-form .container-form-tipo").append(botones)
        } else {
            
            botones += '<div class="row justify-content-center mt-3 pt-3 border-top">';
                botones += '<div class="col-md-2">';
                    botones += '<button type="button" onclick="addGaleria(this);" class="btn btn-block btn-info text-uppercase text-center">galería<i class="fas fa-plus ml-2"></i></button>';
                botones += '</div>';
            botones += '</div>';
            botones += '<div class="row justify-content-center mt-1">';
                botones += '<p class="mb-0">Cada <strong>foto</strong> puede relacionarse con un título y descripción</p>';
            botones += '</div>';
            botones += '<div class="row justify-content-center container-form-galeria" style="margin-top:0"></div>';
            

            $("#form .container-form .container-form-tipo").append(botones)
        }
    };
    addDetalle = function(t,seccion) {
        let detalle = new Pyrus("servicioEMPdetalle");
        let html = "";
        if(window.detalle === undefined) window.detalle = 0;
        window.detalle ++;

        html += `<div class="col-md-4 col-12 my-3">${detalle.formulario(window.detalle,`detalle-${seccion}`)}</div>`;
        $(t).closest(".opciones").find(".container-form-opciones").append(html);
    };
    addSeccion = function(t) {
        if(window.seccionContenedor === undefined) window.seccionContenedor = 0;
        window.seccionContenedor ++;
        let seccion = new Pyrus("servicioEMPseccion")
        let html = "";

        html += `<div class="col-12 border-top pt-3 my-3 position-relative">`;
            html += `<i onclick="$(this).parent().remove()" class="fas fa-times-circle position-absolute" style="top: -8px; right: -12px; cursor: pointer;"></i>`;
            html += seccion.formulario(window.seccionContenedor,`servicio-${window.seccionContenedor}`);
            html += `<input type="hidden" name="numeroSeccion[]" value="${window.seccionContenedor}"/>`;
        html += `</div>`;

        html += '<div class="col-12 imagenes">';
            html += '<div class="row justify-content-center">';
                html += '<div class="col-md-2">';
                    html += `<button type="button" onclick="addImagenes(this,${window.seccionContenedor});" class="btn btn-block btn-info text-uppercase text-center">imagen<i class="fas fa-camera-retro ml-2"></i></button>`;
                html += '</div>';
            html += '</div>';
            html += '<div class="row justify-content-center container-form-imagenes border-bottom pb-2 mb-2" style="margin-top:0"></div>';
        html += '</div>';
        
        html += '<div class="col-12 opciones border-bottom border-dark pb-3">';
            html += '<div class="row justify-content-center">';
                html += '<div class="col-md-2">';
                    html += `<button type="button" onclick="addDetalle(this,${window.seccionContenedor});" class="btn btn-block btn-warning text-uppercase text-center">opción<i class="fas fa-plus ml-2"></i></button>`;
                html += '</div>';
            html += '</div>';
            html += '<div class="row justify-content-center container-form-opciones" style="margin-top:0"></div>';
        html += '</div>';
        $("#form .container-form .container-form-detalles").append(html);
    }
    addImagenes = function(t,seccion) {
        let imagen = new Pyrus("servicioEMPimagen");
        if(window.countImage === undefined) window.countImage = 0;
        window.countImage ++;
        let html = "";
        let imgAUX = "{{ asset('images/general/no-img.png') }}";
        let img = `<img id="src_image_${window.countImage}" src="" onError="this.src='${imgAUX}'" class="w-100 d-block mb-1 rounded img-thumbnail"/>`;

        html += `<div class="col-12 col-md-4 my-2 position-relative">`;
            html += `<i onclick="$(this).parent().remove()" class="fas fa-times-circle position-absolute" style="top: -5px; right: 10px; cursor: pointer;"></i>`;
            html += `<input type="hidden" name="imageURL-${seccion}[]" value="0" />`;
            html += `${img}`;
            html += `${imagen.formulario(window.countImage,`image-${seccion}`)}`;
        html += `</div>`;
        $(t).closest(".imagenes").find(".container-form-imagenes").append(html);
    }
    init = function() {
        console.log("CONSTRUYENDO FORMULARIO")
        /** */
        $("#form .container-form").html(window.seccion.formulario());
    }
    /** */
    init();
</script>
@endpush