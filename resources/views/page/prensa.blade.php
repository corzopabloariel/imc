<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('page.elementos.head')
        
    </head>
    <body>
        @if(session('success'))
            <div class="position-fixed w-100 text-center" style="z-index:111;">
                <div class="alert alert-success" style="display: inline-block;">
                    {!! session('success')["mssg"] !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if($errors->any())
            <div class="position-fixed w-100 text-center" style="z-index:111;">
                <div class="alert alert-danger" style="display: inline-block;">
                    {!! $errors->first('mssg') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="modal fade bd-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <form id="form" action="{{ url('/verificar') }}" method="post" onsubmit="event.preventDefault(); verificarSubmit(this);">
                        @csrf
                        <input type="hidden" name="idioma" value="{{$languages}}">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title">Acceso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" placeholder="{{trans('words.user.user')}}" name="username" id="username" class="form-control input">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="password" placeholder="{{trans('words.user.pass')}}" name="password" class="form-control input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <button type="submit" class="text-uppercase btn btn-gds">{{trans('words.user.submit')}}</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" style="font-size: 12px; color: #595959;" class="btn btn-link" onclick="pedirForm(this)">{{trans('words.user.forgot_pass')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalPassword">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <form id="form" action="{{ url('/password') }}" method="post" onsubmit="event.preventDefault(); password(this);">
                        @csrf
                        <input type="hidden" name="idioma" value="{{$languages}}">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title">{{trans('words.user.request_pass')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" placeholder="{{trans('words.user.user')}}" name="usernamePedir" class="form-control input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <button type="submit" class="text-uppercase btn btn-gds">{{trans('words.user.reset')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('page.elementos.navLateral')
        @include('page.element.nav')
        
        @include('page.element.navModal')
        
        <div style="padding: 174px 0 60px 0;" class="wrapper-prensa-">
            <div class="container">
                <h4 style="padding-bottom:25px" class="position-relative text-uppercase text-center title">
                    <small class="position-absolute volver navbar"><a style="color: #D7BE89 !important" href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-contacto">« Volver</a></small>
                    {{trans('words.menu.press')}}
                </h4>
                <div class="hide-on-small-only">
                    <div class="row">
                        <div class="col-sm-6 col-12 d-flex documento">
                            <div class="d-flex flex-column">
                                <img class="d-block mx-auto" style="height: 128px" src="{{ asset('/images/general/brochure.fw.png')}}"/>
                                <img class="d-block mx-auto mt-4" style="cursor: pointer;" onclick="verificar(this,'BRO');" src="{{ asset('/images/general/btn_brochure.fw.png')}}"/>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 d-flex documento">
                            <div class="d-flex flex-column">
                                <img class="d-block mx-auto" style="height: 128px" src="{{ asset('/images/general/imc.fw.png')}}"/>
                                <img class="d-block mx-auto mt-4" style="cursor: pointer;" onclick="verificar(this,'ANT');" src="{{ asset('/images/general/btn_imc.fw.png')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="show-on-small">
                    <div class="row">
                        <div class="col s12 d-flex flex-column align-items-center">
                            <div class="text-center">
                                <img style="margin: auto; display:block;" src="{{ asset('/images/general/brochure.fw.png')}}"/>
                            </div>
                            <div class="text-center">
                                <img style="margin: auto; display:block; cursor: pointer;" onclick="verificar(this,'brochure');" src="{{ asset('/images/general/btn_brochure.fw.png')}}"/>
                            </div>
                        </div>
                        <div class="col s12 d-flex flex-column align-items-center" style="padding-top: 1em;">
                            <div class="text-center">
                                <img style="margin: auto; display:block;" src="{{ asset('/images/general/imc.fw.png')}}"/>
                            </div>
                            <div class="text-center">
                                <img style="margin: auto; display:block; cursor: pointer;" onclick="verificar(this,'imc');" src="{{ asset('/images/general/btn_imc.fw.png')}}"/>
                            </div>
                        </div>
                    </div>
                </div>--}}
                <div class="d-flex justify-content-center" id="formulario"></div>
            </div>
        </div>
        @include('page.elementos.footer')
        
        @include('adm.elementos.javascript')

        <script>
            window.idioma = "{{$idioma}}";
            $(".navbar a").click(function() {
                localStorage.setItem('scroll', $(this).data("scroll"));
            });
            pedirForm = function(t) {
                let usuario = $("#username").val();
                $("#modal").modal("hide");
                $("#modalPassword").find("input[type='text']").val(usuario);
                $("#modalPassword").modal("show");
            }
            verificar = function(t,tipo) {
                window.tipoArchivo = tipo;
                if(window.sesion === undefined) 
                    $("#modal").modal("show");
                else {
                    url = "{{ asset('/')}}" + window.sesion.archivos[window.tipoArchivo];
                    window.open(url,"blank");
                }
            };
            verificarSubmit = function(t) {
                if($("[name='username']").val() == "" || $("[name='password']").val() == "") {
                    if(window.idioma == "es")
                        alert("Faltan datos");
                    else
                        alert("Required form");
                    return false;
                } else {
                    let promise = new Promise(function (resolve, reject) {

                        let request = new XMLHttpRequest();
                        request.open('POST', t.action, false);
                    
                        let formData = new FormData(document.getElementById('form'));
                        request.send(formData);
                    
                        resolve(request.response);
                    });
            
                    promiseFunction = () => {
                        promise
                            .then(function(msg) {
                                if(typeof msg == "string")
                                    msg = JSON.parse(msg)
                                if(msg.estado !== undefined) {
                                    if(parseInt(msg.estado) <= 0)
                                        alert(msg.msg);
                                } else {
                                    window.sesion = msg;
                                    $("#modal").find("input").val("");
                                    $("#modal").modal("hide");
                                    
                                    url = "{{ asset('/')}}" + window.sesion.archivos[window.tipoArchivo];
                                    window.open(url,"blank");
                                }
                            })
                    };
                    promiseFunction();
                }
            };
            password = function(t) {
                username = $('[name="usernamePedir"]').val();
                if(username == "") {
                    alert("{{trans('words.alert.user')}}")
                    return false;
                } else {
                    $(t).remove();
                    let url = `{{ url('/password') }}/${username}`;
                    $.ajax({
                        type: 'GET',
                        url: url,
                        async: true
                    }).done(function(msg) {
                        console.log(msg)
                        $("#modalPassword").modal("hide");
                        if(parseInt(msg))
                            alert("{{trans('words.alert.request')}}");
                        else
                            alert("{{trans('words.alert.not')}}")
                    });
                }
            }
            $(document).ready(function() {
                $(document).on("submit","form",function(e) {
                	e.preventDefault();
                });
            })
        </script>
    </body>
</html>