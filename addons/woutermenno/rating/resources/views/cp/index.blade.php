<!-- rating::cp.index.blade.php -->

@extends('statamic::layout')

@section('title', 'Rating Settings')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/addon.css') }}">
@endpush

@section('content')
<div class="mb-3">
    <h1 class="title">Rating Settings</h1>
</div>

<h2 class="total-ratings">Total ratings:
    {{ count($ratings) }}</h2>
<div class="new-rating-container">
<h2 class="new-rating" >Add a new rating:</h2>
<form name="entryId" action="{{ cp_route('rating-addon.store') }}" method="POST" data-id="{{ 'entryId' }}" class="form-rating">
    @csrf


    <div class="rating" id="starContainer">
        <span class="star" value="1">&#9733;</span>
        <span class="star" value="2">&#9733;</span>
        <span class="star" value="3">&#9733;</span>
        <span class="star" value="4">&#9733;</span>
        <span class="star" value="5">&#9733;</span>
    </div>

    <!-- Add an input field for the rating -->
    <input type="hidden" name="rating" id="rating" value="">

    <button type="submit" class="btn-primary post-rating">Post rating</button>
</form>
</div>
<div id="feedbackMessage" class="alert"></div>


<!-- Display all ratings -->


    <h2 class="all-ratings">All Ratings:</h2>
@if (!empty($ratings))
    <ul>
        @foreach($entries as $entry)
            <div class="container-ratings">
                <p class="ratings"><strong>Rating: </strong> {{ $entry->rating }}</p>

               <!-- Edit Form -->
                <form action="{{ cp_route('edit.rating') }}" method="GET" style="display: inline;">
                    @csrf
                    <input type="hidden" name="rating" value="{{ $entry->rating }}">
                    <button type="submit" class="btn-primary edit">Edit</button>
                </form>

                <!-- Delete Form -->
                <form action="{{ cp_route('delete.rating') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="rating" value="{{ $entry->rating }}">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>

                <p class="entries"><strong>Entry ID:</strong> <br>{{ $entry->entry_id }}</p>
                <p class="ratings"><strong>Rating ID: </strong> <br>{{ $entry->rating_id }}</p>
                <p class="users"><strong>User ID: </strong> <br> {{ $entry->user_id }}</p>
            </div>
        @endforeach
    </ul>
@else
    <p>No ratings available.</p>
@endif

<p class="average-rating">Average Rating: {{ $averageRating }}</p>

<!-- Add blueprint to collection -->

<form action="{{ cp_route('rating.add-blueprint') }}" method="POST">
    @csrf

    <!-- Display buttons for each collection -->
    @if (!empty($collections))
        @foreach($collections as $collection)
            <button type="submit" name="collection_handle" value="{{ $collection->handle }}" class="btn-primary">
                Add blueprint to {{ $collection->handle }} collection
            </button>
        @endforeach
    @else
        <p>No collections available.</p>
    @endif
</form>
@stop
