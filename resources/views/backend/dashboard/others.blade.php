@extends('backend.layouts.backend')
@section('content')
<style>
    .table thead tr th{
        font-size: 12px;
        font-weight: 600;
    }
</style>
    <div class="row">
        @forelse($routines as $date=>$routine)
        <div class="col-md-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            Routine for {{ $date }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-collapse-phone table-row-bordered ">
                                <thead>
                                    <tr>
                                        @role('teacher')
                                        <th>
                                            Batch
                                        </th>
                                        @endrole
                                        <th>
                                            Class
                                        </th>
                                        <th>
                                            Subject / Teacher
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routine as $rtn)
                                        @foreach ($rtn->classes as $class)
                                            <tr>
                                                @role('teacher')
                                                <td>
                                                    {{ $rtn->batch->name }}
                                                </td>
                                                @endrole
                                                <td>
                                                    Class {{ $class->order }}
                                                </td>
                                                <td>
                                                    {{ $class->subject->name }} [{{ $class->teacher->name }}]
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                No Routines Found
            @endforelse
    </div>
@endsection
