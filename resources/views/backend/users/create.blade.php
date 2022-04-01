@extends('backend.layouts.backend')
@section('content')
@push('styles')
    <style>
        .form-group{
            margin-bottom: 1rem !important;
        }
    </style>
@endpush

<div class="m-0 p-0">
    @livewire('frontend.branch-registration-form',['hasCaptcha'=>false])
</div>

@endsection
