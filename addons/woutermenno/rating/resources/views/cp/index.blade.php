@extends('statamic::layout')
@section('title', 'Cool Addon Settings')


@section('content')
    <h1>
        Hello addon rating
    </h1>

    <hr>

    <a href="{{ cp_route('rating.add', 'pages')}}" class="btn">
        Add fields to pages collection
    </a>
@endsection