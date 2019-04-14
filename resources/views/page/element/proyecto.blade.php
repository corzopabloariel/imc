<section class="wrapper-proyecto">
    <div class="container">
        <div class="row py-3">
            <div class="col-12">
                <p class="title"><a href="{{ route('proyectos') }}">Proyectos</a> | {{$proyecto["titulo"]}}</p>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-7 col-12">
                <div id="carouselExampleIndicators mb-2" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i = 0 ; $i < count($proyecto["img"]) ; $i++)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i == 0) class="active" @endif></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @for($i = 0 ; $i < count($proyecto["img"]) ; $i++)
                        <div class="carousel-item @if($i == 0) active @endif">
                            <img class="d-block w-100" src="{{asset($proyecto['img'][$i])}}" >
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-md-center mt-4">
            <div class="col-md-7 col-12">
                <h3 class="title mb-4">{{$proyecto["titulo"]}}</h3>
                <div>
                    {!! $proyecto["texto"] !!}
                </div>
            </div>
        </div>
    </div>
</section>