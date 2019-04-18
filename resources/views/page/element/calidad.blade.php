<div class="wrapper-calidad">
    <div class="container">
        <div class="row justify-content-end">
            <div class="texto col-12 col-md-12 col-lg-6 position-relative extra">
                <div class="position-relative text-white" style="z-index: 1">
                    <h4 class="title text-uppercase">{{trans('words.menu.quality')}}</h4>
                    {!! $calidad !!}
                    <div class="row mt-1">
                        <div class="col-12 col-md-6">
                            <a class="text-center text-truncate btn btn-block btn-gds" target="blank" href="{{ asset('/')}}{{ $archivosCalidad[0]['documento'] }}">{{ $archivosCalidad[0]["nombre"] }}</a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a class="text-center text-truncate btn btn-block btn-invertido" target="blank" href="{{ asset('/')}}{{ $archivosCalidad[1]['documento'] }}">{{ $archivosCalidad[1]["nombre"] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>