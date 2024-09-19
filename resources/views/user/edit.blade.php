@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit User</h1>
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
                                        <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" id="name" required name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" id="email" required name="email" placeholder="Enter Email">
                                        <div style="color:red">{{ $errors->first('email') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span style="color: red">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        <p>Change Password if it's necessary</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age <span style="color: red">*</span></label>
                                        <input type="number" min="18" max="70" class="form-control" id="age" required value="{{ old('age', $getRecord->age) }}" name="age" placeholder="Enter Age">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender <span style="color: red">*</span></label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="{{ old('gender', $getRecord->gender) }}">{{ $getRecord->gender }}</option>
                                            @if(strtolower($getRecord->gender) == 'male')
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            @elseif(strtolower($getRecord->gender) == 'female')
                                                <option value="Male">Male</option>
                                                <option value="Other">Other</option>
                                            @else
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="address" required value="{{ old('address', $getRecord->address) }}" name="address" placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_id">Company <span style="color: red">*</span></label>
                                        <select class="form-control" id="company_id" name="company_id" >
                                            @if(Auth::user()->company_id != 1)
                                                <option value="{{ $getCompany->id }}">{{ $getCompany->name }}</option>
                                            @else
                                                @foreach($getCompany as $value)
                                                    <option {{ ($value->id == $getRecord->company_id) ? 'selected' : "" }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="job">Job <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="job" required value="{{ old('job', $getRecord->job) }}" name="job" placeholder="Enter Job">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_admin">Role <span style="color: red">*</span></label>
                                        <select class="form-control" name="is_admin" required>
                                            <option {{ ($getRecord->is_admin == 0) ? 'selected' : '' }} value="0">User</option>
                                            <option {{ ($getRecord->is_admin == 1) ? 'selected' : '' }} value="1">Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

