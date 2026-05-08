<section class="testimonial-section p-tb-100 bg-black bg-overlay-1">
    <div class="container">
        <div class="section-title">
            <small>Review</small>
            <h2 class="color-white">{{ $heading ?? 'Guests talk about the flavour, freshness, and service' }}</h2>
        </div>
        <div class="testimonial-carousel owl-carousel owl-theme">
            @foreach ($reviews as $review)
                <div class="item">
                    <x-review-card :review="$review" />
                </div>
            @endforeach
        </div>
    </div>
</section>
