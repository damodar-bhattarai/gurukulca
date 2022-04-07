@extends('backend.layouts.backend')
@section('content')

@livewire('backend.user-list',['type'=>$type])

@endsection
