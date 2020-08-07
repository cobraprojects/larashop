@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة قسم')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة قسم</span>
@endsection


@section('pagetitle','أضافة قسم')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">أضافة قسم</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-control-label">اسم القسم <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="form-control-label">الاسم في الرابط <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly />
                            <p class="small text-info text-right" style="direction: ltr">{{ config('app.url') }}/{{ config('larashop.frontend_prefix') }}/category/<span
                                    id="slug-text"></span> </p>
                            @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="parent_id" class="form-control-label">يتبع قسم</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="">قسم رئيسي</option>
                                {{ Larashop::getCategoriesSelect(old('parent_id')) }}
                            </select>
                            @error('parent_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label">وصف القسم</label>
                            <textarea type="text" class="editor form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-control-label">صورة القسم</label>
                            <input type="file" class="form-control" id="image" name="image" />
                            @error('image'))
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order" class="form-control-label">ترتيب الظهور <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="order" name="order" value="{{ old('order', $order) }}" />
                            @error('order')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route(LaraShop::adminName().'.category.index') }}" class="btn btn-info pull-right">عودة</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>
    $('#name').keyup(function(){
        let value = $(this).val();
        let slug = getSlug(value);
        $('#slug').val(slug);
        $('#slug-text').text(slug);
    });

    let options = {
        language: '{{ app()->getLocale() }}'
    };

    $('.editor').each(function(e){
        CKEDITOR.replace( this.id, options);
    });
</script>
@endsection