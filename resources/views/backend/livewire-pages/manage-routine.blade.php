@extends('backend.layouts.backend')
@section('content')

<div class="m-0 p-0">
    @livewire('backend.manage-routine',['routine_id'=>$routine_id])
</div>

@endsection
