@extends('elementos.main')

@section('headTitle', $title . " | IMC")
@section('bodyTitle', $title)

@section('body')

<h3 class="title">{{$title}}</h3>

<section>
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-body">
                <form novalidate method="POST" action="{{ url('/adm/contenido/' . strtolower($seccion) . '/update') }}"  enctype="multipart/form-data">
                    @method("POST")
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    @include('adm.contenido.' . $seccion)
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

