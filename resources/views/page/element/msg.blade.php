@if(session('success'))
    <div class="position-fixed w-100 text-center" style="z-index:9999;">
        <div class="alert alert-success" style="display: inline-block;">
            {!! session('success')["mssg"] !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
@if($errors->any())
    <div class="position-fixed w-100 text-center" style="z-index:9999;">
        <div class="alert alert-danger" style="display: inline-block;">
            {!! $errors->first('mssg') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif