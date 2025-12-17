@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Terms & Conditions</h1>
            <div class="prose max-w-none">
                {!! setting('terms_conditions', 'Terms and conditions content will be displayed here.') !!}
            </div>
        </div>
    </div>
</div>
@endsection