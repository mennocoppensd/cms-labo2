<!-- rating::cp.edit.blade.php -->

@extends('statamic::layout')

@section('title', 'Edit Rating')

@section('content')
<form action="{{ cp_route('update.rating', ['rating' => $rating]) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Add fields for editing rating details -->
    <!-- For example: -->
    <label for="new_rating">Edit Rating:</label>
    <input type="text" name="new_rating" value="{{ $rating }}">

    <button type="submit">Save Changes</button>
</form>

@endsection
