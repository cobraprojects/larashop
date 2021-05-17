@extends('multiauth::adminLayouts.app')
@section('title', 'طلب شراء')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">طلب شراء</span>
@endsection

@section('pagetitle','طلب شراء')

@section('content')
<div class="container-fluid">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">البيانات الاساسية</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th class="fit">رقم الطلب</th>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th class="fit">تاريخ الطلب</th>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th class="fit">الاسم</th>
                                <td>{{ $order->full_name }}</td>
                            </tr>
                            <tr>
                                <th class="fit">البريد الإلكتروني</th>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <th class="fit">حالة الطلب</th>
                                <td>{{ $order->status }}</td>
                            </tr>
                            <tr>
                                <th class="fit">حالة السداد</th>
                                <td>{{ $order->paid ? 'مسدد' : 'غير مسدد' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">بيانات الشحن</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th class="fit">المدينة</th>
                                <td colspan="3">{{ $order->city }}</td>
                            </tr>
                            <tr>
                                <th class="fit">رقم الجوال</th>
                                <td colspan="3">{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th class="fit">العنوان</th>
                                <td colspan="3">{{ $order->address }}</td>
                            </tr>
                            <tr>
                                <th class="fit">رقم الشارع</th>
                                <td>{{ $order->street_no }}</td>
                                <th class="fit">المنطقة</th>
                                <td>{{ $order->area }}</td>
                            </tr>
                            <tr>
                                <th class="fit">رقم العمارة</th>
                                <td>{{ $order->building }}</td>
                                <th class="fit">الطابق</th>
                                <td>{{ $order->floor }}</td>
                            </tr>
                            <tr>
                                <th class="fit">رقم الشقة</th>
                                <td>{{ $order->apartment }}</td>
                                <th class="fit">الرقم البريدي</th>
                                <td>{{ $order->postcode }}</td>
                            </tr>
                            <tr>
                                <th class="fit">ملاحظات</th>
                                <td colspan="3">{{ $order->notes }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body table-responsive">
                    <h5 class="mb-3">تفاصيل الطلب</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>اسم الصنف</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>الاجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->qty * $item->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body table-responsive">
                    <h5 class="mb-3">بيانات الفاتورة</h5>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>اجمالي الاصناف</th>
                                <td>{{ $order->price }}</td>
                            </tr>
                            <tr>
                                <th>مصاريف الشحن</th>
                                <td>{{ $order->shipping_cost }}</td>
                            </tr>
                            <tr>
                                <th>مصاريف السداد</th>
                                <td>{{ $order->payment_fee }}</td>
                            </tr>
                            <tr>
                                <th>خصم كوبون</th>
                                <td>{{ $order->coupon_discount }}</td>
                            </tr>
                            <tr class="bg-info text-white">
                                <th>الإجمالي</th>
                                <td>{{ $order->totalPrice }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .fit {
        width: 1%;
        white-space: nowrap;
    }
</style>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>
    $('#title').keyup(function(){
        let value = $(this).val();
        let slug = getSlug(value);
        $('#slug').val(slug);
    });

    let options = {
        filebrowserImageBrowseUrl: '/admin/filemanager?type=Images',
        filebrowserImageUploadUrl: '/admin/filemanager/upload?type=Images&_token={{ csrf_token() }}',
        filebrowserBrowseUrl: '/admin/filemanager?type=Files',
        filebrowserUploadUrl: '/admin/filemanager/upload?type=Files&_token={{ csrf_token() }}',
        language: '{{ app()->getLocale() }}'
    };

    $('.editor').each(function(e){
        CKEDITOR.replace( this.id, options);
    });
</script>
@endsection