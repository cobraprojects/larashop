@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة مدينة')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة مدينة</span>
@endsection


@section('pagetitle','أضافة مدينة')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">أضافة مدينة</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.city.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-control-label">اسم المدينة <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="shipping_cost" class="form-control-label">تكلفة الشحن <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="shipping_cost" name="shipping_cost" value="{{ old('shipping_cost', 0) }}" />
                            @error('shipping_cost')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route(LaraShop::adminName().'.city.index') }}" class="btn btn-info pull-right">عودة</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection