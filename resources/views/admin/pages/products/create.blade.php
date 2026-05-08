@php
    $pageHeading = 'Create Product';
@endphp

@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
    @include('admin.partials.product-form')
@endsection
