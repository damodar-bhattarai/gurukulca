<div>
    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">
                Routines &nbsp; &nbsp; <span wire:loading><i class="fa fa-spin fa-spinner"></i></span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('backend.routines.save') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-circle"></i> Add New
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-toolbar py-3" style="background-color: rgba(245, 245, 244,0.1)">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" placeholder="Filter by Date" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}"  class="form-control form-control-lg" wire:loading.attr="disabled" wire:model.lazy="routine_date">
                    </div>
                    <div class="col-md-3">
                        <select wire:model.lazy="batch" wire:loading.attr="disabled" class="form-control">
                            <option value="">All Batches</option>
                            @foreach ($batches as $bth)
                                <option value="{{ $bth->id }}">{{ $bth->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.lazy="teacher" wire:loading.attr="disabled" class="form-control">
                            <option value="">All Teachers</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="my-4"></div>
            <div class="table-responsive">
                <table class="table table-bordered table-collapse-phone table-row-bordered table-column-bordered">
                    <thead class="">
                        <tr>
                            <th>Date</th>
                            @for ($i = 1; $i <= $max_order; $i++)
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

                                @for ($i = 1; $i <= $max_order; $i++)
                                @php
                                    $cls=$rtn->classes->where('order', $i)->first();
                                @endphp
                                    <td>
                                        <ul>
                                            @if($cls && $cls->subject && $cls->teacher)
                                                <li>{{ $cls->subject->name }}</li>
                                                <li>{{ $cls->teacher->name }}</li>
                                            @else
                                                <li class="text-center">-</li>
                                            @endif

                                        </ul>
                                    </td>
                                @endfor

                                @role('admin')
                                    <td>
                                        <a title="Edit Routine" href="{{ route('backend.routines.save', $rtn->id) }}"
                                            class="p-2"><i class="text-info fa fa-edit"></i></a>
                                        <button title="Delete Routine"
                                            onclick="return confirm('Do you want to delete this routine?')||event.stopImmediatePropagation()"
                                            wire:click.prevent="delete({{ $rtn->id }})" class="text-danger p-2"><i
                                                class="text-danger fa fa-trash"></i></button>
                                    </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="{{ $max_order + 2 }}">
                                {{ $routines->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
