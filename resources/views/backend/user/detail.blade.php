@extends('backend.layouts.backend')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Personal Details</h3>
                        </div>
                        <div class="card-body">
                            Name: {{ $user->name }}<br>
                            Email: {{ $user->email }}<br>
                            Phone: {{ $user->phone }}<br>
                            District: {{ optional($user->address)->district }}<br>
                            City: {{ optional($user->address)->city }}<br>
                            Street: {{ optional($user->address)->street }}<br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pending Payments</h3>
                        </div>
                        <div class="card-body">
                            @livewire('backend.individual-pay',['customer_id'=>$user->id,'payment'=>$payments])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Orders</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Receiver Details</th>
                            <th>Package Info</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a class="font-weight-bold text-info" href="{{ route('backend.orders.view',$order->id) }}"> {{$order->id }} </a></td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge @if($order->delivered==1) badge-success @elseif($order->returned==1) badge-danger @else badge-info @endif }}">
                                        {{ $order->latest_status }}
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <i class="text-info fas fa-user"></i> {{ $order->receiver_name }} <br>
                                        <i class="text-info fas fa-envelope"></i> {{ $order->receiver_email }} <br>
                                        <i class="text-info fas fa-phone"></i> {{ $order->receiver_phone }} <br>
                                        <i class="text-info fas fa-map-marker"></i> {{ $order->receiver_address }} <br>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i class="text-info fas fa-box">  </i> {{ $order->product_name }} <br>
                                        <span class="text-info" style="font-weight: bold;">COD:</span> Nrs. {{ $order->cod }} <br>
                                        <span class="text-info" style="font-weight: bold;">Charge:</span>Nrs. {{ $order->delivery_charge }} <br>
                                        <span class="badge badge-primary">
                                            {{$order->delivery_instruction }}
                                        </span>
                                        <span class="badge badge-primary">
                                            {{ $order->package_type }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="button-group">
                                        <a type="button" title="View Order" href="{{ route('backend.orders.view',$order->id) }}"><i class="text-info fas fa-2x fa-eye"></i></a>
                                        <a target="blanc" title="Print Order" href="{{ route('backend.orders.print',$order->id) }}" ><i class="text-primary fas fa-2x fa-print"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
