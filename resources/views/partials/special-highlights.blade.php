<section class="special-section bg-overlay-2 pt-100 pb-70 bg-black">
    <div class="container">
        <div class="section-title">
            <small>{{ $smallTitle ?? 'Speciality' }}</small>
            <h2 class="color-white">{{ $heading ?? 'Our Special Ingredients' }}</h2>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-sm-12 col-md-4 col-lg-4 text-end wow animate__slideInUp" data-wow-duration="1.5s" data-wow-delay="0.1s">
                @foreach ($ingredientHighlights['left'] as $item)
                    <div class="info-item info-item-right info-item-white">
                        <h3>{{ $item['title'] }} <span>{{ $item['accent'] }}</span></h3>
                        <p>{{ $item['description'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 wow animate__zoomIn" data-wow-duration="1.5s" data-wow-delay="0.3s">
                <div class="info-image">
                    <img src="{{ asset('assets/images/special-food.png') }}" alt="Max Kebab ingredients">
                    <div class="info-shape">
                        @for ($arrow = 1; $arrow <= 6; $arrow++)
                            <div class="info-shape-item">
                                <img src="{{ asset("assets/images/arrow-{$arrow}.png") }}" alt="ingredient highlight arrow">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 wow animate__slideInUp" data-wow-duration="1.5s" data-wow-delay="0.2s">
                @foreach ($ingredientHighlights['right'] as $item)
                    <div class="info-item info-item-left info-item-white">
                        <h3>{{ $item['title'] }} <span>{{ $item['accent'] }}</span></h3>
                        <p>{{ $item['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
