@extends('backend.layouts.backend')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Bulk Student Upload
                    </h3>
                    <div class="card-toolbar">
                        <a class="badge badge-info text-light" href="{{ asset('static_files/demo-import.xlsx') }}"
                            download="demo.xlsx" title="Demo File">Download Demo File</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('backend.alert')

                    @if (count($errors) > 0)
                        <!--begin::Alert-->
                        <div
                            class="alert alert-dismissible border bg-light-danger  border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                        fill="black"></path>
                                    <path
                                        d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                    @foreach ($errors->all() as $error)
                                    <h5 class="mb-1">{{ $error }}</h5> <br>
                                    @endforeach
                                </div>

                            <!--end::Content-->
                            <!--begin::Close-->
                            <button type="button"
                                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                data-bs-dismiss="alert">
                                <i class="bi bi-x fs-1 text-danger"></i>
                            </button>
                            <!--end::Close-->
                        </div>
                        <!--end::Alert-->
                    @endif

                    <form action="{{ route('backend.user.students.bulk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">File</label>
                            <input type="file" name="file" class="form-control py-2">
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-sm btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
