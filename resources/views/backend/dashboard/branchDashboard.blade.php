@extends('backend.layouts.backend')
@push('styles')
    <style>
        .card .card-body{
            padding:1rem 1.5rem !important;
        }
        .card{
            transition: all 0.5s ease-in-out;
        }
        .card:hover{
            box-shadow: 11px 11px 11px #ccc;

        }
        .number-color{
            color: #02AAE9;
        }
        .text-color{
            /* color:#AE1A1F; */
            color:#ED1E26;
        }

    </style>

@endpush
@section('content')

<div class="row mt-3">
    <div class="col-sm-6 col-md-3">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between flex-column">
                <!--begin::Section-->
                <a href="{{ route('backend.customers.index') }}" class="d-flex flex-column my-1">
                    <!--begin::Number-->
                    <span class="fw-bold fs-3x number-color lh-1 text-center ">{{ $totalCustomers }}</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <span class="fw-bold fs-6 text-color text-center ">Total Customers</span>
                    <!--end::Follower-->
                </a>
                <!--end::Section-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <div class="col-sm-6 col-md-3">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <a href="{{ route('backend.orders.index') }}" class="card-body d-flex justify-content-between flex-column">
                <!--begin::Section-->
                <div class="d-flex flex-column my-1">
                    <!--begin::Number-->
                    <span class="fw-bold fs-3x number-color lh-1 text-center">{{ $totalOrders }}</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <span class="fw-bold fs-6 text-color text-center">Total Orders</span>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
            </a>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <div class="col-sm-6 col-md-3">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <a href="{{ route('backend.payments.index') }}" class="card-body d-flex justify-content-between flex-column">
                <!--begin::Section-->
                <div class="d-flex flex-column my-1">
                    <!--begin::Number-->
                    <span class="fw-bold fs-3x number-color lh-1 text-center">{{ $totalPaid }}</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <span class="fw-bold fs-6 text-color text-center">Total Paid</span>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
            </a>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <div class="col-sm-6 col-md-3">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <a href="{{ route('backend.payments') }}" class="card-body d-flex justify-content-between flex-column">
                <!--begin::Section-->
                <div class="d-flex flex-column my-1">
                    <!--begin::Number-->
                    <span class="fw-bold fs-3x number-color lh-1 text-center">{{ $totalUnpaid }}</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <span class="fw-bold fs-6 text-color text-center">Total Unpaid</span>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
            </a>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
</div>
<div class="my-10"></div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Unreplied Comments</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="fw-bolder text-muted ">
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Commented By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unread_comments as $order_id => $cmt)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a class="text-info" href="{{ route('backend.orders.view', $order_id) }}">{{ $order_id }}</a>
                                </td>
                                <td>
                                   {{ $cmt->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('backend.orders.view', $order_id) }}">{{ $cmt->comment }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('backend.user.detail', $cmt->user->id) }}">{{ $cmt->user->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="my-10"></div>
<div id="orders" style="height: 400px;"></div>
<div class="my-10"></div>
<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Recent News</h3>
        <div style="height:300px; overflow-y:auto; overflow-x:auto">
            <ul>
                @foreach($notices as $notice)
                <li class="card my-4">
                    <div class="card-body">
                        <div class="text-left">
                            <span class="badge badge-warning">{{ $notice->type }}</span><strong class="ml-4">{{ $notice->title }}</strong>
                        </div>
                        <div class="text-justify">{!! nl2br($notice->message) !!}</div>
                    </div>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
    <div class="col-md-6">
        <div id="orders-status" style="height: 300px;"></div>
    </div>
</div>


@push('scripts')
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->
<script>


  const orders = new Chartisan({
        el: '#orders',
        url: "@chart('customer_order_chart')",
        loader: {
            color: '#ff00ff',
            size: [30, 30],
            type: 'bar',
            textColor: '#000',
            text: 'Loading Data...',
        },
        hooks: new ChartisanHooks()
                .datasets('line')
                .axis(true)
                .title({
                    textAlign: 'center',
                    left: '50%',
                    text: 'Order for the month '+moment().format('MMMM'),
                })
                .tooltip({
                    trigger:'axis',
                }),
                responsive:true,
                legend:true,
                tooltip:true

  });

  const status = new Chartisan({
        el: '#orders-status',
        url: "@chart('customer_order_status_chart')",
        loader: {
            color: '#ff00ff',
            size: [30, 30],
            type: 'bar',
            textColor: '#000',
            text: 'Loading Data...',
        },
        hooks: new ChartisanHooks()
                .datasets('pie')
                .axis(false)
                .colors(['rgb(0,255,0)','rgb(255,0,0)','rgb(255,255,0)'])
                .title({
                    textAlign: 'center',
                    left: '50%',
                    text: 'Order Status',
                })
                .tooltip({
                    trigger:'item',
                }),
                responsive:true,
                legend:true,

  });
</script>
@endpush

@endsection
