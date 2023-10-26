@extends('statamic::layout')
@section('title', 'Rating Settings')


@section('content')
<div class="mb-3">
    <h1 class="">Rating Settings</h1>
</div>

<form name="entryId" action="{{ cp_route('rating-addon.store') }}" method="POST" data-id="{{ 'entryId' }}">

    @csrf

    <label for="rating">Select Rating:</label>
    <div class="rating" id="starContainer">
        <span class="star" value="1">&#9733;</span>
        <span class="star" value="2">&#9733;</span>
        <span class="star" value="3">&#9733;</span>
        <span class="star" value="4">&#9733;</span>
        <span class="star" value="5">&#9733;</span>
    </div>

    <!-- Add an input field for the rating -->
    <input type="hidden" name="rating" id="rating" value="">
    <div id="feedbackMessage" class="alert"></div>
    <button type="submit" class="btn-primary">Post rating</button>
</form>

@if (!empty($ratings))
    <ul>
        @foreach($ratings as $rating)
            <div>
                Rating: {{ $rating }}
                <form action="{{ cp_route('delete.rating', ['rating' => $rating]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        @endforeach
    </ul>
        @else
            <p>No ratings available.</p>
@endif

<p>Average Rating: {{ $averageRating }}</p>



@stop