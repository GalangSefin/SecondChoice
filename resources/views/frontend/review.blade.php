//review
<h3>Add Your Review</h3>
<form action="{{ url('/products/' . $product->id . '/reviews') }}" method="POST">
    @csrf
    <div>
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" id="rating" min="1" max="5" required>
    </div>
    <div>
        <label for="comment">Comment:</label>
        <textarea name="comment" id="comment" rows="3"></textarea>
    </div>
    <button type="submit">Submit Review</button>
</form>

<h3>Reviews</h3>
@foreach ($product->reviews as $review)
    <div>
        <strong>{{ $review->user->name }}</strong> rated {{ $review->rating }}/5
        <p>{{ $review->comment }}</p>
    </div>
@endforeach