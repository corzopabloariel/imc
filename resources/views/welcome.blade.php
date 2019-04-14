@extends('elementos.page')

@section('headTitle', strtoupper($title). ' | GSD')
@section('bodyTitle', $title)

@section('body')
@include('page.element.' . $title)
@endsection