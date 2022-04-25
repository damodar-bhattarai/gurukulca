<div>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title">{{ ucfirst($type??'User') }} List</h3>
           <div class="card-toolbar">
               <a href="{{ route('backend.user.create') }}" class="btn btn-sm btn-info"> <i class="fas fa-plus-circle"></i> Create New User</a>
           </div>
       </div>
       <div class="card-body">
           <div class="card-toolbar">
               <div class="row">
                   <div class="col-md-4">
                       <input type="search" placeholder="Search" wire:model.debounce.500ms="search" class="form-control">
                   </div>
                   <div class="col">
                       <span wire:loading>Searching <i class="fa fa-spin fa-spinner"></i></span>
                   </div>
               </div>
           </div>
           <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover livewire-table">
                     <thead>
                          <tr>
                              <th wire:click.prevent="sort('id')">ID  @if($sort_by=="id") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif  </th>
                            @if($type=='student')
                                <th wire:click.prevent="sort('batch')">Batch @if($sort_by=="batch") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif  </th>
                             @endif
                            @if($type=='teacher')
                                <th wire:click.prevent="sort('subject')">Subject @if($sort_by=="subject") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif   </th>
                                <th wire:click.prevent="sort('code_name')">Code Name @if($sort_by=="code_name") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif  </th>
                             @endif
                            <th wire:click.prevent="sort('name')">Name @if($sort_by=="name") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif  </th>
                            <th wire:click.prevent="sort('email')">Email @if($sort_by=="email") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif  </th>
                            <th wire:click.prevent="sort('phone')">Phone @if($sort_by=="phone") @if($sort_order=='asc') <i class="fas fa-arrow-up"></i>  @elseif($sort_order=='desc') <i class="fas fa-arrow-down"></i> @endif @else  <i class="fas fa-arrow-up"></i>  <i class="fas fa-arrow-down"></i> @endif  </th>
                            <th>Actions</th>
                          </tr>
                     </thead>
                     <tbody>
                          @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                @if($type=='student')
                                    <td>{{ $user->batch->name ?? '' }}</td>
                                @endif
                                @if($type=='teacher')
                                    <td>{{ $user->subject->name ?? '' }}</td>
                                    <td>{{ $user->code_name ?? '' }}</td>
                                @endif
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <ul>
                                        <li>{{ $user->phone }}</li>
                                        <li>{{ $user->parent_phone }}</li>
                                    </ul>
                                </td>
                                <td>

@if($user->type=='admin' && (auth()->id()==$user->id || auth()->id()==1))
                                    <a href="{{ route('backend.user.edit',$user->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
@else
<a href="{{ route('backend.user.edit',$user->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
@endif
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')||event.stopImmediatePropagation()"
                                        wire:click.prevent="deleteUser({{ $user->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="deleteUser({{ $user->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                     </tbody>
                     <tfoot>
                         <tr>
                             <td colspan="8">{{ $users->links() }}</td>
                         </tr>
                     </tfoot>
                </table>
           </div>
       </div>
   </div>
</div>
