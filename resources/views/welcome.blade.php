<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('page.elementos.head')
        
    </head>
    <body>
        @if(session('success'))
            <div class="position-fixed w-100 text-center" style="z-index:9999;">
                <div class="alert alert-success" style="display: inline-block;">
                    {!! session('success')["mssg"] !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if($errors->any())
            <div class="position-fixed w-100 text-center" style="z-index:9999;">
                <div class="alert alert-danger" style="display: inline-block;">
                    {!! $errors->first('mssg') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="modal fade bd-example-modal-xl" id="modal">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        <div id="menu-lateral">
            <ul class="p-0">
                <li data-title="{{trans('words.menu.home')}}"><a href="#" data-scroll="carousel"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.us')}}"><a href="#" data-scroll="scroll-nosotros"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.services')}}"><a href="#" data-scroll="scroll-servicio"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.press')}}"><a href="#" data-scroll="scroll-prensa"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.portfolio')}}"><a href="#" data-scroll="scroll-portfolio"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.rrhh')}}"><a href="#" data-scroll="scroll-rrhh"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.clients')}}"><a href="#" data-scroll="scroll-cliente"></a></li>
                <li class="linea"></li>
                <li data-title="{{trans('words.menu.contact')}}"><a href="#" data-scroll="scroll-contacto"></a></li>
            </ul>
        </div>
        @include('page.element.navModal')
        <section>
            @include('page.element.home')
            @include('page.elementos.navLateral')
            
            @include('page.element.nav')
            <div class="wrapper-slogan">
                <div>{!! $home !!}</div>
            </div>
            {{-- NOSOTROS --}}
            @include('page.element.nosotros')
            {{-- CALIDAD --}}
            @include('page.element.calidad')
            {{-- SERVICIO --}}
            @include('page.element.servicio')
            {{-- PRENSA --}}
            <div class="wrapper-prensa" id="scroll-prensa">
                <div class="container position-relative h-100">
                    <div class="row position-relative h-100 justify-content-end">
                        <div class="col-12 col-md-12 col-lg-6 position-relative h-100 pl-5 d-flex align-items-center">
                            <div class="row pl-5">
                                <div class="col-12 title pl-5">{!! $prensa !!}</div>
                                <div class="col-12 col-md-6 mt-1">
                                    <a class="text-center btn btn-block btn-gds" href="{{ URL::to($idioma . '/prensa') }}">{{ $archivosPrensa[0]["nombre"] }}</a>
                                </div>
                                <div class="col-12 col-md-6 mt-1">
                                    <a class="text-center btn btn-block btn-reverse" href="{{ URL::to($idioma . '/prensa') }}">{{ $archivosPrensa[1]["nombre"] }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- PORTFOLIO --}}
            @include('page.element.portfolio')
            {{-- OFERTAS --}}
            @include('page.element.oferta')
            {{-- CLIENTES --}}
            @include('page.element.clientes')
            {{-- CONTACTOS --}}
            @include('page.element.contacto')
        </section>
        @include('page.elementos.footer')
        @include('adm.elementos.javascript')
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
        
            window.ofertas = {!! json_encode($ofertas) !!};
            window.familias = {!! json_encode($familias) !!};
            window.empresa = {!! json_encode($empresa) !!};
            window.Arr_trabajos = {!! json_encode($trabajos) !!};
            window.Arr_servicios = {!! json_encode($servicios) !!};
            
            var onloadCallback = function() {
                grecaptcha.render('html_element', {
                  'sitekey' : '6Lf8ypkUAAAAAKVtcM-8uln12mdOgGlaD16UcLXK'
                });
            };
            $(document).ready(function() {
                $(window).scroll(function() {     
                    let scroll = $(window).scrollTop();
                    if (scroll > 0)
                        $("#nav").addClass("activeScroll");
                    else
                        $("#nav").removeClass("activeScroll");
                });
                $(window).on('orientationchange', function () {
                    $('.js-slider').not('.slick-initialized').slick('resize');

                    if(window.outerWidth <= 425)
                        $("#clientes .slick-arrow").addClass("d-none");
                });
                $(".tipo.row").find("> .col:first-child()").addClass("active");

                idFamiliaFirst = $("#familias").find("a:first-child()").data("id");
                $("#familias").find("a:first-child()").addClass("activeImportat");
                $("[data-trabajo][data-familia_id]").addClass("d-none");
                $(`[data-trabajo][data-familia_id="${idFamiliaFirst}"]`).removeClass("d-none");
                
                $(".sidenav.navbar a").on("click", function() {
                    $('.sidenav').sidenav('close');
                });
                
                @if($errors->any())
                    e = "{!! $errors->first('ubicacion') !!}";
                    if(e !== null) {
                        elmnt = document.getElementById(e);
                        elmnt.scrollIntoView();
                    }
                @endif
                
                if(localStorage.scroll !== undefined) {
                    elmnt = document.getElementById(localStorage.scroll);
                    elmnt.scrollIntoView();
                    
                    if(localStorage.scroll == "scroll-servicio") {
                        $(`[data-tipoServicio="${localStorage.tipoServicio}"]`).click();
                        localStorage.removeItem("tipoServicio");
                    }
                    localStorage.removeItem("scroll");
                }
                
                let slickClientes = $("#clientes").slick({
                    dots: false,
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 425,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                dots: true
                            }
                        }
                    ]
                });
                let slickOfertas = $("#ofertas").responsiveSlides({
                    maxwidth: 800,
                    nav: true,
                    auto: false,
                    manualControls: "#sliderOfertas"
                    // speed: 800
                });

                if(window.outerWidth <= 425)
                    $("#clientes .slick-arrow").addClass("d-none");
            });
            
            portfolioFamilia = function(t) {
                $(t).parent().find(".activeImportat").removeClass("activeImportat");
                $(t).addClass("activeImportat")

                idFamiliaFirst = $(t).data("id");
                $("[data-trabajo][data-familia_id]").addClass("d-none");
                $(`[data-trabajo][data-familia_id="${idFamiliaFirst}"]`).removeClass("d-none")
            }
            
            $('a[data-scroll]').on("click", function (e) {
                e.preventDefault();
                if($("#menuNav").is(":visible"))
                    $("#menuNav").modal("hide");
                target = $(this).data("scroll");
                position = $(`#${target}`).position();
                scroll = position.top - 124;
                if(scroll < 0) scroll = 0;
                $('html, body').animate({
                    scrollTop: `${scroll}px`
                }, 'fast');
            });
            nav = new Waypoint.Inview({
                element: document.getElementById('carouselExampleIndicators'),
                enter: function(direction) {
                    $("#menu-lateral").addClass("d-none");
                    $("nav").find(".activeImportat").removeClass("activeImportat");
                    $("nav").find('[data-scroll="nav"]').addClass("activeImportat");
                },
                entered: function(direction) {
                    $("#menu-lateral").addClass("d-none");
                },
            });
            nosotros = new Waypoint({
                element: document.getElementById('scroll-nosotros'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-nosotros']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-nosotros"]').addClass("activeImportat");
                },
                offset: 124
            });
            servicios = new Waypoint({
                element: document.getElementById('scroll-servicio'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-servicio']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-servicio"]').addClass("activeImportat");
                },
                offset: 124
            });
            prensa = new Waypoint({
                element: document.getElementById('scroll-prensa'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-prensa']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-prensa"]').addClass("activeImportat");
                },
                offset: 124
            });
            portfolio = new Waypoint({
                element: document.getElementById('scroll-portfolio'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-portfolio']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-portfolio"]').addClass("activeImportat");
                },
                offset: 124
            });
            rrhh = new Waypoint({
                element: document.getElementById('scroll-rrhh'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-rrhh']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-rrhh"]').addClass("activeImportat");
                },
                offset: 124
            });
            clientes = new Waypoint({
                element: document.getElementById('scroll-cliente'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-cliente']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-cliente"]').addClass("activeImportat");
                },
                offset: 124
            });
            contacto = new Waypoint({
                element: document.getElementById('scroll-contacto'),
                handler: function(direction) {
                    $("#menu-lateral").removeClass("d-none");
                    $("#menu-lateral").find(".active").removeClass("active");
                    $("#menu-lateral *[data-scroll='scroll-contacto']").addClass("active");
                    $("nav,#menuNav").find(".activeImportat").removeClass("activeImportat");
                    $("nav,#menuNav").find('[data-scroll="scroll-contacto"]').addClass("activeImportat");
                },
                offset: 124
            });
            mostrarServicio = function(t,tipo) {
                $(t).closest(".tipo").find(".activeImportat").removeClass("activeImportat");
                $(t).addClass("activeImportat");

                $("[data-servicio]").addClass("d-none").removeClass("d-flex");
                $(`[data-servicio][data-tipo="${tipo}"]`).removeClass("d-none").addClass("d-flex");
            }
            servicio = function(id) {
                let modal = $("#modal");
                let html = "";
                aux = window.Arr_servicios.find(function(e) {
                    if(e.id == parseInt(id)) return e;
                    return null;
                });
                if(aux !== null) {
                    img = "{{ asset('/') }}" + aux.icon;
                    // html += '<div class="col l7 s12">';
                        
                    // html += '</div>';tra
                        html += '<div class="row">';
                            html += '<div class="col-12">';
                                html += `<img class="left mr-1" src="${img}" onError="this.src='{{ asset('images/general/no-img.png') }}'"/>`;
                                
                                html += `<h5>${aux.titulo['{{$languages}}']}</h5>`;
                                html += `<p>${aux.descripcion['{{$languages}}']}</p>`;
                                
                            html += '</div>';
                        html += '</div>';

                        html += '<ul class="row list-1">';
                        aux.detalle.esp.forEach(function(e) {
                            html += `<li class="col-md-4 col-12">${e}</li>`;
                        });
                        html += '</ul>';
                    
                    
                    modal.find(".modal-body").html(`${html}`);
                    modal.modal("show");
                }
            }
            trabajo = function(id) {
                let modal = $("#modal");
                let html = "";
                aux = window.Arr_trabajos.find(function(e) {
                    if(e.id == parseInt(id)) return e;
                    return null;
                });
                console.log(aux);
                if(aux !== null) {
                    img = "";
                    if(aux.imagenes.length != 0)
                        img = "{{ asset('/') }}" + aux.imagenes[0].image;
                    trabajo_1 = "{{ asset('images/general/trabajo-1.fw.png') }}";
                    trabajo_2 = "{{ asset('images/general/trabajo-2.fw.png') }}";
                    trabajo_3 = "{{ asset('images/general/trabajo-3.fw.png') }}";
                    trabajo_4 = "{{ asset('images/general/trabajo-4.fw.png') }}";

                    html += '<div class="row">';
                        html += '<div class="col-md-7 col-12">';
                            html += `<img id="imgGrande" class="w-100 img-thumbnail d-md-none d-lg-block" src="${img}" onError="this.src='{{ asset('images/general/no-img.png') }}'"/>`;
                        html += '</div>';
                        html += '<div class="col-md-5 col-12 d-flex align-items-center">';
                            html += `<div class="w-100">`;      
                                html += `<h5 class="m-0 title-trabajo">${aux.nombre}</h5>`;
                                                        
                                html += `<p><strong>${aux.data.titulo}</strong></p>`;
                                html += `<p>${aux.data.descripcion}</p>`;
                                
                                html += `<div class="mt-1 d-flex">`;
                                    html += `<div style="width: 38px" class="mr-3 modal-img"><img style="width: 100%;height: 38px !important;" src="${trabajo_1}"/></div>`;
                                    html += `<div><strong class="text-uppercase subtitle-trabajo">{{trans('words.details.name')}}</strong><br/>${aux.empresa}</div>`;
                                html += `</div>`;
                                html += `<div class="mt-1 d-flex">`;
                                    html += `<div style="width: 38px" class="mr-3 modal-img"><img style="width: 100%;height: 38px !important;" src="${trabajo_2}"/></div>`;
                                    html += `<div><strong class="text-uppercase subtitle-trabajo">{{trans('words.details.name')}}</strong><br/>${aux.ubicacion}</div>`;
                                html += `</div>`;
                                html += `<div class="mt-1 d-flex">`;
                                    html += `<div style="width: 38px" class="mr-3 modal-img"><img style="width: 100%;height: 38px !important;" src="${trabajo_3}"/></div>`;
                                    html += `<div><strong class="text-uppercase subtitle-trabajo">{{trans('words.details.volume')}}</strong><br/>${aux.volumen}</div>`;
                                html += `</div>`;
                                html += `<div class="mt-1 d-flex">`;
                                    html += `<div style="width: 38px" class="mr-3 modal-img"><img style="width: 100%;height: 38px !important;" src="${trabajo_4}"/></div>`;
                                    html += `<div><strong class="text-uppercase subtitle-trabajo">{{trans('words.details.time')}}</strong><br/>${aux.data.tiempo}</div>`;
                                html += `</div>`;
                            html += `</div>`;
                        html += '</div>';
                    html += '</div>';
                    html += '<div class="row mt-2">';
                        for(x in aux.imagenes) {
                            html += '<div onclick="galeria(this);" class="col-md-2 col-12">';
                                img = "{{ asset('/') }}" + aux.imagenes[x].image;
                                html += `<img class="w-100 img-thumbnail d-block" src="${img}" onError="this.src='{{ asset('images/general/no-img.png') }}'"/>`;
                            html += '</div>';
                        }
                    html += '</div>';
                    modal.find(".modal-body").html(html);
                    modal.modal("show");
                }
            }
            galeria = function(t) {
                src = $(t).find("img").attr("src");
                $("#imgGrande").attr("src",src);
            }
            cerrarModal = function() {
                let modal = $("#modal1");
                modal.modal("close");
            }

            ubicacion = function(t) {
                $(".activoUbicacion").removeClass("activoUbicacion");
                console.log(`.${t}`)
                $(`.${t}`).addClass("activoUbicacion");
                if(t == "ba") {
                    $("#info").find("> div:first-child() div").html(`<p class="mb-0 w-75 mx-auto">${window.empresa.domicilio[t].calle} ${window.empresa.domicilio[t].altura}</p><p class="mb-0 w-75 mx-auto">${window.empresa.domicilio[t].localidad} - ${window.empresa.domicilio[t].cp}</p><p class="mb-0 w-75 mx-auto">Buenos Aires</p>`);
                    $("#sede").find("p").text("sede buenos aires");
                    $("#iframeUbicacion").attr("src","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.1272454211594!2d-58.33444588504891!3d-34.70197037020982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a332f35a52a269%3A0x697a5412d4da1f9f!2sBv.+de+los+Italianos+555%2C+B1874DYF+Villa+Dominico%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1553190217059");
                } else {
                    $("#info").find("> div:first-child() div").html(`<p class="mb-0 w-50 mx-auto">${window.empresa.domicilio[t].calle} ${window.empresa.domicilio[t].altura}</p><p class="mb-0 w-75 mx-auto">${window.empresa.domicilio[t].localidad} - ${window.empresa.domicilio[t].mas}</p><p class="mb-0 w-75 mx-auto">Neuquén</p>`);
                    $("#sede").find("p").text("sede neuquén");
                    $("#iframeUbicacion").attr("src","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3102.6568174047725!2d-68.05727338489544!3d-38.95466780795188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x960a33d3964ab2c3%3A0x8f5e8b8c068783fc!2sBv.+25+de+Mayo+286%2C+Q8300+Neuqu%C3%A9n!5e0!3m2!1ses!2sar!4v1553512882353");
                }
                $("#info").find("> div:nth-child(2) div").html("");
                
                window.empresa.contactos.contacto[t].forEach(function(e) {
                    $("#info").find("> div:nth-child(2) div").append(`<p class="text-center"><a href="tel:${e}" target="blank">${e}</a></p>`);
                });
            }
        </script>
    </body>
</html>
