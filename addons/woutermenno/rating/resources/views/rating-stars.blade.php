<!-- FILEPATH: /c:/Users/tackw/cms/labo-2-statamic/addons/woutermenno/rating/resources/views/rating.antlers.html -->


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

    <button type="submit" class="btn-primary">Save</button>
</form>

{{ $ip_address }}
