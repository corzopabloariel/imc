@extends('elementos.main')

@section('headTitle', $title. ' | IMC')
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
                        <div class="row mb-2 justify-content-center">
                            <div class="col-12 text-center">
                                <button type="button" onclick="imageAdd()" class="btn btn-dark">Agregar imagen <small>612x396</small></button>
                            </div>
                        </div>
                        <div class="container-form-image row"></div>
                        <div class="container-form mt-2"></div>
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
                        @if(count($trabajos) != 0)
                            @foreach($trabajos AS $trabajo)
                                @php
                                $trabajo["imagenes"] = $trabajo->imagenes;
                                $img = null;

                                if(count($trabajo["imagenes"]) > 0)
                                    $img = asset('/').$trabajo['imagenes'][0]['image'];
                                $nombre = "{$trabajo["nombre"]} - {$trabajo["ubicacion"]}";
                                @endphp
                                <tr data-id="{{ $trabajo['id'] }}">
                                    <td class="text-uppercase">{!! $trabajo["orden"] !!}</td>
                                    <td><img onError="this.src='{{ asset('images/general/no-img.png') }}'" src="{{ $img }}" /></td>
                                    <td>
                                        {!! $nombre !!}
                                    </td>
                                    <td>
                                        <button type="button" onclick="editProducto({{ $trabajo['id'] }}, this)" class="btn btn-warning mr-1"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" onclick="deleteProducto({{ $trabajo['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
    let dataPYRUS = {familia_id: {TIPO:"JSON",DATA:@JSON($familias)}};
    
    window.seccion = new Pyrus("trabajo", dataPYRUS);
    window.seccionImage = new Pyrus("trabajoimagen");
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
                $(`#${target}`).attr(`src`,`${e.target.result}`);
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

    imageAdd = function() {
        if(window.countImage === undefined) window.countImage = 0;
        window.countImage ++;
        let imgAUX = "{{ asset('images/general/no-img.png') }}";
        let img = `<img id="src_image_${window.countImage}" src="" onError="this.src='${imgAUX}'" class="w-100 d-block mb-1 rounded img-thumbnail"/>`;
        
        $("#form .container-form-image").append(`<div class="col-12 col-md-4 my-2">${img}${window.seccionImage.formulario(window.countImage,1)}</div>`);
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