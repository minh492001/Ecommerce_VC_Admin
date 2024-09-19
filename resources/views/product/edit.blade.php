@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Product</h1>
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
                                        <label for="title">Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('title', $getRecord->title) }}" id="title" required name="title" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" value="{{ number_format($getRecord->price, 0, '', '.') }} " id="price" required name="price" placeholder="Enter Price">
                                        <div style="color: red">{{ $errors->first('name') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status <span style="color: red">*</span></label>
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

