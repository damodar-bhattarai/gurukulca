@if(session('success')||session('error')||session('info'))
@php
    if(session('success')){
        $alert_type = 'success';
    }elseif(session('error')){
        $alert_type = 'error';
    }else{
        $alert_type = 'info';
    }
@endphp

<!--begin::Alert-->
<div class="alert alert-dismissible border bg-light-{{ $alert_type }}  border-{{ $alert_type }} d-flex flex-column flex-sm-row w-100 p-5 mb-10">
    <span class="svg-icon svg-icon-2hx svg-icon-{{ $alert_type }} me-4 mb-5 mb-sm-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"></path>
            <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"></path>
        </svg>
    </span>
    <div class="d-flex flex-column pe-0 pe-sm-10">
        <h5 class="mb-1"> @if(session('success')){{ session('success') }}
            @elseif(session('error')){{ session('error') }}
            @else{{ session('info') }}
            @endif</h5>

    </div>
    <!--end::Content-->
    <!--begin::Close-->
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i class="bi bi-x fs-1 text-{{ $alert_type }}"></i>
    </button>
    <!--end::Close-->
</div>
<!--end::Alert-->
@endif
