@section('title', 'Rating')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/addon.css') }}">
@endpush

<style>
.star {
  font-size: 30px;
  color: gray;
  cursor: pointer;
}

.rating:hover .star,
.rating .star.active {
  color: gold;
}

.rating:hover .star:hover ~ .star
 {
  color: gray;
}

.alert {
  font-size: 16px;
  color: rgb(228, 77, 77);
  margin-top: 10px;
  margin-bottom: 20px;

  font-family: 'Courier New', Courier, monospace;
}


.new-rating{
  margin-top: 30px;
  margin-bottom: 10px;
  font-size: 24px;
}

.new-rating-subtitle{
  margin-bottom: 30px;
  font-size: 18px;
}
.new-rating-container{
  padding: 20px;
  border: 8px solid rgba(134, 134, 134, 0.518);
  border-radius: 3rem;
}

.all-ratings{
  font-size: 24px;
  margin-top: 35px;
}

.form-rating{
  display: flex;

}

.post-rating{
  margin-left: 30px;
  margin-top: 5px;
}

.container-ratings{
  display: flex;
  margin-top: 30px;
  padding: 20px;
  border: 1px solid rgb(164, 164, 164);
  border-radius: 8px;
  background-color: rgb(255, 255, 255);
}

.ratings{
  font-size: 18px;
  margin-bottom: 20px;
}

.edit{
  margin-left: 30px;
  margin-top: 0px;
  font-size: 15px;
}

.delete-btn {
  font-size: 15px;
  color: white;
  background-color:rgb(228, 77, 77);
  margin-left: 15px;
  padding: 0.5rem 1rem;
  border-radius: 7.5%;
}

.btn-primary {
  font-size: 20px;
  margin-top: 30px;
  margin-bottom: 30px;
  padding: 10px;
  background-color: #000;
  color: #fff;
  border-radius: 8px;
}

.btn-primary:hover {
  background-color: #fff;
  color: #000;
  cursor: pointer;
}

.delete-btn:hover {
  background-color:rgb(255, 0, 0);
}

.average-rating, .total-ratings{
  font-size: 24px;
  margin-top: 30px;
  margin-bottom: 30px;
  padding: 20px;
  background-color: #000;
  color: #fff;
  border-radius: 8px;
}

.title{
  font-size: 35px;
  text-decoration: underline;
  text-underline-offset: 5px;
}



</style>
<div class="new-rating-container">
<form action="{{ route('rating.store') }}" method="POST">
    @csrf
    <h1 class="new-rating" >Rate and review</h1>
    <h2 class="new-rating-subtitle" >Share your experience to help others!</h2>
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
</div>

@if(session('jsCode'))
    {!! session('jsCode') !!}
@endif

<div class="average-rating">
    Average rating: {{ $averageRating }}
</div>
