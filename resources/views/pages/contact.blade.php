@php
    $title = 'Contact Us | Max Kebab';
    $description = 'Visit, call, or send a message to Max Kebab at 53 Harborough Rd, Kingsthorpe, Northampton NN2 7SH.';
@endphp

@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'pageTitle' => 'Contact Us',
        'pageSubtitle' => 'Visit the shop, place an order, or ask us a question',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us'],
        ],
    ])

    <div class="contact-us-section pt-100 pb-70 bg-black">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">Visit The Shop</h3>
                        </div>
                        <div class="contact-item-info">
                            <div class="contact-info-list">
                                <h3>Address</h3>
                                <p>{{ $brand['address'] }}</p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Service</h3>
                                <p>{{ $brand['service_modes'] }}</p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Directions</h3>
                                <p><a href="{{ $brand['map_url'] }}" target="_blank" rel="noopener">Open in Google Maps</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">Call Us</h3>
                        </div>
                        <div class="contact-item-info">
                            <div class="contact-info-list">
                                <h3>Phone</h3>
                                <p><a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}">{{ $brand['phone_display'] }}</a></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Best For</h3>
                                <p>Orders, delivery checks, collections, and quick questions</p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Hours</h3>
                                <p>{{ $brand['hours_note'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">What To Expect</h3>
                        </div>
                        <div class="contact-item-info">
                            @foreach ($brand['highlights'] as $highlight)
                                <div class="contact-info-list">
                                    <h3>{{ $loop->iteration }}.</h3>
                                    <p>{{ $highlight }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-8 order-5 order-lg-0 pb-30">
                    <div class="comment-area">
                        <div class="sub-section-title">
                            <h3 class="color-white">Leave A Message</h3>
                            <p>We will get back to you as soon as we can.</p>
                        </div>
                        <div class="comment-form mt-30">
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" placeholder="Name*" value="{{ old('name') }}" required>
                                            </div>
                                            @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email*" value="{{ old('email') }}" required>
                                            </div>
                                            @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="phone" class="form-control" placeholder="Phone*" value="{{ old('phone') }}" required>
                                            </div>
                                            @error('phone')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <input type="text" name="subject" class="form-control" placeholder="Subject*" value="{{ old('subject') }}" required>
                                            </div>
                                            @error('subject')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group mb-20">
                                            <div class="input-group">
                                                <textarea name="message" class="form-control" rows="8" placeholder="Your Message*">{{ old('message') }}</textarea>
                                            </div>
                                            @error('message')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <div class="form-check agree-label">
                                                <input name="terms" class="form-check-input" type="checkbox" id="contactTerms" value="1" required>
                                                <label class="form-check-label" for="contactTerms">
                                                    I understand this form is for enquiries, delivery questions, and order arrangements.
                                                </label>
                                            </div>
                                            @error('terms')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <button class="btn full-width" type="submit">
                                            Send A Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 order-4 order-lg-0 pb-30">
                    <div class="contact-item">
                        <div class="contact-item-title text-center">
                            <h3 class="color-white">Shop Details</h3>
                        </div>
                        <div class="contact-item-info">
                            <div class="contact-info-list">
                                <h3>Address</h3>
                                <p>{{ $brand['address'] }}</p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Phone</h3>
                                <p><a href="tel:{{ preg_replace('/\s+/', '', $brand['phone']) }}">{{ $brand['phone_display'] }}</a></p>
                            </div>
                            <div class="contact-info-list">
                                <h3>Order Type</h3>
                                <p>{{ $brand['service_modes'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="map-section p-tb-100 bg-black">
        <div class="container">
            <div class="google-map-content">
                <iframe src="https://www.google.com/maps?q=53%20Harborough%20Rd,%20Kingsthorpe,%20Northampton%20NN2%207SH,%20United%20Kingdom&output=embed" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
@endsection
