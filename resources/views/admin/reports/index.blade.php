@extends('layouts.admin')

@section('title', 'Sales Report')
@section('page_title', 'Sales & Order Report')

@section('content')
    <div class="container-fluid">

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <form action="{{ route('admin.reports.index') }}" method="GET" class="d-flex align-items-center">

                            <label for="filter" class="me-2 fw-medium">
                                Filter Period:
                            </label>

                            <select name="filter" id="filter" class="form-select form-select-sm w-auto me-3 rounded-3"
                                onchange="this.form.submit()">

                                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>
                                    All Time
                                </option>

                                <option value="today" {{ $filter === 'today' ? 'selected' : '' }}>
                                    Today
                                </option>

                                <option value="this_week" {{ $filter === 'this_week' ? 'selected' : '' }}>
                                    This Week
                                </option>

                                <option value="this_month" {{ $filter === 'this_month' ? 'selected' : '' }}>
                                    This Month
                                </option>

                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Summary Cards -->
        <div class="row mb-4">

            <!-- Total Revenue -->
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card shadow-sm border-0 rounded-4 h-100" style="
                    background: linear-gradient(135deg, #eef1e4 0%, #dde3c9 100%);
                    color: #2b321b;
                 ">

                    <div class="card-body d-flex align-items-center py-4">

                        <!-- Icon -->
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-4" style="
                            width: 64px;
                            height: 64px;
                            background-color: #2b321b;
                            color: #ffffff;
                            font-size: 30px;
                         ">

                            <i class="bi bi-currency-dollar"></i>

                        </div>

                        <!-- Content -->
                        <div>

                            <h6 class="text-uppercase fw-semibold mb-1" style="
                                color: #52614a;
                                letter-spacing: 0.5px;
                            ">

                                Total Revenue

                            </h6>

                            <h2 class="mb-0 fw-bold" style="color: #2b321b;">

                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}

                            </h2>

                        </div>

                    </div>

                </div>
            </div>


            <!-- Completed Orders -->
            <div class="col-md-6">

                <div class="card shadow-sm border-0 rounded-4 h-100" style="
                    background: linear-gradient(135deg, #dde3c9 0%, #ccd5ae 100%);
                    color: #2b321b;
                 ">

                    <div class="card-body d-flex align-items-center py-4">

                        <!-- Icon -->
                        <div class="rounded-3 d-flex align-items-center justify-content-center me-4" style="
                            width: 64px;
                            height: 64px;
                            background-color: #2b321b;
                            color: #ffffff;
                            font-size: 30px;
                         ">

                            <i class="bi bi-bag-check-fill"></i>

                        </div>

                        <!-- Content -->
                        <div>

                            <h6 class="text-uppercase fw-semibold mb-1" style="
                                color: #52614a;
                                letter-spacing: 0.5px;
                            ">

                                Completed Orders

                            </h6>

                            <h2 class="mb-0 fw-bold" style="color: #2b321b;">

                                {{ $totalOrders }}

                            </h2>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Charts Row -->
        <div class="row mb-4">

            <!-- Revenue per Product -->
            <div class="col-lg-8 mb-3 mb-lg-0">

                <div class="card shadow-sm border-0 rounded-4 h-100">

                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">

                        <h6 class="fw-bold mb-0" style="color: var(--litebite-primary);">

                            <i class="bi bi-bar-chart-fill me-2" style="color: var(--litebite-accent);">
                            </i>

                            Revenue per Product

                        </h6>

                        <small class="text-muted">
                            Top products by sales revenue
                        </small>

                    </div>

                    <div class="card-body p-4">

                        <canvas id="revenueChart" height="120"></canvas>

                    </div>

                </div>

            </div>


            <!-- Payment Method -->
            <div class="col-lg-4">

                <div class="card shadow-sm border-0 rounded-4 h-100">

                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">

                        <h6 class="fw-bold mb-0" style="color: var(--litebite-primary);">

                            <i class="bi bi-pie-chart-fill me-2" style="color: var(--litebite-accent);">
                            </i>

                            Payment Method

                        </h6>

                        <small class="text-muted">
                            Orders by payment method
                        </small>

                    </div>

                    <div class="card-body p-4 d-flex align-items-center justify-content-center">

                        <canvas id="methodChart" style="max-height: 220px;">
                        </canvas>

                    </div>

                </div>

            </div>

        </div>


        <!-- Data Table -->
        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header bg-white border-bottom py-3">

                <h5 class="mb-0 fw-bold" style="color: var(--litebite-primary);">

                    Paid Orders List

                </h5>

            </div>


            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle" id="reportTable">

                        <thead class="table-light">

                            <tr>

                                <th>Date</th>

                                <th>Customer</th>

                                <th>Product</th>

                                <th>Qty</th>

                                <th>Price (Each)</th>

                                <th>Total Amount</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($orders as $order)

                                {{--
                                Satu Order dapat memiliki banyak OrderItem.
                                Jadi kita harus melakukan loop ke items.
                                --}}

                                @foreach($order->items as $item)

                                                    <tr>

                                                        <!-- Date -->
                                                        <td>
                                                            {{ $order->created_at->format('d M Y, H:i') }}
                                                        </td>


                                                        <!-- Customer -->
                                                        <td>

                                                            <strong>
                                                                {{ $order->customer_name }}
                                                            </strong>

                                                            <br>

                                                            <small class="text-muted">
                                                                {{ $order->phone }}
                                                            </small>

                                                        </td>


                                                        <!-- Product -->
                                                        <td>

                                                            {{ $item->product->name ?? 'Unknown Product' }}

                                                        </td>


                                                        <!-- Quantity -->
                                                        <td>

                                                            {{ $item->quantity }}

                                                        </td>


                                                        <!-- Price -->
                                                        <td>

                                                            Rp
                                                            {{ number_format($item->price, 0, ',', '.') }}

                                                        </td>


                                                        <!-- Total -->
                                                        <td class="fw-bold text-success">

                                                            Rp
                                                            {{ number_format(
                                        $item->price * $item->quantity,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                                        </td>

                                                    </tr>

                                @endforeach

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection


@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>

        $(document).ready(function () {

            /* =====================================================
               DATA TABLE
            ===================================================== */

            $('#reportTable').DataTable({

                "order": [[0, "desc"]],

                "language": {
                    "search": "Search reports:"
                }

            });


            /* =====================================================
               COLOR PALETTE
            ===================================================== */

            const primary = '#2b321b';

            const accent = '#ccd5ae';

            const colors = [
                '#2b321b',
                '#52614a',
                '#7a8c6e',
                '#a4b494',
                '#ccd5ae',
                '#dde3c9',
                '#eef1e4'
            ];

            const methods = {
                qris: '#2b321b',
                bank_transfer: '#7a8c6e',
                ewallet: '#ccd5ae'
            };


            /* =====================================================
               CHART 1
               REVENUE PER PRODUCT
            ===================================================== */

            const revenueLabels =
                @json($revenueByProduct->keys());

            const revenueData =
                @json($revenueByProduct->values());


            new Chart(
                document.getElementById('revenueChart'),
                {

                    type: 'bar',

                    data: {

                        labels: revenueLabels,

                        datasets: [

                            {

                                label: 'Revenue (Rp)',

                                data: revenueData,

                                backgroundColor:
                                    colors.slice(
                                        0,
                                        revenueLabels.length
                                    ),

                                borderRadius: 6,

                                borderSkipped: false

                            }

                        ]

                    },


                    options: {

                        indexAxis: 'y',

                        responsive: true,


                        plugins: {

                            legend: {
                                display: false
                            },


                            tooltip: {

                                callbacks: {

                                    label: function (ctx) {

                                        return ' Rp ' +
                                            ctx.raw.toLocaleString('id-ID');

                                    }

                                }

                            }

                        },


                        scales: {

                            x: {

                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                },


                                ticks: {

                                    callback: function (v) {

                                        return 'Rp ' +
                                            (v / 1000).toFixed(0) +
                                            'k';

                                    },


                                    color: '#6c757d',

                                    font: {
                                        size: 11
                                    }

                                }

                            },


                            y: {

                                grid: {
                                    display: false
                                },


                                ticks: {

                                    color: primary,

                                    font: {
                                        size: 12,
                                        weight: '600'
                                    }

                                }

                            }

                        }

                    }

                }
            );


            /* =====================================================
               CHART 2
               ORDERS BY PAYMENT METHOD
            ===================================================== */

            const methodLabels =
                @json(
                    $ordersByMethod->keys()
                        ->map(
                            fn($k) =>
                            str_replace(
                                '_',
                                ' ',
                                strtoupper($k)
                            )
                        )
                );

            const methodData =
                @json($ordersByMethod->values());


            const methodColors =
                @json($ordersByMethod->keys()->values());


            new Chart(
                document.getElementById('methodChart'),
                {

                    type: 'doughnut',


                    data: {

                        labels: methodLabels,

                        datasets: [

                            {

                                data: methodData,

                                backgroundColor:
                                    methodColors.map(
                                        k =>
                                            methods[k] ??
                                            '#a4b494'
                                    ),

                                borderWidth: 3,

                                borderColor: '#ffffff',

                                hoverOffset: 8

                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        cutout: '65%',


                        plugins: {

                            legend: {

                                position: 'bottom',


                                labels: {

                                    color: primary,

                                    font: {
                                        size: 12,
                                        weight: '600'
                                    },

                                    padding: 16,

                                    usePointStyle: true,

                                    pointStyleWidth: 10

                                }

                            },


                            tooltip: {

                                callbacks: {

                                    label: function (ctx) {

                                        return ' ' +
                                            ctx.label +
                                            ': ' +
                                            ctx.raw +
                                            ' orders';

                                    }

                                }

                            }

                        }

                    }

                }
            );

        });

    </script>

@endsection