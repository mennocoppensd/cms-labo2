@extends('statamic::layout')
@section('title', 'Rating Settings')


@section('content')
<div class="mb-3">
    <h1 class="">Rating Settings</h1>
</div>

<form action="{{ cp_route('rating-addon.store') }}" method="POST">
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
