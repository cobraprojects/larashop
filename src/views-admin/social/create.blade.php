@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة رابط تواصل')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة رابط تواصل</span>
@endsection


@section('pagetitle','أضافة رابط تواصل')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">أضافة رابط تواصل</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.social.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-control-label">اسم الموقع الإجتماعي <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url" class="form-control-label">الرابط <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" />
                            @error('url')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon_name" class="form-control-label">اسم الايكون <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="icon_name" name="icon_name" value="{{ old('icon_name') }}" />
                            <p class="text-info small">يمكنك البحث عن اسم الايكون من موقع <a href="https://ionic.io/ionicons">https://ionic.io/ionicons</a> ونسخ الاسم فقط</p>
                            @error('icon_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon_color" class="form-control-label">لون الايكون <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="icon_color" name="icon_color" value="{{ old('icon_color') }}" />
                            <p class="text-info small">يجب اختيار لون متوافق مع مكتبة Tailwind Css من خلال الرابط التالي : <a
                                    href="https://tailwindcss.com/docs/text-color">https://tailwindcss.com/docs/text-color</a></p>
                            @error('icon_color')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route(LaraShop::adminName().'.social.index') }}" class="btn btn-info pull-right">عودة</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection