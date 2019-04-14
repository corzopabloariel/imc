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
    <div class="wrapper-empresa py-4">
        <div class="container">
            <h3 class=title>{{$contenido["acerca"]["titulo"]}}</h3>
            <div class="row mt-2">
                <div class="col-md-6 col-12">
                {!! $contenido["acerca"]["texto"] !!}
                </div>
                <div class="col-md-6 col-12">
                    <ul class="list-unstyled numeros">
                    @foreach($contenido["acerca"]["opciones"] AS $o)
                        <li class="d-flex align-items-center"><span class="mr-2">{{$o["numero"]}}</span>{{$o["nombre"]}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="row mt-3 mision-vision">
                <div class="col-md-6 col-12">
                    <div class="shadow">
                        <h4 class="title">{{$contenido["mision"]["titulo"]}}</h4>
                        {!!$contenido["mision"]["texto"]!!}
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="shadow">
                        <h4 class="title">{{$contenido["valor"]["titulo"]}}</h4>
                        {!!$contenido["valor"]["texto"]!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>