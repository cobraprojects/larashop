@extends('multiauth::adminLayouts.app')
@section('title', 'اعدادات المتجر')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">اعدادات المتجر</span>
@endsection


@section('pagetitle','اعدادات المتجر')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">اعدادات المتجر</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.setting.index') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-control-label">اسم المتجر</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $setting->name) }}" />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label">الوصف</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $setting->description) }}" />
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-control-label">رقم الهاتف</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $setting->phone) }}" />
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-control-label">البريد الإلكتروني</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $setting->email) }}" />
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="whatsapp" class="form-control-label">رقم الواتس اب</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" />
                            @error('whatsapp')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country_name" class="form-control-label">العنوان</label>
                            <input type="text" class="form-control" id="country_name" name="country_name" value="{{ old('country_name', $setting->country_name) }}" />
                            @error('country_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="currency_name" class="form-control-label">العملة</label>
                            <input type="text" class="form-control" id="currency_name" name="currency_name" value="{{ old('currency_name', $setting->currency_name) }}" />
                            @error('currency_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="currency_symbol" class="form-control-label">رمز العملة</label>
                            <input type="text" class="form-control" id="currency_symbol" name="currency_symbol" value="{{ old('currency_symbol', $setting->currency_symbol) }}" />
                            @error('currency_symbol')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection