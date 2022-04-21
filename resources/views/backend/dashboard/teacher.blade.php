@extends('backend.layouts.backend')
@section('content')
    <style>
        .table thead tr th {
            font-size: 12px;
            font-weight: 600;
        }

    </style>
    <div class="row justify-content-center">
        @forelse($allClasses as $cls_date=>$classes)
        <div class="col-md-8">
            <div class="shadow-hover">
                <div class="card my-4 ">
                    <div class="card-header" style="background-color:cornflowerblue;">
                        <h3 class="card-title mx-auto font-weight-bold text-light">
                            Routine for {{ $cls_date }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-collapse-phone table-row-bordered ">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 1; $i <= 6; $i++)

                                    <tr>
                                        <td>
                                            Class {{ $i }}
                                        </td>
                                            <td>
                                                @if (!empty($classes[$i]))
                                                    <span class="badge badge-info"> {{ $classes[$i] }}</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        @endfor

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h1 class="text-danger">No Classes</h1>
        @endforelse


    </div>
@endsection
