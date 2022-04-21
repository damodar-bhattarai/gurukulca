@extends('backend.layouts.backend')
@section('content')
<div class="row justify-content-center">
    @forelse($routines as $date=>$routine)

    <div class="col-12">
        <div class="card card-flush">
            <div class="card-header">
                <h3 class="card-title">
                    Routines of Date &nbsp; <span
                        class="badge badge-info">{{ $date }}</span>

                    &nbsp; <span class="badge badge-primary">{{ $batch->name }}</span>
                </h3>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        class="table table-bordered table-collapse-phone table-row-bordered table-column-bordered">
                        <thead class="">
                            <tr>
                                @for ($i = 1; $i <= $max_order; $i++)
                                    <th>Class {{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routine as $rtn)
                                <tr>
                                    @foreach ($rtn->classes as $class)
                                        <td>
                                            {{ optional($class->teacher)->code_name??'-' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse
</div>
@endsection
