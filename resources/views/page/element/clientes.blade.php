<div style="padding-top: 50px; padding-bottom: 50px" class="wrapper-clientes" id="scroll-cliente">
    <h4 class="title text-uppercase text-center">{{trans('words.menu.clients')}}</h4>
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-11">
                {{-- <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: block;">Previous</button> --}}
                <div class="regular slider" id="clientes">
                    @foreach($clientes AS $c)
                    <div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('/')}}{{$c}}">
                        </div>
                    </div>
                    @endforeach
                </div>
                {{--<button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button>--}}
            </div>
        </div>
    </div>
</div>