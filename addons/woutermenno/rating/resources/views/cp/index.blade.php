<!-- rating::cp.index.blade.php -->

@extends('statamic::layout')

@section('title', 'Rating Settings')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/addon.css') }}">
@endpush

@section('content')
<div class="mb-3">
    <h1 class="">Rating Settings</h1>
</div>

<!-- Add blueprint to collection -->
<form action="{{ cp_route('rating.addBlueprint') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn-primary">Add blueprint to collection</button>
</form>

<form name="entryId" action="{{ cp_route('rating-addon.store') }}" method="POST" data-id="{{ 'entryId' }}">
    @csrf

    <label for="rating">Add a new Rating:</label>
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

<!-- Display all ratings -->
<h2>All Ratings:</h2>
@if (!empty($ratings))
    <ul>
        @foreach($ratings as $rating)
            <div>
                Rating: {{ $rating }}
             
               <!-- Edit Form -->
                <form action="{{ cp_route('edit.rating') }}" method="GET" style="display: inline;">
                    @csrf
                    <input type="hidden" name="rating" value="{{ $rating }}">
                    <button type="submit" class="edit-btn">Edit</button>
                </form>

                <!-- Delete Form -->
                <form action="{{ cp_route('delete.rating') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="rating" value="{{ $rating }}">
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
