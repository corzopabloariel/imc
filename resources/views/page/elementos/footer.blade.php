<footer class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form id="newsletters" action="{{ url( $languages . '/newsletters') }}" onsubmit="" method="post">
                    @method("post")
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <p class="text-center text-uppercase title">{{trans('words.form.subscribe.text')}}</p>
                    <div class="d-flex justify-content-center">
                        <input placeholder="{{trans('words.form.subscribe.email')}}" class="form-control mr-1" style="width:250px" type="email" name="email" style="" />
                        <button type="submit" class="btn btn-gds text-uppercase">{{trans('words.form.subscribe.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <ul class="text-uppercase list-unstyled d-flex flex-wrap justify-content-center mb-0">
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="nav">{{trans('words.menu.home')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-nosotros">{{trans('words.menu.us')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-servicio">{{trans('words.menu.services')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-prensa">{{trans('words.menu.press')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-portfolio">{{trans('words.menu.portfolio')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-rrhh">{{trans('words.menu.rrhh')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-cliente">{{trans('words.menu.clients')}}</a></li>
                    <li><a href="{{ URL::to( 'index/' . $idioma ) }}" data-scroll="scroll-contacto">{{trans('words.menu.contact')}}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr style="border-bottom: none; border-color: #878787; border-top: 1px solid">
                <p style="color:#878787" class="mb-0 d-flex justify-content-between">
                    <span>© 2019</span>
                    <a href="http://osole.es" style="color:inherit" class="right text-uppercase">by osole</a>
                </p>
            </div>
        </div>
    </div>
</footer>