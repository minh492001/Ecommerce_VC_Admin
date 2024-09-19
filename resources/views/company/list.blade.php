@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Company List</h1>
                    </div>
                    @if((Auth::user()->is_admin == 1))
                        <div class="col-sm-6" style="text-align: right">
                            <a href="{{ url('company/add') }}" class="btn btn-primary">New Company</a>
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
                                <h3 class="card-title">Company List</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        @if(Auth::user()->is_admin == 1)
                                            <th>Created By</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        @if((Auth::user()->is_admin == 1))
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
                                                <td>{{ $i++ }}.</td>
                                                <td>{{ $value->name }}</td>
                                                @if(Auth::user()->is_admin == 1)
                                                    <td>{{ $value->created_by_name }}</td>
                                                @endif
                                                <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                @if((Auth::user()->is_admin == 1))
                                                <td>
                                                        @if((Auth::user()->company_id == $value->id) || (Auth()->user()->company_id == 1))
                                                            <a href="{{ url('company/edit/'.$value->id ) }}" class="btn btn-primary">Edit</a>
                                                        @endif
                                                        @if(Auth::user()->is_admin == 1 && (Auth::user()->company_id == 1))
                                                            <a href="{{ url('company/delete/'.$value->id ) }}" class="btn btn-danger">Delete</a>
                                                        @endif
                                                    </td>
                                                @endif
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

