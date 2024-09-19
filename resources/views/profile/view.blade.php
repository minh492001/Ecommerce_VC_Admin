@extends('layouts.app')
@section('style')
    <style type="text/css">
        .form-group {
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Profile</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ url('profile/edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts._message')
                        <div class="card card-primary">
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Name : <span style="font-weight: normal">{{ $getUser->name }} </label>
                                </div>

                                <div class="form-group">
                                    <label>Email : <span style="font-weight: normal">{{ $getUser->email }}</span></label>
                                </div>

                                <div class="form-group">
                                    <label>Company Name : <span style="font-weight: normal">{{ $getUser->getCompany->getSingle($getUser->company_id)->name }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Age : <span style="font-weight: normal">{{ $getUser->age }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Gender : <span style="font-weight: normal">{{ $getUser->gender }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Address : <span style="font-weight: normal">{{ $getUser->address }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Job : <span style="font-weight: normal">{{ $getUser->job }}</label>
                                </div>

                                <div class="form-group">
                                    <label>Created Date : <span style="font-weight: normal">{{ date('d-m-Y h:i A', strtotime($getUser->created_at)) }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>
                            <div class="card-body p-0" style="overflow: auto">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order Number</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Created Date</th>
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
                                            <td>{{ $value->product_title }}</td>
                                            <td>{{ number_format($value->price, 0, '', '.') }} đ</td>
                                            <td>{{ $value->quantity }}</td>
                                            <td>{{ number_format($value->total, 0, '', '.') }} đ</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
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

