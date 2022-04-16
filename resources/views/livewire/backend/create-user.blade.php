<div>
    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">
                @if ($user->id)
                    Updating User {{ $user->id }}
                @else
                    Add New User
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="type">Account Type <span class="text-danger">*</span> <span wire:loading
                                wire:target="user.type" class="text-info ml-3">Please Wait <i
                                    class="fa fa-spin fa-spinner"></i></span></label>
                        <select class="form-control @error('user.type') is-invalid @enderror" wire:model.lazy="user.type"
                            wire:loading.attr="disabled" wire:target="user.type" id="type">
                            <option value=""> - Select Type -</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                        @error('user.type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if ($user->type)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="user.name"
                                class="form-control @error('user.name') is-invalid @enderror">
                            @error('user.name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" wire:model.defer="user.email"
                                class="form-control @error('user.email') is-invalid @enderror">
                            @error('user.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input type="number" wire:model.defer="user.phone"
                                class="form-control @error('user.phone') is-invalid @enderror">
                            @error('user.phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($user->type == 'student')
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="parent_phone">Parent Phone <span class="text-danger">*</span></label>
                                <input type="number" wire:model.defer="user.parent_phone"
                                    class="form-control @error('user.parent_phone') is-invalid @enderror">
                                @error('user.parent_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="batch">Batch <span class="text-danger">*</span></label>
                                <select class="form-control @error('user.batch_id') is-invalid @enderror"
                                    wire:model.defer="user.batch_id" id="batch">
                                    <option value="">- Select Batch -</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                    @endforeach
                                </select>
                                @error('user.batch_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @elseif($user->type == 'teacher')
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="code_name">Code Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="user.code_name"
                                    class="form-control @error('user.code_name') is-invalid @enderror">
                                @error('user.code_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="subject_id">Subject <span class="text-danger">*</span></label>
                                <select class="form-control @error('user.subject_id') is-invalid @enderror"
                                    wire:model.defer="user.subject_id" id="subject_id">
                                    <option value="">- Select Subject -</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('user.subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endif

                <div class="row my-4">
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <input class="form-check-input h-30px w-50px" type="checkbox" value="" wire:model.lazy="change_password" id="changePassword"/>
                            <label class="form-check-label" for="changePassword">
                               Change Password
                            </label>
                        </div>
                        </div>
                        <div class="col-md-8">
                            @if ($change_password)
                                <div class="form-group" id="passwordGroup">
                                    <label for="password">New Password <span class="text-danger">*</span></label>
                                    <input type="password" wire:model.defer="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror" id="password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <button type="submit" wire:loading.attr="disabled" class="btn btn-success btn-sm">Submit
                                <span wire:loading wire:target="save"> <i class="fa fa-spin fa-spinner"></i>
                                </span></button>
                            <button type="button" wire:loading.attr="disabled" wire:click.prevent="cancel"
                                class="btn btn-danger btn-sm">Cancel <span wire:loading wire:target="cancel"> <i
                                        class="fa fa-spin fa-spinner"></i>
                                </span></button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
