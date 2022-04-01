@extends('backend.layouts.backend')
@push('styles')
    <style>
        .card .card-body {
            padding: 1rem 1.5rem !important;
        }

        .card {
            transition: all 0.5s ease-in-out;
        }

        .card:hover {
            box-shadow: 11px 11px 11px #ccc;

        }

        .number-color {
            color: #02AAE9;
        }

        .text-color {
            /* color:#AE1A1F; */
            color: #ED1E26;
        }

    </style>
@endpush
@section('content')
    <span class="text-danger">Receivable & Payable amounts are shown/calculated only after order gets delivered.</span>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-5">
            <!--begin::Card widget 2-->
            <div class="card h-lg-100">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-row my-1" href="{{ route('backend.payments.index') }}">
                        <span class="mx-3 fw-bold fs-6 text-color text-center">Pending Receivable COD</span>
                        <span style="font-size: 1.5rem;"
                            class="mx-3 fw-bold number-color lh-1 text-center">Nrs.{{ $receivable['cod'] }}</span>
                    </a>
                    <a class="d-flex flex-row my-1" href="{{ route('backend.payments.index') }}">
                        <span class="mx-3 fw-bold fs-6 text-color text-center">Pending Payable Delivery Charge</span>
                        <span style="font-size: 1.5rem;"
                            class="mx-3 fw-bold number-color lh-1 text-center">Nrs.{{ $receivable['charge'] }}</span>
                    </a>
                    <a class="d-flex flex-row my-1" href="{{ route('backend.payments.index') }}">
                        <span class="mx-3 fw-bold fs-6 text-color text-center">Net Receivable/Payable Amount</span>
                        <span style="font-size: 1.5rem;"
                            class="mx-3 fw-bold number-color lh-1 text-center">Nrs.{{ $receivable['total'] }}</span>
                    </a>
                    <!--end::Section-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card widget 2-->
        </div>
        <div class="col-sm-6 col-md-7">
            <!--begin::Card widget 2-->
            <div class="card h-lg-100">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-row my-1" href="{{ route('backend.payments.index') }}">
                        <span class="mx-3 fw-bold fs-6 text-color text-center">Last Payment Received Date</span>
                        <span class="mx-3 fw-bold fs-2x number-color lh-1 text-center">{{ $last_payment_date }}</span>
                    </a>
                    <!--end::Section-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card widget 2-->
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3">
            <!--begin::Card widget 2-->
            <div class="card h-lg-100">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index') }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">{{ $orders }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Orders</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index', ['type' => 'delivered']) }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">{{ $delivered }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Orders Delivered</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index', ['type' => 'returned']) }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">{{ $returned }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Returned Orders</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index', ['type' => 'pending']) }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">{{ $pending }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Orders in Delivery Process </span>
                        <!--end::Follower-->
                    </a>
                    <!--end::Section-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card widget 2-->
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3">
            <!--begin::Card widget 2-->
            <div class="card h-lg-100">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index') }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">Nrs.{{ $ordersValue }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Total Order Value</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index', ['type' => 'delivered']) }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">Nrs.{{ $deliveredValue }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Delivered Value</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index', ['type' => 'returned']) }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">Nrs.{{ $returnedValue }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Returned Value</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index', ['type' => 'pending']) }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">{{ 'Nrs.' . $pendingValue }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Pending Value </span>
                        <!--end::Follower-->
                    </a>
                    <!--end::Section-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card widget 2-->
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3">
            <!--begin::Card widget 2-->
            <div class="card h-lg-100">
                <!--begin::Body-->
                <div class="card-body d-flex justify-content-center flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index') }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center"
                            style="font-size:25px !important;">{{ $lastOrder ? $lastOrder->created_at->format('d M Y') : 'N/A' }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Last Order Date</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index') }}">
                        <!--begin::Number-->
                        <span
                            class="fw-bold fs-2x number-color lh-1 text-center">{{ $lastOrder ? 'Nrs.' . $lastOrder->cod : 'N/A' }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Last COD Amount</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.orders.index') }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">Nrs.{{ $total_delivery_charge }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Total Delivery Charge</span>
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
                <div class="card-body d-flex justify-content-between flex-column">
                    <!--begin::Section-->
                    <a class="d-flex flex-column my-1" href="{{ route('backend.payments.index') }}">
                        <!--begin::Number-->
                        <span class="fw-bold fs-2x number-color lh-1 text-center">Nrs.{{ $total_payments }}</span>
                        <!--end::Number-->
                        <!--begin::Follower-->
                        <span class="fw-bold fs-6 text-color text-center">Total Payments Received</span>
                        <!--end::Follower-->
                    </a>
                    <!--end::Section-->
                </div>
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
                    @foreach ($notices as $notice)
                        <li class="card my-4">
                            <div class="card-body">
                                <div class="text-left">
                                    <span class="badge badge-warning">{{ $notice->type }}</span><strong
                                        class="ml-4">{{ $notice->title }}</strong>
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
                        text: 'Order for the month ' + moment().format('MMMM'),
                    })
                    .tooltip({
                        trigger: 'axis',
                    }),
                responsive: true,
                legend: true,
                tooltip: true

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
                    .colors(['rgb(0,255,0)', 'rgb(255,0,0)', 'rgb(255,255,0)'])
                    .title({
                        textAlign: 'center',
                        left: '50%',
                        text: 'Order Status',
                    })
                    .tooltip({
                        trigger: 'item',
                    }),
                responsive: true,
                legend: true,

            });
        </script>
    @endpush
@endsection
