@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Profile</h1>
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
                                        <input type="text" class="form-control" value="{{ old('name', $getUser->name) }}" id="name" required name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('age', $getUser->age) }}" id="age" required name="age" placeholder="Enter Age">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender <span style="color: red">*</span></label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="{{ old('gender', $getUser->gender) }}">{{ $getUser->gender }}</option>
                                            @if(strtolower($getUser->gender) == 'male')
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            @elseif(strtolower($getUser->gender) == 'female')
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
                                        <input type="text" class="form-control" value="{{ old('address', $getUser->address) }}" id="address" required name="address" placeholder="Enter Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="job">Job <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('job', $getUser->job) }}" id="job" required name="job" placeholder="Enter Job">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password <span style="color: red">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        <p>Change Password if it's necessary</p>
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

