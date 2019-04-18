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
        @include('page.elementos.navLateral')
        <nav class="w-100 nav" id="nav">
            <div class="nav-wrapper">
                @php $url = "prensa"; @endphp
                @include('page.elementos.idiomas')

                <div style="height: inherit" class="container-fluid position-relative d-flex justify-content-end align-items-end">
                    <a href="{{ URL::to( 'index/' . $idioma ) }}" class="brand-logo">
                        <img src="{{ asset('/')}}{{$empresaimagen['data']->logo }}"/>
                    </a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="hide-on-med-and-down text-uppercase navbar">
                        <span></span>
                        <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="nav">{{trans('words.menu.home')}}</a></li>
                        <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-nosotros">{{trans('words.menu.us')}}</a></li>
                        <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-servicio">{{trans('words.menu.services')}}</a></li>
                        <li><a class="activeImportat" data-scroll="scroll-prensa">{{trans('words.menu.press')}}</a></li>
                        <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-portfolio">{{trans('words.menu.portfolio')}}</a></li>
                        <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-rrhh">{{trans('words.menu.rrhh')}}</a></li>
                        <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-cliente">{{trans('words.menu.clients')}}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div style="padding: 50px 0;" class="servicio container-fluid div_contenedor">
            <h4 style="padding-bottom:25px" class="position-relative text-uppercase text-center title">
                <small style="left: 0; font-size: 14px; font-weight: normal" class="position-absolute navbar"><a style="color: #D7BE89 !important" href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-contacto">« Volver</a></small>
                <span class="d-inline-block">{{trans('words.menu.press')}}<hr/></span>
            </h4>
            <section>
                <div class="hide-on-small-only">
                    <div class="row">
                        <div class="col s6 d-flex flex-column align-items-end">
                            <div class="text-center">
                                <img style="margin: auto; display:block;" src="{{ asset('/images/general/brochure.fw.png')}}"/>
                            </div>
                        </div>
                        <div class="col s6 d-flex flex-column align-items-start">
                            <div class="text-center">
                                <img style="margin: auto; display:block;" src="{{ asset('/images/general/imc.fw.png')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6 d-flex flex-column align-items-end">
                            <div class="text-center">
                                <img style="margin: auto; display:block; cursor: pointer;" onclick="verificar(this,'brochure');" src="{{ asset('/images/general/btn_brochure.fw.png')}}"/>
                            </div>
                        </div>
                        <div class="col s6 d-flex flex-column align-items-start">
                            <div class="text-center">
                                <img style="margin: auto; display:block; cursor: pointer;" onclick="verificar(this,'imc');" src="{{ asset('/images/general/btn_imc.fw.png')}}"/>
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
            </section>
        </div>
        @include('page.elementos.footer')
        
        @include('adm.elementos.javascript')

        <script>
            window.idioma = "{{$idioma}}";
            $(".navbar a").click(function() {
                localStorage.setItem('scroll', $(this).data("scroll"));
            });
            pedirForm = function(t) {
                let form = $("#form");
                let usuario = form.find("input[type='text']").val();
                let target = $("#formulario");
                html = "";
                html += '<div class="row">';
                    html += '<div class="col s12">';
                        html += '<input type="text" placeholder="{{trans('words.user.user')}}" name="username" class="validate"/>';
                    html += '</div>';
                html += '</div>';
                html += '<div class="row d-flex justify-content-center">';
                    html += '<button type="submit" class="text-uppercase btn-imc">{{trans('words.user.request_pass')}}</button>';
                html += '</div>';

                htmlFORM = `<form id="form" style="width: 350px; background-color: #FBFBFB; padding: 1em; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; border: 1px solid rgba(0,0,0,0.03);" id="form" class="" action="${action}" method="post" onsubmit="event.preventDefault(); pedir(this);">`;
                    htmlFORM += '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';
                    htmlFORM += html;
                htmlFORM += '</form>';
                
                target.html(htmlFORM);
            }
            verificar = function(t,tipo) {
                let target = $("#formulario");
                let html = "";
                if(window.sesion === undefined) {
                    action = `{{ url('/verificar') }}`;
                    
                    html += '<div class="row">';
                        html += '<div class="col s12">';
                            html += '<input type="text" placeholder="{{trans('words.user.user')}}" name="username" class="validate"/>';
                        html += '</div>';
                    html += '</div>';
                    html += '<div class="row">';
                        html += '<div class="col s12">';
                            html += '<input type="password" placeholder="{{trans('words.user.pass')}}" name="password" class="validate"/>';
                        html += '</div>';
                    html += '</div>';
                    html += '<div class="row d-flex justify-content-center">';
                        html += '<button type="submit" class="text-uppercase btn-imc">{{trans('words.user.submit')}}</button>';
                    html += '</div>';
                    html += '<div class="row">';
                        html += '<div class="col s12">';
                            html += '<p style="font-size: 12px; color: #595959;" class="text-center"><button type="button" class="waves-effect waves-teal btn-flat" onclick="pedirForm(this)">{{trans('words.user.forgot_pass')}}</button></p>';
                        html += '</div>';
                    html += '</div>';
                        
                    htmlFORM = `<form id="form" style="width: 350px; background-color: #FBFBFB; padding: 1em; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; border: 1px solid rgba(0,0,0,0.03);" id="form" class="" action="${action}" method="post" onsubmit="event.preventDefault(); verificarSubmit(this,'${tipo}');">`;
                        htmlFORM += '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';
                        htmlFORM += html;
                    htmlFORM += '</form>';
                    
                    target.html(htmlFORM);
                } else {
                    $("#formulario").html("");
                    if(tipo == "imc") {
                        aux = window.sesion.find(function(e) {
                            if(e.order.toUpperCase() == "BB") return e;
                            return null;
                        });
                    } else {
                        aux = window.sesion.find(function(e) {
                            if(e.order.toUpperCase() == "AA") return e;
                            return null;
                        });
                    }
                    if(aux !== null) {
                        if(typeof aux.documento == "string") {
                            aux.documento = JSON.parse(aux.documento)
                            aux.nombre = JSON.parse(aux.nombre)
                        }
                        url = "{{ asset('/')}}" + aux.documento["{{$languages}}"];
                        
                        window.open(url,"blank")
                    }
                }
            };
            verificarSubmit = function(t,tipo) {
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
                                console.log(msg)
                                if(typeof msg == "string")
                                    msg = JSON.parse(msg)
                                if(msg.estado !== undefined) {
                                    if(parseInt(msg.estado) <= 0) {
                                        if(window.idioma == "es")
                                            alert(msg.msg_es)
                                        else
                                            alert(msg.msg_in)
                                    }
                                } else {
                                    window.sesion = msg;
                                    $("#formulario").html("");
                                    if(tipo == "imc") {
                                        aux = window.sesion.find(function(e) {
                                            if(e.order.toUpperCase() == "BB") return e;
                                            return null;
                                        });
                                    } else {
                                        aux = window.sesion.find(function(e) {
                                            if(e.order.toUpperCase() == "AA") return e;
                                            return null;
                                        });
                                    }
                                    if(aux !== null) {
                                        if(typeof aux.documento == "string") {
                                            aux.documento = JSON.parse(aux.documento)
                                            aux.nombre = JSON.parse(aux.nombre)
                                        }
                                        if(window.idioma == "es")
                                            url = "{{ asset('/')}}" + aux.documento.esp;
                                        else
                                            url = "{{ asset('/')}}" + aux.documento.ing;
                                        window.open(url,"blank")
                                    }
                                }
                            })
                    };
                    promiseFunction();
                }
            };
            pedir = function(t) {
                username = $('[name="username"]').val();
                if(username == "") {
                    alert("{{trans('words.alert.user')}}")
                    return false;
                } else {
                    $(t).remove();
                    let url = `{{ url('/adm/password') }}/${username}`;
                    $.ajax({
                        type: 'GET',
                        url: url,
                        async: true
                    }).done(function(msg) {
                        alert("{{trans('words.alert.request')}}")
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