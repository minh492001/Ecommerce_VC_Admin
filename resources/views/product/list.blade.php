@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product List</h1>
                    </div>
                    @if(Auth::user()->is_admin == 1)
                        <div class="col-sm-6" style="text-align: right">
                            <a href="{{ url('product/add') }}" class="btn btn-primary">New Product</a>
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
                                <h3 class="card-title">Product List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        @if(Auth::user()->is_admin == 1)
                                            <th>Created By</th>
                                        @endif
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
                                        <tr>

                                            @foreach($getRecord as $value)
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ number_format($value->price, 0, '', '.') }} đ</td>
                                                <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            @if(Auth::user()->is_admin == 1)
                                                    <td>{{ $value->created_by_name }}</td>
                                                @endif
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    @if(Auth::user()->is_admin == 1)
                                                        <a href="{{ url('product/edit/'.$value->id ) }}" class="btn btn-primary">Edit</a>
                                                    @endif
                                                    @if(Auth::user()->is_admin == 1 && (Auth::user()->company_id == 1))
                                                        <a href="{{ url('product/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
                                                    @endif
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

