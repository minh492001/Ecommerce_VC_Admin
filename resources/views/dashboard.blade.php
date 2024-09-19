@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Orders</span>
                                <span class="info-box-number">{{ $TotalOrders }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Members</span>
                                <span class="info-box-number">{{ $TotalUsers }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Sales</h3>
                                    <a href="javascript:void(0);">View Report</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">$18,230.00</span>
                                        <span>Sales Over Time</span>
                                    </p>

                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Customer
                  </span>

                                    <span>
                    <i class="fas fa-square text-gray"></i> Order
                  </span>
                                </div>
                            </div>
                        </div>

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">New Orders</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                        <th>Order Number</th>
                                        @endif
                                        @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                        <th>User</th>
                                        @endif
                                        @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                            <th>Email</th>
                                        @endif
                                        @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                            <th>Company</th>
                                        @endif
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Created Date</th>
                                        @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($getNewOrders as $value)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                            <td>{{ $value->order_number }}</td>
                                            @endif
                                            @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                            <td>{{ $value->user_name }}</td>
                                            @endif
                                            @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                                <td>{{ $value->getUser->email }}</td>
                                            @endif
                                            @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                                <td>{{ $value->getUser->getCompany->name }}</td>
                                            @endif
                                            <td>{{ $value->product_title }}</td>
                                            <td>{{ number_format($value->price, 0, '', '.') }} đ</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td>{{ number_format($value->total, 0, '', '.') }} đ</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                            @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                                            <td>
                                                <a href="{{ url('orders/edit/'.$value->id ) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ url('orders/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if((Auth::user()->is_admin == 1) && (Auth::user()->company_id == 1))
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">New Customers</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Company</th>
                                        <th>Job</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($getNewCustomers as $value)
                                        <tr>
                                            <td>{{ $i++}}.</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->age }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->company_name }}</td>
                                            <td>{{ $value->job }}</td>
                                            <td>
                                                <a href="{{ url('user/edit/'.$value->id ) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ url('user/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection

@section('script')
    <script src="{{ url('public/assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
