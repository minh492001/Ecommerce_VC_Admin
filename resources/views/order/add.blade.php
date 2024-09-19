@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Add New Order</h1>
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
                                        <label for="user_id">User <span style="color: red">*</span></label>
                                        <select class="form-control" id="user_id" name="user_id" >
                                            <option value="">Select</option>
                                            @foreach($getUser as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_id">Product <span style="color: red">*</span></label>
                                        <select class="form-control" id="product_id" name="product_id" >
                                            <option value="">Select</option>
                                            @foreach($getProduct as $value)
                                                <option value="{{ $value->id }}">{{ $value->title }} ({{ number_format($value->price, 0, '', '.') }} đ)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity <span style="color: red">*</span></label>
                                        <input type="number" class="form-control" id="quantity" required value="{{ old('quantity') }}" name="quantity" placeholder="Enter Quantity">
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

