@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة صفحة')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة صفحة</span>
@endsection


@section('pagetitle','أضافة صفحة')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">أضافة صفحة</div>
                </div>
                <div class="card-body">
                    <form action="{{ route(LaraShop::adminName().'.page.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="form-control-label">عنوان الصفحة <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="form-control-label">العنوان في الرابط <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly />
                            <p class="small text-info text-right" style="direction: ltr">{{ config('app.url') }}/{{ config('larashop.frontend_prefix') }}/page/<span
                                    id="slug-text"></span> </p>
                            @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sub_title" class="form-control-label">عنوان فرعي</label>
                            <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title') }}" />
                            @error('sub_title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body" class="form-control-label">محتوى الصفحة</label>
                            <textarea type="text" class="editor form-control" id="body" name="body">{{ old('body') }}</textarea>
                            @error('body')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <a href="{{ route(LaraShop::adminName().'.page.index') }}" class="btn btn-info pull-right">عودة</a>
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
    $('#title').keyup(function(){
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