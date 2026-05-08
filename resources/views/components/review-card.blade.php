@props(['review'])

<div class="testimonial-carousel-item bg-main">
    <p class="carousel-para">{{ $review['quote'] }}</p>
    <div class="carousel-info-grid">
        <div class="carousel-thumb">
            <img src="{{ asset($review['image']) }}" alt="{{ $review['name'] }}">
        </div>
        <div class="carousel-info text-end">
            <div class="review-star">
                <ul class="justify-content-end">
                    @for ($i = 0; $i < 5; $i++)
                        <li class="full-star"><i class="flaticon-star-1"></i></li>
                    @endfor
                </ul>
            </div>
            <h3 class="carousel-name">{{ $review['name'] }}</h3>
            <h4 class="carousel-designation">{{ $review['designation'] }}</h4>
        </div>
    </div>
</div>
