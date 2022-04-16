@extends('backend.layouts.backend')
@section('content')

<div class="m-0 p-0">
    @livewire('backend.create-user',['user_id'=>$user_id])

</div>

@endsection
