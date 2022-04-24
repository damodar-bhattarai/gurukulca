<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Generate Report</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="preview">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="from_date">From Date</label>
                                <input type="date" max="{{ Carbon\Carbon::now()->subDay()->format('Y-m-d') }}"
                                    class="form-control" wire:model.defer="from_date" id="from_date" name="from_date">
                                @error('from_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="to_date">To Date</label>
                                <input type="date" class="form-control"
                                    max="{{ Carbon\Carbon::now()->subDay()->format('Y-m-d') }}"
                                    wire:model.defer="to_date" id="to_date" name="to_date">
                                @error('to_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="batch">Batch</label>
                                <select class="form-control" id="batch" wire:model.defer="batch">
                                    <option value="">All</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                    @endforeach
                                </select>
                                @error('batch')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="class">Teacher</label>
                                <select class="form-control" id="teacher" wire:model.defer="teacher">
                                    <option value="">All</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->code_name }}[{{ $teacher->name }}] </option>
                                    @endforeach
                                </select>
                                @error('teacher')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="submit" wire:loading.attr="disabled" class="btn btn-info">Preview
                                    Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($showReport)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Routine Preview
                        </h3>
                        <div class="card-toolbar">
                            <button type="button" wire:click.prevent="download" wire:loading.attr="disabled" class="btn btn-success">Download
                                Report</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('exports.reports')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
