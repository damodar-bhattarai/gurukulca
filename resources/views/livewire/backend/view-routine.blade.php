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
                <table class="table table-bordered table-collapse-phone table-row-bordered table-column-bordered">
                    <thead class="">
                        <tr>
                            <th>Date</th>
                            @for($i=1;$i<=$max_order;$i++)
                                <th>Class {{ $i }}</th>
                            @endfor
                            @role('admin')
                                <th>Actions</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routines as $rtn)
                            <tr>
                                <td>
                                    <ul>
                                        <li>{{ $rtn->routine_date }}</li>
                                        <li><span class="badge badge-primary">{{ optional($rtn->batch)->name }}</span>
                                        </li>
                                    </ul>
                                </td>
                                @foreach ($rtn->classes as $class)
                                    <td>
                                        <ul>
                                            @if ($class->subject && $class->teacher)
                                                <li>{{ optional($class->subject)->name }}</li>
                                                <li>({{ optional($class->teacher)->name }})</li>
                                            @else
                                                <li class="text-center">-</li>
                                            @endif
                                        </ul>
                                    </td>
                                @endforeach
                                @role('admin')
                                <td>
                                    <a title="Edit Routine" href="{{ route('backend.routines.save',$rtn->id) }}" class="p-2"><i class="text-info fa fa-edit"></i></a>
                                    <button title="Delete Routine" onclick="return confirm('Do you want to delete this routine?')||event.stopImmediatePropagation()" wire:click.prevent="delete({{ $rtn->id }})" class="text-danger p-2"><i class="text-danger fa fa-trash"></i></button>
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
