@extends('multiauth::adminLayouts.app')
@section('title', 'أضافة منتج')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">أضافة منتج</span>
@endsection


@section('pagetitle','أضافة منتج')
@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <form action="{{ route(LaraShop::adminName().'.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">البيانات الاساسية</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">اسم المنتج <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug" class="form-control-label">الاسم في الرابط <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly />
                                    <p class="small text-info text-right" style="direction: ltr">{{ config('app.url') }}/{{ config('larashop.frontend_prefix') }}/product/<span
                                            id="slug-text"></span> </p>
                                    @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="description" class="form-control-label">وصف المنتج</label>
                                    <textarea type="text" class="editor form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image" class="form-control-label">صورة المنتج</label>
                                    <input type="file" class="form-control" id="image" name="image" />
                                    @error('image'))
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="images" class="form-control-label">صور اخرى</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple />
                                    @error('images'))
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hidden" class="form-control-label">حالة الظهور <span class="text-danger">*</span> </label>
                                    <select class="form-control" id="hidden" name="hidden">
                                        <option value="0">ظاهر</option>
                                        <option value="1">مخفي</option>
                                    </select>
                                    @error('hidden')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">الأقسام</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categories" class="form-control-label">اختر الاقسام <span class="text-danger">*</span> </label>
                                    <select class="form-control" id="categories" name="categories[]" multiple>
                                        {{ Larashop::getCategoriesSelect(old('categories')) }}
                                    </select>
                                    @error('categories')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <div class="card-title">الاسعار</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">سعر المنتج <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" />
                                    @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="old_price" class="form-control-label">سعر قبل الخصم </label>
                                    <input type="text" class="form-control" id="old_price" name="old_price" value="{{ old('old_price') }}" />
                                    @error('old_price')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <div class="card-title">التحكم بالمخزن</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="qty" class="form-control-label ml-2">الكمية المتوفرة</label>
                                    <input type="text" class="form-control" id="qty" name="qty" value="{{ old('qty') }}" />
                                    <p class="text-info small">اتركها فارغة للكميات غير المحدودة</p>
                                    @error('qty')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="max_qty" class="form-control-label ml-2">اقصى كمية في الطلب</label>
                                    <input type="text" class="form-control" id="max_qty" name="max_qty" value="{{ old('max_qty') }}" />
                                    @error('max_qty')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <div class="card-title">تمييز المنتج</div>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" id="new" name="new" value="1" {{ old('new') == 1? 'checked':'' }} />
                                            <label for="new" class="form-control-label ml-2">جديد</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" id="has_discount" name="has_discount" value="1" {{ old('has_discount') == 1? 'checked':'' }} />
                                            <label for="has_discount" class="form-control-label ml-2">خصم</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured') == 1? 'checked':'' }} />
                                            <label for="featured" class="form-control-label ml-2">مميز</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route(LaraShop::adminName().'.product.index') }}" class="btn btn-info pull-right">عودة</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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

    $('#categories').select2({
        templateResult: formatResult,
    });
</script>
@endsection