<section class="wrapper-productos py-5">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 col-12">
                <div class="row">
                    @foreach ($familias as $v)
                        <a href="{{ URL::to('productos/'. $v['id']) }}" class="col-md-4 col-12 my-3">
                            <div class="position-relative">
                                <i class="fas fa-plus position-absolute"></i>
                                <div class="position-absolute w-100 h-100"></div>
                                <img src="{{asset($v['img'])}}" onError="this.src='{{ asset('images/general/no-img.png') }}'" class="w-100" />
                            </div>
                            <p class="mb-0 mt-2">{{$v["titulo"]}}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>