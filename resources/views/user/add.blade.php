@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Customer</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="name" required value="{{ old('name') }}" name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control" id="email" required value="{{ old('email') }}" name="email" placeholder="Enter Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span style="color: red">*</span></label>
                                        <input type="password" class="form-control" id="password" required name="password" placeholder="Enter Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age <span style="color: red">*</span></label>
                                        <input type="number" min="18" max="70" class="form-control" id="age" required value="{{ old('age') }}" name="age" placeholder="Enter Age">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender <span style="color: red">*</span></label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="address" required value="{{ old('address') }}" name="address" placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_id">Company <span style="color: red">*</span></label>
                                        <select class="form-control" id="company_id" name="company_id" >
                                            @if(Auth::user()->company_id != 1)
                                                <option value="">Select</option>
                                                <option value="{{ $getCompany->id }}">{{ $getCompany->name }}</option>
                                            @else
                                                <option value="">Select</option>
                                                @foreach($getCompany as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="job">Job <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="job" required value="{{ old('job') }}" name="job" placeholder="Enter Job">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status <span style="color: red">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection

@section('script')

@endsection

