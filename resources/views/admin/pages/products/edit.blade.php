@php
    $pageHeading = 'Edit Product';
@endphp

@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
    @include('admin.partials.product-form', ['product' => $product])
@endsection
