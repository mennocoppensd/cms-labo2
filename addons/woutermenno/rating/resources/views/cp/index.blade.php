@extends('statamic::layout')
@section('title', 'Rating Settings')


@section('content')
<div class="mb-3">
        <h1 class="">Rating Settings</h1>
    </div>

    <form action="{{ cp_route('rating-addon.store') }}" method="POST">
    @csrf

    <label for="rating">Select Rating:</label>
    <select name="rating" id="starContainer">
        <option value="1">&#9733;</option>
        <option value="2">&#9733;&#9733;</option>
        <option value="3">&#9733;&#9733;&#9733;</option>
        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
    </select>

    <button type="submit" class="btn-primary">Save</button>
    </form>


@endsection