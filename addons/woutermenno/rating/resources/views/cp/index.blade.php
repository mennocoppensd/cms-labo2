@extends('statamic::layout')
@section('title', 'Rating Settings')


@section('content')
<div class="mb-3">
    <h1 class="">Rating Settings</h1>
</div>

<form action="{{ cp_route('rating-addon.store') }}" method="POST">
    @csrf

    <label for="rating">Select Rating:</label>
    <select name="rating" id="rating">
        <option value="1">&#9733;</option>
        <option value="2">&#9733;&#9733;</option>
        <option value="3">&#9733;&#9733;&#9733;</option>
        <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
        <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
    </select>

    <button type="submit" class="btn-primary">Save</button>
    </form>

<script>
    // Vanilla JavaScript for star rating
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('value');
            ratingInput.value = value;
            // Highlight the selected stars
            stars.forEach(s => {
                s.classList.remove('selected');
            });
            star.classList.add('selected');
        });
    });
</script>
