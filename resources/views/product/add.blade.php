@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Product</h1>
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
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Product Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="title" required value="{{ old('title') }}" name="title" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Product Price <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="price" required value="{{ old('price') }}" name="price" placeholder="Enter Price">
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

