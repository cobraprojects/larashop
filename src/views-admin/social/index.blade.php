@extends('multiauth::adminLayouts.app')
@section('title', 'روابط التواصل الإجتماعي')
@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('admin.home') }}">لوحة التحكم</a>
<a class="breadcrumb-item" href="">المتجر</a>
<span class="breadcrumb-item active">روابط التواصل الإجتماعي</span>
@endsection

@section('css')
<link href="//cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('pagetitle','روابط التواصل الإجتماعي')
@section('content')
<div class="container-fluid">
    <a href="{{ route(LaraShop::adminName().'.social.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus-circle"></i>
        أضافة رابط تواصل
    </a>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">روابط التواصل الإجتماعي</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" bg-info">
                                <th class="fit">#</th>
                                <th>الاسم</th>
                                <th>الرابط</th>
                                <th>الأيكون</th>
                                <th class="noSort noSearch"></th>
                            </thead>
                            <tbody>
                                @foreach($socials as $social)
                                <tr>
                                    <td class="fit">{{ $social->id }}</td>
                                    <td class="">{{ $social->name }}</td>
                                    <td class="">{{ @$social->url }}</td>
                                    <td class="fit">
                                        <ion-icon name="{{ @$social->icon_name }}" size="large"></ion-icon>
                                    </td>
                                    <td class="fit">
                                        <form action="{{ route(LaraShop::adminName().'.social.destroy', $social->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @permitTo('UpdateLarashopSocial')
                                            <a href="{{ route(LaraShop::adminName().'.social.edit',[$social->id]) }}" class="text-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            @endpermitTo
                                            @permitTo('DeleteLarashopSocial')
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
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
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