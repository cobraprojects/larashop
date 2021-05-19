@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة براند')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة براند</span>
@endsection


@section('pagetitle','أضافة براند')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">أضافة براند</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-control-label">اسم البراند <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="form-control-label">الاسم في الرابط <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly />
                            <p class="small text-info text-right" style="direction: ltr">{{ config('app.url') }}/{{ config('larashop.frontend_prefix') }}/brand/<span
                                    id="slug-text"></span> </p>
                            @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-control-label">صورة البراند</label>
                            <input type="file" class="form-control" id="image" name="image" />
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route(LaraShop::adminName().'.brand.index') }}" class="btn btn-info pull-right">عودة</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#name').keyup(function(){
        let value = $(this).val();
        let slug = getSlug(value);
        $('#slug').val(slug);
        $('#slug-text').text(slug);
    });
</script>
@endsection