<div>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">
                        @if ($editing)
                            Update Routine &nbsp;<span class="badge badge-primary">{{ $routine->batch->name }} </span>
                        @else
                            Add Routine
                        @endif
                    </h3>

                    <div class="card-toolbar">
                        <a href="{{ route('backend.routines.index') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i> Routine List
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="routine_date">Routine Date <span class="text-danger">*</span> </label>
                                <input @if ($editing) disabled @endif type="date"
                                    min="{{ Date('Y-m-d') }}" class="form-control" wire:loading.attr="disabled"
                                    wire:model.lazy="routine.routine_date" id="routine_date" placeholder="Routine Date"
                                    required>
                            </div>
                            @if ($routine->routine_date)
                                <div class="col-md-6">
                                    <label for="batch_id">Batch <span class="text-danger">*</span> <span wire:loading
                                            wire:target="routine.batch_id" class="text-info">Please Wait <i
                                                class="fa fa-spin fa-spinner"></i></span> </label>
                                    <select @if ($editing) disabled @endif class="form-control"
                                        wire:loading.attr="disabled" id="batch_id" wire:model="routine.batch_id"
                                        required>
                                        <option value="">Select Batch</option>
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('routine.batch_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                        @if ($routine->routine_date && $routine->batch_id)
                            @foreach ($errors->all() as $err)
                                <div class="alert alert-danger">
                                    {{ $err }}
                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Classes <span wire:loading wire:target="addClass"
                                                    class="text-info">Please Wait <i
                                                        class="fa fa-spin fa-spinner"></i> </span> </h3>
                                            {{-- <div class="card-toolbar">
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    wire:click.prevent="addClass"> <i class="fa fa-plus-circle"></i> Add
                                                    More </button>
                                            </div> --}}
                                        </div>
                                        <div class="card-body row">
                                            @foreach ($classes as $index => $class)
                                                <div class="col-md-6 mb-3">
                                                    <label for="class{{ $loop->iteration }}">Class
                                                        {{ $loop->iteration }}</label>
                                                    <select class="form-control" wire:loading.attr="disabled"
                                                        id="class{{ $loop->iteration }}"
                                                        wire:model.defer="classes.{{ $index }}.teacher_id">
                                                        <option value="">Select Teacher</option>
                                                        @foreach ($teachers as $teacher)
                                                            <option value="{{ $teacher->id }}">
                                                                {{ $teacher->code_name }} ({{ $teacher->name }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <div class="col-2 mb-3 row align-items-end">
                                                    <div class="col">
                                                        <button type="button" wire:loading.attr="disabled"
                                                            wire:target="removeClass"
                                                            wire:click.prevent="removeClass({{ $index }})"
                                                            class="btn btn-sm btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    </div>
                                                </div> --}}
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    <button type="button" wire:click.prevent="resetForm"
                                        class="btn btn-sm btn-danger">Cancel</button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="my-4"></div>
    @if ($routine->routine_date)
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-flush">
                    <div class="card-header">
                        <h3 class="card-title">
                            Routines of Date &nbsp; <span
                                class="badge badge-info">{{ $routine->routine_date }}</span>
                        </h3>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-collapse-phone table-row-bordered table-column-bordered">
                                <thead class="">
                                    <tr>
                                        <th>Batch</th>
                                        @for ($i = 1; $i <= $max_order; $i++)
                                            <th>Class {{ $i }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routines as $rtn)
                                        <tr>
                                            <td>
                                                <ul>
                                                    <li><span
                                                            class="badge badge-primary">{{ optional($rtn->batch)->name }}</span>
                                                    </li>
                                                </ul>
                                            </td>
                                            @foreach ($rtn->classes as $class)
                                                <td>
                                                    <ul>
                                                        @if ($class->subject && $class->teacher)
                                                            <li>{{ optional($class->subject)->name }}</li>
                                                            <li>{{ optional($class->teacher)->name }}</li>
                                                        @else
                                                            <li class="text-center">-</li>
                                                        @endif
                                                    </ul>
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
        </div>
    @endif
</div>
