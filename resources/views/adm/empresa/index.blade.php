@extends('elementos.main')

@section('headTitle', $title. ' | GDS')
@section('bodyTitle', $title)

@section('body')
<h3 class="title">{{$title}}</h3>
<section>
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <form novalidate method="POST" action="{{ url('/adm/empresa/' . strtolower($seccion) . '/update') }}"  enctype="multipart/form-data">
                    @method("POST")
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    @include('adm.empresa.' . $seccion)
                </form>
            </div>
        </div>
    </div>
</section>

@endsection