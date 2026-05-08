@php
    $pageHeading = 'Edit Category';
@endphp

@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
    @include('admin.partials.category-form', ['category' => $category])
@endsection
