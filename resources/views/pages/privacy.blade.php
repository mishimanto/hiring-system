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
                    <h1 class="h4 mb-0">Privacy Policy</h1>
                </div>
                <div class="card-body">
                    <div class="privacy-content">
                        No more today
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .privacy-content h1, 
    .privacy-content h2, 
    .privacy-content h3, 
    .privacy-content h4 {
        color: #2c3e50;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }
    .privacy-content p {
        line-height: 1.8;
        margin-bottom: 1rem;
        color: #555;
    }
    .privacy-content ul, 
    .privacy-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .privacy-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endpush