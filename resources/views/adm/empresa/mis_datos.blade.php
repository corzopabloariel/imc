@extends('elementos.main')

@section('headTitle', $title. ' | GDS')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>
<section class="mt-3">
    <div class="container-fluid">
        <div>
            <div class="card">
                <div class="card-body">
                    <form id="form" novalidate class="pt-2" action="{{ url('/adm/empresa/mis_datos/' . $datos['id']) }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="container-form"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="alert alert-warning mt-2" role="alert">
            <p class="mb-0">Deje la contraseña vacía para mantener la misma; caso contrario, agregue para cambiar.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
window.datos = @json($datos);
window.seccion = new Pyrus("usuario");

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
init = function() {
    console.log("CONSTRUYENDO FORMULARIO")
    /** */
    $("#form .container-form").html(window.seccion.formulario());
    $(`[name="is_admin"]`).parent().addClass("d-none");
    $('[name="username"]').attr("readonly",true);

    $(`[name="name"]`).val(datos.name);
    $(`[name="username"]`).val(datos.username);
    $(`[name="is_admin"]`).val(datos.is_admin).trigger("change");
}
/** */
init();
</script>
@endpush