@extends('backend.layouts.backend')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editing User @role('admin') ID: {{ $user->id }} @endrole</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('backend.user.update',$user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="district">District</label>
                       <select name="district" class="form-control form-control-sm" id="district">
                        <option value="">- Choose One -</option>
                        @foreach (districtInfo() as $district)
                            <option @if($user->address->district==$district) selected @endif value="{{ $district }}">{{ $district }}</option>
                        @endforeach
                       </select>
                        @error('district') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" value="{{ $user->address->city }}">
                        @error('city') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="street">Street</label>
                        <input type="text" name="street" class="form-control" value="{{ $user->address->street }}">
                        @error('street') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-2">
                        <button type="submit" class="btn btn-info">Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#district').select2();
    });
</script>
@endpush
