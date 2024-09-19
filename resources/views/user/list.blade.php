@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer List @if(Auth::user()->company_id != 1) ({{ $getCompany->name }}) @endif</h1>
                    </div>
                    @if(Auth::user()->is_admin == 1)
                        <div class="col-sm-6" style="text-align: right">
                            <a href="{{ url('user/add') }}" class="btn btn-primary">New Customer</a>
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
                                <h3 class="card-title">Customer List (Total: {{ $TotalUsers }})</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        @if(Auth::user()->is_admin == 1)
                                            <th>Address</th>
                                        @endif
                                        <th>Company</th>
                                        <th>Job</th>
                                        @if(Auth::user()->is_admin == 1)
                                            <th>Status</th>
                                        @endif
                                        @if(Auth::user()->is_admin == 1)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $i++}}.</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->age }}</td>
                                            <td>{{ $value->gender }}</td>
                                            @if(Auth::user()->is_admin == 1)
                                                <td>{{ $value->address }}</td>
                                            @endif
                                            <td>{{ $value->company_name }}</td>
                                            <td>{{ $value->job }}</td>
                                            @if(Auth::user()->is_admin == 1)
                                                <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            @endif
                                            <td>
                                                @if(Auth::user()->is_admin == 1)
                                                    <a href="{{ url('user/edit/'.$value->id ) }}" class="btn btn-primary">Edit</a>
                                                @endif
                                                @if(Auth::user()->is_admin == 1)
                                                    <a href="{{ url('user/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {{--                                    {!! $getRecord->appends(\Illuminate\Support\Facades\Request::except('page'))->links() !!}--}}
                                </div>
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

