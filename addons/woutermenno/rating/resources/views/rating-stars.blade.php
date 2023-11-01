<!-- FILEPATH: /c:/Users/tackw/cms/labo-2-statamic/addons/woutermenno/rating/resources/views/rating.antlers.html -->


@section('title', 'Rating')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/addon.css') }}">
@endpush

@section('content')
<div class="mb-3">
    <h1 class="">Rating Settings</h1>
</div>

<form action="{{ route('rating.store') }}" method="POST">
    @csrf

    <label for="rating">Select Rating:</label>
    <div class="rating" id="starContainer">
        <span class="star" value="1">&#9733;</span>
        <span class="star" value="2">&#9733;</span>
        <span class="star" value="3">&#9733;</span>
        <span class="star" value="4">&#9733;</span>
        <span class="star" value="5">&#9733;</span>
    </div>

    <input type="hidden" name="rating" id="rating" value="">
    <div id="feedbackMessage" class="alert"></div>
    <button type="submit" class="btn-primary-cp">Post rating</button>
</form>