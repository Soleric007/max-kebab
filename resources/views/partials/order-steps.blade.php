<section class="step-section p-tb-100 bg-black">
    <div class="container">
        <div class="section-title">
            <h2 class="color-white">{{ $heading ?? '3 Easy Steps To Enjoy' }}</h2>
        </div>
        <div class="steps-box">
            <div class="row justify-content-center">
                @foreach ($orderSteps as $index => $step)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="steps-item">
                            <h3>{{ $index + 1 }}. {{ $step['title'] }}</h3>
                            <p>{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
