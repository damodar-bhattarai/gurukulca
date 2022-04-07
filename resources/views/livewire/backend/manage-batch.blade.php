<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">
                        @if ($editing)
                            Updating Batch :  <span class="text-info"> {{ $batch->name }} </span>
                        @else
                            Add Batch
                        @endif
                    </h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="batch">Batch <span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="batch.name" class="form-control">
                                @error('batch.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <button
                                    type="submit"
                                    wire:loading.attr="disabled"
                                    wire:target="save"
                                    class="btn btn-sm btn-success"
                                >
                                    Submit <span wire:loading wire:target="save"><i class="fas fa-spin fa-spinner"></i></span>
                                </button>
                                <button
                                    type="button"
                                    wire:loading.attr="disabled"
                                    wire:target="cancel"
                                    wire:click.prevent="cancel"
                                    class="btn btn-sm btn-danger"
                                >
                                    Cancel <span wire:loading wire:target="cancel"><i class="fas fa-spin fa-spinner"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4"></div>

    <div class="row">
        <div class="col-12">
           <div class="card card-flush">
               <div class="card-header">
                   <h3 class="card-title">List of Batch</h3>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table">
                           <thead>
                               <tr>
                                   <th>#</th>
                                   <th>Batch Name</th>
                                   <th>No. of Students</th>
                                   <th>Actions</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach($batches as $bth)
                               <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>{{ $bth->name }}</td>
                                   <td>{{ $bth->students_count }}</td>
                                   <td>
                                       <button
                                            type="button"
                                            class="btn btn-sm btn-info"
                                            wire:loading.attr="disabled"
                                            wire:target="edit({{ $bth->id }})"
                                            wire:click.prevent="edit({{ $bth->id }})"
                                            wire:key="edt{{ $bth->id }}"
                                            >
                                            <span
                                                wire:loading.remove
                                                wire:target="edit({{ $bth->id }})"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span
                                                wire:loading
                                                wire:target="edit({{ $bth->id }})"
                                            >
                                                <i class="fa fa-spin fa-spinner"></i>
                                            </span>
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Do you want to delete?')||event.stopImmediatePropagation()"
                                            wire:loading.attr="disabled"
                                            wire:target="delete({{ $bth->id }})"
                                            wire:click.prevent="delete({{ $bth->id }})"
                                            wire:key="del{{ $bth->id }}"
                                            >
                                            <span
                                                wire:loading.remove
                                                wire:target="delete({{ $bth->id }})"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            <span
                                                wire:loading
                                                wire:target="delete({{ $bth->id }})"
                                            >
                                                <i class="fa fa-spin fa-spinner"></i>
                                            </span>
                                        </button>
                                   </td>
                               </tr>
                               @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>
