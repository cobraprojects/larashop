@extends('multiauth::adminLayouts.app')
@section('title', 'البراندات')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">البراندات</span>
@endsection

@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('pagetitle','البراندات')
@section('content')
<div class="container-fluid">
    <a href="{{ route(LaraShop::adminName().'.brand.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus-circle"></i>
        أضافة براند
    </a>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">البراندات</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th>الاسم</th>
                                <th>الاسم في الرابط</th>
                                <th>الصورة</th>
                                <th class="noSort noSearch"></th>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <td class="fit">{{ $brand->id }}</td>
                                    <td class="">{{ $brand->name }}</td>
                                    <td class="">{{ @$brand->slug }}</td>
                                    <td class="fit">{{ $brand->media->first()? $brand->media->first()('thumb')->attributes(['class'=>'img-fluid img-thumbnail']) : '' }}</td>
                                    <td class="fit">
                                        <form action="{{ route(LaraShop::adminName().'.brand.destroy', $brand->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @permitTo('UpdateLarashopBrand')
                                            <a href="{{ route(LaraShop::adminName().'.brand.edit',[$brand->id]) }}" class="text-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            @endpermitTo
                                            @permitTo('DeleteLarashopBrand')
                                            <button type="submit" class="btn-link text-danger delete pointer" onclick="return confirm('سيتم الحذف نهائياً. للاستمرار أضغط OK')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endpermitTo
                                        </form>
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
                    "url": '{{ asset('vendor/multiauth/lang/ar/DataTable.json') }}'
                },
                "columnDefs": [
                    { sortable: false, targets: ['noSort'] },
                    { searchable: false, targets: ['noSearch'] },
                ]
            } );
        });


</script>
@endsection