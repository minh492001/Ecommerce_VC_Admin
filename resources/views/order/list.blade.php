@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders List (Total: {{ $TotalOrder }})</h1>
                    </div>
                    @if(Auth::user()->is_admin == 1)
                        <div class="col-sm-6" style="text-align: right">
                            <a href="{{ url('orders/add') }}" class="btn btn-primary">New Orders</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts._message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders List </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Number</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Created Date</th>
                                        @if((Auth::user()->is_admin == 1))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($getOrder as $value)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $value->order_number }}</td>
                                                <td>{{ $value->user_name }}</td>
                                                <td>{{ $value->getUser->email }}</td>
                                                <td>{{ $value->getUser->getCompany->name }}</td>
                                                <td>{{ $value->product_title }}</td>
                                                <td>{{ number_format($value->price, 0, '', '.') }} đ</td>
                                                <td>{{ $value->quantity }}</td>
                                                <td>{{ number_format($value->total, 0, '', '.') }} đ</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('orders/edit/'.$value->id ) }}" class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('orders/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
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
        </section>
    </div>

@endsection

@section('script')

@endsection

