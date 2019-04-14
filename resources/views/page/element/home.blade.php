<section>
    <div id="carouselExampleIndicators mb-2" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for($i = 0 ; $i < count($slider) ; $i++)
                @if($i == 0)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="active"></li>
                @else
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                @endif
            @endfor
        </ol>
        <div class="carousel-inner">
            @for($i = 0 ; $i < count($slider) ; $i++)
                @if($i == 0)
                    <div class="carousel-item active">
                @else
                    <div class="carousel-item">
                @endif
                <img class="d-block w-100" src="{{asset($slider[$i]['img'])}}" >
                <div class="carousel-caption d-none d-md-block w-100" style="left:0; right:0; text-align: left">
                    <div class="container">
                        {!! $slider[$i]['texto'] !!}
                    </div>
                </div>
                {{--<div class="position-absolute w-100">
                        
                </div>--}}
            </div>
            @endfor
        </div>
    
        {{--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>--}}
    </div>
    <div class="wrapper-destacados py-4">
        <h3 class="title text-uppercase text-center mb-2">productos destacados</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-3 col-12">
                    <a href="{{ route('ecobruma') }}">
                        <div class="position-relative">
                            <i class="fas fa-plus position-absolute"></i>
                            <div class="position-absolute w-100 h-100"></div>
                            <img src="{{$ecobruma}}" alt="" class="w-100" srcset="">
                        </div>
                        <p class="m-0 p-2">Ecobruma</p>
                    </a>
                </div>
                @foreach($productos AS $p)
                    @php
                    $p["data"] = json_decode($p["data"], true);
                    $p["imagenes"] = $p->imagenes;
                    $p["familia_id"] = App\Familia::find($p["familia_id"])["titulo"];
                    $img = null;
                    if(count($p["imagenes"]) > 0)
                        $img = $p["imagenes"][0]["img"];
                    @endphp
                @endforeach
                <div class="col-md-3 col-12">
                    <a href="">
                        <div class="position-relative">
                            <i class="fas fa-plus position-absolute"></i>
                            <div class="position-absolute w-100 h-100"></div>
                            <img src="{{$img}}" alt="" class="w-100" srcset="">
                        </div>
                        <p class="m-0 p-2">{{$p["titulo"]}}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper-home py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <img src="{{asset($contenido['img'])}}" class="d-block w-100" alt="GDS Home">
                </div>
                <div class="col-md-6 col-12">
                    <h3 class="title">{!! $contenido["titulo"] !!}</h3>
                    {!! $contenido["texto"] !!}
                    <ul class="list-unstyled caracteristicas">
                        @foreach($contenido["opciones"] AS $c)
                        <li class="d-flex align-items-center"><img src="{{asset($c['img'])}}" class="mr-2"/>{{$c["titulo"]}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>