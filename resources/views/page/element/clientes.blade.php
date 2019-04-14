<section class="wrapper-clientes py-5">
    <div class="container">
        <div class="row py-3">
            <div class="col-12">
                <h3 class="title">Clientes</h3>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-12">
                {!! $contenido["texto"] !!}
            </div>
        </div>
        <div class="row listado m-0">
            @foreach ($contenido["listado"] as $v)
                <div class="col-md-3 col-12 my-3 p-0">
                    <img src="{{asset($v['img'])}}" class="w-100" />
                    <p class="mb-0 text-center">{{$v["nombre"]}}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>