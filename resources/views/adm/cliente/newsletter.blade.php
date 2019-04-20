@extends('elementos.main')

@section('headTitle', $title. ' | IMC')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>

<section class="mt-3">
    <div class="container-fluid">
        <div class="card" id="wrapper-tabla">
            <div class="card-body">
                <table class="table mb-0" id="tabla">
                    <thead class="thead-dark">
                        <th class="text-uppercase">Email</th>
                        <th class="text-uppercase">Idioma</th>
                        <th class="text-uppercase text-center">acción</th>
                    </thead>
                    <tbody>
                        @if(count($news) != 0)
                            @foreach($news AS $n)
                                <tr data-id="{{ $n['id'] }}">
                                    <td class="">{!! $n["email"] !!}</td>
                                    <td class="text-uppercase">{!! $n["idioma"] !!}</td>
                                    <td class="text-center">
                                        <button type="button" onclick="deleteNews({{ $n['id'] }}, this)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-uppercase text-center">
                                    sin datos
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="//cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

deleteNews = function(id, t) {
    $(t).attr("disabled",true);
    let promise = new Promise(function (resolve, reject) {
        let url = `{{ url('/adm/cliente/newsletter') }}/${id}`;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", url, true );
        
        xmlHttp.onload = function() {
            resolve(xmlHttp.responseText);
        }
        xmlHttp.send( null );
    });

    promiseFunction = () => {
        promise
            .then(function(msg) {
                $("#tabla").find(`tr[data-id="${id}"]`).remove();
                if($("#tabla").find("tbody").html().trim() == "")
                    $("#tabla").find("tbody").html('<tr><td colspan="3" class="text-uppercase text-center">sin datos</td></tr>');
                
            })
    };
    promiseFunction();
};
</script>
@endpush