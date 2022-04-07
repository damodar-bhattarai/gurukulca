<div>
    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">
                Routines
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('backend.routines.save') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-circle"></i> Add New
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-collapse-phone table-row-bordered ">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Batch</th>
                            <th>Class</th>
                           @role('admin') <th>Actions</th> @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routines as $routine)
                            @if($routine->classes->count()==0) @continue @endif
                            <tr>
                                <td>{{ $routine->routine_date }}</td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ $routine->batch->name }}
                                    </span>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($routine->classes as $class)
                                            <li>
                                                <strong class="text-info">#Class {{ $class->order }} </strong> &nbsp; &nbsp; <strong>{{ $class->subject->name }}</strong> by <strong>{{ $class->teacher->name }}</strong>
                                                [{{ $class->teacher->code_name }}]
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                @role('admin')
                                <td>
                                    <a href="{{ route('backend.routines.save',$routine->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <button onclick="return confirm('Do you want to delete this routine?')||event.stopImmediatePropagation()" wire:click.prevent="delete({{ $routine->id }})" class="btn btn-sm btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
