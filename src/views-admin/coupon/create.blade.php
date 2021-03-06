@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة كوبون خصم')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة كوبون خصم</span>
@endsection


@section('pagetitle','أضافة كوبون خصم')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">أضافة كوبون خصم</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.coupon.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="code" class="form-control-label">كود الكوبون <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" />
                            @error('code')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label">وصف مختصر</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" />
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="coupon_type" class="form-control-label">نوع الكوبون</label>
                            <select class="form-control" id="coupon_type" name="coupon_type">
                                <option {{ old('coupon_type') == 'TotalCoupon' ? 'selected' : '' }} value="TotalCoupon">خصم على الاجمالي</option>
                                <option {{ old('coupon_type') == 'ShippingCoupon' ? 'selected' : '' }} value="ShippingCoupon">خصم على مصاريف الشحن</option>
                                <option {{ old('coupon_type') == 'CategoriesCoupon' ? 'selected' : '' }} value="CategoriesCoupon">خصم على اقسام</option>
                                <option {{ old('coupon_type') == 'ProductsCoupon' ? 'selected' : '' }} value="ProductsCoupon">خصم على اصناف</option>
                                <option {{ old('coupon_type') == 'UsersCoupon' ? 'selected' : '' }} value="UsersCoupon">خصم لافراد</option>
                            </select>
                            @error('coupon_type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="coupon_type">
                            <input type="hidden" name="data" id="data" class="d-none" value="{{ old('data') }}" />

                            <div class="form-group CategoriesCoupon d-none">
                                <label for="categories" class="form-control-label">اختر اقسام</label>
                                <select class="form-control select2" id="categories" multiple name="categories[]">
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ old('coupon_type') == 'CategoriesCoupon' && @ in_array($item->id, old('categories')) ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group ProductsCoupon d-none">
                                <label for="products" class="form-control-label">اختر منتجات</label>
                                <select class="form-control select2" id="products" multiple name="products[]">
                                    @foreach ($products as $item)
                                    <option value="{{ $item->id }}" {{ old('coupon_type') == 'ProductsCoupon' && @ in_array($item->id, old('products')) ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group UsersCoupon d-none">
                                <label for="users" class="form-control-label">اختر مستخدمين</label>
                                <select class="form-control select2" id="users" multiple name="users[]">
                                    @foreach ($users as $item)
                                    <option value="{{ $item->id }}" {{ old('coupon_type') == 'UsersCoupon' && @ in_array($item->id, old('users')) ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="form-control-label">قيمة الخصم <span class="text-danger">*</span> </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" />
                                <div class="input-group-append">
                                    <select name="discount_type" id="discount_type" name="discount_type">
                                        <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>نسبة مئوية</option>
                                        <option value="value" {{ old('discount_type') == 'value' ? 'selected' : '' }}>قيمة مادية</option>
                                    </select>
                                </div>
                            </div>

                            @error('amount')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="only_once" class="form-control-label">يستخدم الكوبون مرة واحدة للمستخدم</label>
                            <select class="form-control" id="only_once" name="only_once">
                                <option value="1" {{ old('only_once') == 1 ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('only_once') === "0" ? 'selected' : '' }}>لا</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route(LaraShop::adminName().'.coupon.index') }}" class="btn btn-info pull-right">عودة</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    var old = '{{ old('coupon_type') }}';
    var data = '{{ old('data') }}';
    var dataArray = data.split(',');

    $('.select2').select2();

    $('#coupon_type').change(function(){
        var value = $(this).val();
        $('.coupon_type .form-group').addClass('d-none');
        $('.coupon_type .select2').each(function(){
            var selectInput = $(this);
            $(this).find('option').prop('selected', 0);
            
            $('#data').val('');
            selectInput.select2().select2('val', '');
        });
        $('.'+value).removeClass('d-none');
    }).change();

    if (old && data) {
        $('#data').val(data);
        $('.select2').select2().val(dataArray).trigger('change');;
    }

    $('.coupon_type select').change(function(){
        $('#data').val($(this).val().join(','));
    });
</script>
@endsection