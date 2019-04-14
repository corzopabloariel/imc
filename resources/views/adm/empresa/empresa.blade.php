<div class="row">
    <div class="col-12">
        <button type="submit" style="margin-bottom: 25px;" class="btn btn-success btn-block text-uppercase">Editar<i class="fas fa-edit ml-2"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-5">

        <div class="custom-file">
            <input onchange="readURL(this, '#card-logotipo');" required type="file" name="logotipo" accept="image/*" class="custom-file-input" lang="es">
            <label data-invalid="Logotipo - 256x96" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
        </div>

        <img id="card-logotipo" class="w-100 d-block mt-2" src="{{asset($datos['img']['logo'])}}?t=<?php echo time(); ?>" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
    </div>
    <div class="col-12 col-md-5">

        <div class="custom-file">
            <input onchange="readURL(this, '#card-logotipo_footer');" required type="file" name="logotipo_footer" accept="image/*" class="custom-file-input" lang="es">
            <label data-invalid="Logotipo footer - 256x96" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
        </div>

        <img id="card-logotipo_footer" class="w-100 d-block mt-2" src="{{asset($datos['img']['logo_footer'])}}?t=<?php echo time(); ?>" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
    </div>
    <div class="col-12 col-md-2">

        <div class="custom-file">
            <input onchange="readURL(this, '#card-favicon');" required type="file" name="favicon" accept="image/x-icon,image/png" class="custom-file-input" lang="es">
            <label data-invalid="Favicon" data-valid="Archivo seleccionado" class="custom-file-label mb-0" data-browse="Buscar" for="customFileLang"></label>
        </div>

        <img id="card-favicon" class="w-100 d-block mt-2" src="{{asset($datos['img']['favicon'])}}?t=<?php echo time(); ?>" onError="this.src='{{ asset('images/general/no-img.png') }}'" />
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 col-md-6">
        <fieldset>
            <legend>Domicilio</legend>
            <div class="row">
                <div class="col-12">
                    <input placeholder="Calle" name="calle" type="text" class="form-control" value="{{$datos['domicilio']['calle']}}"/>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <input placeholder="Altura" name="altura" type="text" class="form-control" value="{{$datos['domicilio']['altura']}}"/>
                </div>
                <div class="col-6">
                    <input placeholder="C.P." name="cp" type="text" class="form-control" value="{{$datos['domicilio']['cp']}}"/>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <input placeholder="Localidad" name="localidad" type="text" class="form-control" value="{{$datos['domicilio']['localidad']}}"/>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12 col-md-6">
        <fieldset>
            <legend class="legend-btn">
                <button id="btnTelefono" type="button" onclick="addTelefono(this)" class="btn btn-dark">Teléfono <i class="fas fa-plus"></i></button>
            </legend>
            <div class="" id="wrapper-telefono">
                @foreach($datos["tel"] AS $t)
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="bg-light p-2 border">
                            <input placeholder="Teléfono" name="telefono[]" type="phone" class="form-control" value="{{$t}}"/>
                        
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
            <legend>Redes sociales</legend>
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-facebook"><i class="fab fa-facebook-square"></i></span>
                        </div>
                        <input value="{{$datos['facebook']}}" type="text" class="form-control" name="facebook" placeholder="Facebook" aria-label="Facebook" aria-describedby="basic-facebook">
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-youtube"><i class="fab fa-youtube"></i></span>
                        </div>
                        <input value="{{$datos['youtube']}}" type="text" class="form-control" name="youtube" placeholder="Youtube" aria-label="Youtube" aria-describedby="basic-youtube">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-12 col-md-6">
        <fieldset>
            <legend class="legend-btn">
                <button id="btnEmail" type="button" onclick="addEmail(this)" class="btn btn-dark">Email <i class="fas fa-plus"></i></button>
            </legend>
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Posiciones de emails</h4>
                <p class="mb-0">Se colocará el primer email en el <strong>cabecera</strong> y <strong>pie</strong> de página.</p>
                <p class="mb-0">Los registros se agruparan por nombre (opcional) en la parte pública.</p>
            </div>
            <div class="" id="wrapper-email">
                @foreach($datos["email"] AS $e)
                <div class="row">
                    <div class="col-12 position-relative">
                        <div class="bg-light p-2 border">
                            <input value="{{$e['e']}}" placeholder="Email" name="email[]" type="email" class="form-control mb-1"/>
                            <input value="{{$e['n']}}" placeholder="Nombre (opcional)" name="email_nombre[]" type="text" class="form-control"/>
                        
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
        html += '<div class="row">';
            html += '<div class="col-12 position-relative">';
                html += '<div class="bg-light p-2 border">';
                    html += '<input placeholder="Email" name="email[]" type="email" class="form-control mb-1"/>';
                    html += '<input placeholder="Nombre (opcional)" name="email_nombre[]" type="text" class="form-control"/>';
                
                    html += `<i onclick="$(this).closest('.row').remove()" class="fas fa-backspace position-absolute text-danger"></i>`;
                html += '</div>';
            html += '</div>';
        html += '</div>';
    
        target.append(html);
    }
    addTelefono = function(t) {
        let target = $("#wrapper-telefono");
        let html = "";
        html += '<div class="row">';
            html += '<div class="col-12 position-relative">';
                html += '<div class="bg-light p-2 border">';
                    html += '<input placeholder="Teléfono" name="telefono[]" type="phone" class="form-control"/>';
                
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
    
    $("#wrapper-email,#wrapper-telefono").sortable({
        axis: "y",
        revert: true,
        scroll: false,
        placeholder: "sortable-placeholder",
        cursor: "move"
    }).disableSelection();
</script>
@endpush