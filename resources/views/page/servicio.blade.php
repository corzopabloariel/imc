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
        
        <div class="modal fade" id="modal">
            <div class="modal-dialog" role="document">
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
        @include('page.elementos.navLateral')
        @include('page.element.nav')
        
        <div style="padding: 174px 0 60px 0;" class="wrapper-servicio container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <h4 class="position-relative text-uppercase text-center title">
                        <small style="left: 0; font-size: 14px; font-weight: normal;" class="position-absolute navbar"><a style="color: #D7BE89 !important" href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-servicio">« Volver</a></small>
                        {{trans('words.menu.services')}}
                    </h4>
                    <div class="tipo text-center text-uppercase py-3">
                        @if($servicio["tipo"] == "EMP")
                            <a style="cursor: pointer" class="activeImportat">{{trans('words.services.business')}}</a>
                            <a style="cursor: pointer" class="" href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-servicio">{{trans('words.services.equipment_rental')}}</a>
                        @else
                            <a style="cursor: pointer" class="" href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-servicio">{{trans('words.services.business')}}</a>
                            <a style="cursor: pointer" class="activeImportat">{{trans('words.services.equipment_rental')}}</a>
                        @endif
                    </div>
                    <section>
                        <div class="container">
                            <div class="row justify-content-center">
                                @if( $servicio["tipo"] == "EMP")
                                <div class="col-md-2 col-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="icon-servicio">
                                            <img src="{{ asset($servicio['icon']) }}" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-10 col-8">

                                    <h5>{!! $servicio["data"]["titulo"] !!}</h5>
                                    <p>{!! $servicio["data"]["descripcion"] !!}</p>
                                    @isset($servicio["data"]["detalle"])
                                    <ul class="row mt-1 list-1">
                                        @foreach($servicio["data"]["detalle"] AS $e)
                                            @if($e != "null" && !is_null($e))
                                            <li class="col-md-4 col-12">{{ $e }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    @endisset
                                    @isset($servicio["data"]["galeria"])
                                        <div class="card-columns mt-3">
                                        @foreach($servicio["data"]["galeria"] AS $i)
                                            <div class="card">
                                                <img class="card-img-top" onclick="ampliar(this);" src="{{ asset('/') . $i['image'] }}" onError="this.src='{{ asset('images/general/no-img.png') }}'"/>
                                                <div class="d-none">
                                                    {!! $i["descripcion"] !!}     
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    @endisset
                                    @isset($servicio["data"]["seccion"])
                                        @foreach($servicio["data"]["seccion"] AS $s)
                                        <div class="mt-4">
                                            <h5>{{$s["titulo"]}}</h5>
                                            <div class="text-justify">{!!$s["descripcion"]!!}</div>
                                            <div class="card-columns mt-3">
                                            @foreach($s["images"] AS $i)
                                                <div class="card">
                                                    <img class="card-img-top" onclick="ampliar(this);" src="{{ asset('/') . $i['image'] }}" onError="this.src='{{ asset('images/general/no-img.png') }}'"/>
                                                    <div class="d-none">
                                                        {!! $i["descripcion"] !!}     
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
        @include('page.elementos.footer')
        
        @include('adm.elementos.javascript')

        <script>
            
            $(document).ready(function() {
                $(window).scroll(function() {     
                    let scroll = $(window).scrollTop();
                    if (scroll > 0)
                        $("#nav").addClass("activeScroll");
                    else
                        $("#nav").removeClass("activeScroll");
                });
            });
            $("nav").find(".activeImportat").removeClass("activeImportat");
            $("nav").find('[data-scroll="scroll-servicio"]').addClass("activeImportat");

            $(".navbar a").click(function() {
                localStorage.setItem('scroll', $(this).data("scroll"));
            });

            ampliar = function(t) {
                let src = $(t).attr("src");
                let descripcion = $(t).closest(".card").find("> div").html();
                let html = "";
                html += '<div class="row">';
                    html += '<div class="col-12">';
                        html += `<img src="${src}" class="w-100 img-thumbnail" />`
                    html += '</div>';
                html += '</div>';
                if(descripcion.trim() != "") {
                    html += '<div class="row mt-3">';
                        html += '<div class="col-12">';
                            html += descripcion;
                        html += '</div>';
                    html += '</div>';
                }
                $("#modal").find(".modal-body").html(html);
                $("#modal").modal("show");
            }
        </script>
    </body>
</html>