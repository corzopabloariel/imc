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
        @include('page.element.nav')
        @include('page.element.navModal')
        
        <div style="padding: 174px 0 60px 0;" class="wrapper-oferta">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-12">
                        <h4 style="padding-bottom:25px; font-size: 30px;" class="position-relative text-uppercase text-center title">
                            <small class="position-absolute volver"><a style="color: #D7BE89 !important" href="{{ URL::to( 'index/' . $idioma ) }}">« Volver</a></small>
                            {{trans('words.rrhh')}}
                        </h4>
                        <form action="{{ url('/envio/') }}/{{$oferta['id']}}" method="post" enctype="multipart/form-data">
                            @method('POST')
                            
                            <div class="row">
                                <div class="col-12">
                                    <p style="font-size: 25px;color: #D7BE88;font-weight: bold;">{{$oferta["data"]["nombre"]}} <small class="text-uppercase" style="font-weight: initial; font-size:15px">@if($oferta["provincia"] == "BA") buenos aires @else neuquén @endif</small></p>
                                    <p style="font-size: 18px;color: #353535;"><strong style="font-weight:700">{{trans('words.work.age')}}</strong> {{$oferta["data"]["rango"]}}</p>
                                    <p style="font-size: 18px;color: #353535;"><strong style="font-weight:700">{{trans('words.work.year')}}</strong> {{$oferta["data"]["experiencia"]}}</p>
                                    <p style="font-size: 18px;color: #353535;"><strong style="font-weight:700">{{trans('words.work.orientation')}}</strong> {{$oferta["data"]["orientacion"]}}</p>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12"><input class="form-control input" type="text" name="nombre" placeholder="{{trans('words.work.form.name')}}"/></div>
                                <div class="col-md-6 col-12"><input class="form-control input" type="text" name="apellido" placeholder="{{trans('words.work.form.last_name')}}"/></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12"><input class="form-control input" type="email" name="email" placeholder="Email"/></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 col-12"><input class="form-control input" type="text" name="formacion" placeholder="{{trans('words.work.form.formation')}}"/></div>
                                <div class="col-md-6 col-12 texto2">
                                    <label>{{trans('words.work.form.file')}}<input accept="application/pdf,image/jpeg,image/png" type="file" name="archivo"/></label>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn-gds btn text-uppercase">{{trans('words.work.form.submit')}}</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
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
            $("nav").find('[data-scroll="scroll-rrhh"]').addClass("activeImportat");

            $(".navbar a").click(function(e) {
                e.preventDefault();
                let url = "{{ URL::to( 'index/' . $idioma ) }}";
                localStorage.setItem('scroll', $(this).data("scroll"));

                window.location = url;
                return false;
            });
        </script>
    </body>
</html>