<div class="row">
    <div class="col-12">
        <button type="submit" style="margin-bottom: 25px;" class="btn btn-success btn-block text-uppercase">Editar<i class="fas fa-edit ml-2"></i></button>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-5">

        <div class="custom-file">
            <input onchange="readURL(this, '#card-logotipo');" required type="file" name="logotipo" accept="image/*" class="custom-file-input" lang="es">
            <label data-invalid="Logotipo - 183x133" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
        </div>

        <img id="card-logotipo" class="w-100 d-block mt-2" src="{{asset($datos['images']['logo'])}}?t=<?php echo time(); ?>" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
    </div>
    <div class="col-12 col-md-4">

        <div class="custom-file">
            <input onchange="readURL(this, '#card-favicon');" required type="file" name="favicon" accept="image/x-icon,image/png" class="custom-file-input" lang="es">
            <label data-invalid="Favicon" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
        </div>

        <img id="card-favicon" class="w-50 d-block mt-2 mx-auto" src="{{asset($datos['images']['favicon'])}}?t=<?php echo time(); ?>" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
    </div>
</div>

<div class="row justify-content-center mt-4">
    <div class="col-12">
        <fieldset>
            <legend class="legend-btn">
                <button id="btnEmail" type="button" onclick="addEmail(this)" class="btn btn-dark">Email<i class="fas fa-plus"></i></button>
            </legend>
            <div class="row" id="wrapper-email">
                @foreach($datos["contactos"]["email"] AS $t)
                    <div class="col-12 col-md-4 mt-2 position-relative">
                        <div class="bg-light p-2 border">
                            <input placeholder="Email" name="email[]" type="email" class="form-control" value="{{$t}}"/>
                        
                            <i onclick="$(this).closest('.row').remove()" class="fas fa-backspace position-absolute text-danger"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </fieldset>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 col-md-6">
        <fieldset>
            <legend>Domicilio BA</legend>
            <div class="row">
                <div class="col-12">
                    <input placeholder="Calle" name="calle_ba" type="text" class="form-control" value="{{$datos['domicilio']['ba']['calle']}}"/>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <input placeholder="Altura" name="altura_ba" type="text" class="form-control" value="{{$datos['domicilio']['ba']['altura']}}"/>
                </div>
                <div class="col-6">
                    <input placeholder="C.P." name="cp_ba" type="text" class="form-control" value="{{$datos['domicilio']['ba']['cp']}}"/>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <input placeholder="Localidad" name="localidad_ba" type="text" class="form-control" value="{{$datos['domicilio']['ba']['localidad']}}"/>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12 col-md-6">
        <fieldset>
            <legend class="legend-btn">
                <button id="btnTelefonoBA" type="button" onclick="addTelefono(this,'ba')" class="btn btn-dark">Teléfono BA<i class="fas fa-plus"></i></button>
            </legend>
            <div class="" id="wrapper-telefono-ba">
                @foreach($datos["contactos"]["contacto"]["ba"] AS $t)
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="bg-light p-2 border">
                            <input placeholder="Teléfono" name="telefono_ba[]" type="phone" class="form-control" value="{{$t}}"/>
                        
                            <i onclick="$(this).closest('.row').remove()" class="fas fa-backspace position-absolute text-danger"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </fieldset>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 col-md-6">
        <fieldset>
            <legend>Domicilio NQ</legend>
            <div class="row">
                <div class="col-12">
                    <input placeholder="Calle" name="calle_nq" type="text" class="form-control" value="{{$datos['domicilio']['nq']['calle']}}"/>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <input placeholder="Altura" name="altura_nq" type="text" class="form-control" value="{{$datos['domicilio']['nq']['altura']}}"/>
                </div>
                <div class="col-6">
                    <input placeholder="Localidad" name="localidad_nq" type="text" class="form-control" value="{{$datos['domicilio']['nq']['localidad']}}"/>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <input placeholder="Más info" name="mas_nq" type="text" class="form-control" value="{{$datos['domicilio']['nq']['mas']}}"/>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12 col-md-6">
        <fieldset>
            <legend class="legend-btn">
                <button id="btnTelefonoNQ" type="button" onclick="addTelefono(this,'nq')" class="btn btn-dark">Teléfono BA<i class="fas fa-plus"></i></button>
            </legend>
            <div class="" id="wrapper-telefono-nq">
                @foreach($datos["contactos"]["contacto"]["nq"] AS $t)
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="bg-light p-2 border">
                            <input placeholder="Teléfono" name="telefono_nq[]" type="phone" class="form-control" value="{{$t}}"/>
                        
                            <i onclick="$(this).closest('.row').remove()" class="fas fa-backspace position-absolute text-danger"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </fieldset>
    </div>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    
    addEmail = function(t) {
        let target = $("#wrapper-email");
        let html = "";
        html += '<div class="col-12 col-md-4 mt-2 position-relative">';
            html += '<div class="bg-light p-2 border">';
                html += '<input placeholder="Email" name="email[]" type="email" class="form-control mb-1"/>';
            
                html += `<i onclick="$(this).closest('.col-12').remove()" class="fas fa-backspace position-absolute text-danger"></i>`;
            html += '</div>';
        html += '</div>';
    
        target.append(html);
    }
    addTelefono = function(t, tipo) {
        let target = $(`#wrapper-telefono-${tipo}`);
        let html = "";
        html += '<div class="row">';
            html += '<div class="col-12 position-relative">';
                html += '<div class="bg-light p-2 border">';
                    html += `<input placeholder="Teléfono" name="telefono_${tipo}[]" type="phone" class="form-control"/>`;
                
                    html += `<i onclick="$(this).closest('.row').remove()" class="fas fa-backspace position-absolute text-danger"></i>`;
                html += '</div>';
            html += '</div>';
        html += '</div>';
    
        target.append(html);
    }
    readURL = function(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target).attr(`src`,`${e.target.result}`);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
    
    $("#wrapper-email,#wrapper-telefono-ba,#wrapper-telefono-nq").sortable({
        axis: "y",
        revert: true,
        scroll: false,
        placeholder: "sortable-placeholder",
        cursor: "move"
    }).disableSelection();
</script>
@endpush