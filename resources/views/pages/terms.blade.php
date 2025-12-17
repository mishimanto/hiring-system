@extends('layouts.app')

@section('title', $meta_title)
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Terms & Conditions</h1>
                </div>
                <div class="card-body">
                    <div class="terms-content">
                        {!! $content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .terms-content h1, 
    .terms-content h2, 
    .terms-content h3, 
    .terms-content h4 {
        color: #2c3e50;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    .terms-content p {
        line-height: 1.8;
        margin-bottom: 1rem;
        color: #555;
    }
    .terms-content ul, 
    .terms-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .terms-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endpush