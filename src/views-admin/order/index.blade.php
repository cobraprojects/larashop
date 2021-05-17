@extends('multiauth::adminLayouts.app')
@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    .fit {
        width: 1%;
        white-space: nowrap;
    }

    .dropdown-toggle::after {
        margin-right: 0.255em;
        margin-left: auto;
    }

    .dropdown-item {
        box-sizing: border-box;
    }
</style>
@endsection
@section('title', 'طلبات الشراء')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<span class="breadcrumb-item active">طلبات الشراء</span>
@endsection

@section('pagetitle','طلبات الشراء')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">طلبات الشراء</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th class="fit">تاريخ</th>
                                <th>المشتري</th>
                                <th>المبلغ</th>
                                <th>الشحن</th>
                                <th>مصاريف سداد</th>
                                <th>كوبون</th>
                                <th>الاجمالي</th>
                                <th>طريقة السداد</th>
                                <th>حالة السداد</th>
                                <th>حالة الطلب</th>
                                <th class="noSort noSearch fit"></th>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td class="fit {{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->id }}</td>
                                    <td class="fit {{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->created_at }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->full_name }} <br> {{ $order->email }} <br> {{ $order->phone }}
                                    </td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->price }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->shipping_cost }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->payment_fee }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->coupon_discount }} {!! $order->coupon_code ? '<br> كود:
                                        '.$order->coupon_code : '' !!} </td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->totalPrice }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->payment_method }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->paid ? 'مسدد' : 'لم يسدد' }}</td>
                                    <td class="{{ $order->status == 'تم الإلغاء' ? 'text-danger' : '' }}">{{ $order->status }}</td>
                                    <td class="fit">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-gear"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route(LaraShop::adminName().'.order.show', $order->id) }}">عرض</a>
                                                {{-- <a class="dropdown-item" href="#">تعديل</a> --}}
                                                @permitTo('UpdateLarashopOrder')
                                                @if ($order->paid)
                                                <form action="{{ route(LaraShop::adminName().'.order.changePaymentStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button class="dropdown-item link" name="paid" value="0">إلغاء سداد</button>
                                                </form>
                                                @else
                                                <form action="{{ route(LaraShop::adminName().'.order.changePaymentStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button class="dropdown-item link" name="paid" value="1">سداد</button>
                                                </form>
                                                @endif
                                                <form action="{{ route(LaraShop::adminName().'.order.changeOrderStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button class="dropdown-item link" name="status" value="جاري التحضير">
                                                        جاري التحضير
                                                    </button>
                                                    <button class="dropdown-item link" name="status" value="تم الشحن">
                                                        تم الشحن
                                                    </button>
                                                    <button class="dropdown-item link" name="status" value="تم الاستلام">
                                                        تم الاستلام
                                                    </button>
                                                    <button class="dropdown-item link" name="status" value="تم الإلغاء">
                                                        تم الإلغاء
                                                    </button>
                                                </form>
                                                @endpermitTo
                                                @permitTo('DeleteLarashopOrder')
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#">حذف الطلب</a>
                                                @endpermitTo
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="//cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function(){
            $('.table').DataTable( {
                "order": [[ 0, "desc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "iDisplayLength": 25,
                "stateSave": true,
                "autoWidth": false,
                "language": {
                    "url": '{{ asset('lang/ar/DataTable.json') }}'
                },
                "columnDefs": [
                    { sortable: false, targets: ['noSort'] },
                    { searchable: false, targets: ['noSearch'] },
                ]
            } );
        });


</script>
@endsection