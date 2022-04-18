@extends('backend.layouts.backend')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
           <h3 class="card-title"> Change Password</h3>
        </div>
        <div class="card-body">
            <strong class="text-primary">Password should be at least 8 characters with min 1 number, 1 symbol, 1 uppercase</strong> <div class="mb-2"></div>
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @elseif(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
           <form action="{{ route('backend.user.password.update') }}" method="POST">
            @csrf
            @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $error }} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endforeach
            @endif
            <div class="mb-2">
                <label for="previous_password">Previous Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="previous_password" name="previous_password" placeholder="Enter your previous password" required>
                @error('previous_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>
               <div class="mb-2">
                <label for="new_password">New Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password" required>
                @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>
               <div class="mb-2">
                <label for="new_password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm new password" required>
                @error('new_password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               </div>
               <div class="mb-2">
                   <button type="submit" class="btn btn-info">Change Password</button>
               </div>
           </form>
        </div>
    </div>
</div>
@endsection
