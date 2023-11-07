<!-- FILEPATH: /c:/Users/tackw/cms/labo-2-statamic/addons/woutermenno/rating/resources/views/rating.antlers.html -->
@extends('statamic::layout')

@section('title', 'Rating')

@section('content')



<form action="{{ route('rating.store') }}" method="POST">
    @csrf

    
    <div class="rating" id="starContainer">
        <span class="star" value="1">&#9733;</span>
        <span class="star" value="2">&#9733;</span>
        <span class="star" value="3">&#9733;</span>
        <span class="star" value="4">&#9733;</span>
        <span class="star" value="5">&#9733;</span>
    </div>

    <input type="hidden" name="rating" id="rating" value="">
    <div id="feedbackMessage" class="alert"></div>
    <button type="submit" class="btn-primary">Post rating</button>
</form>


@if(session('jsCode'))
    {!! session('jsCode') !!}
@endif
    
<div class="average-rating">
    Average rating: {{ $averageRating }}
</div>

@stop