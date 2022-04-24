@extends('Dashboard.layouts.master')
@section('title', 'الشركات')
@section('styles')
    <link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>الإسم</th>
                                <th>طبيعة العمل</th>
                                <th>البريد الالكتروني</th>
                                <th>التخصص</th>
                                <th>المدينة</th>
                                <th>الحالة</th>
                                <th>العمليات المتاحة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->profile->foundation_name}}</td>
                                    <td>{{$row->profile->working_type}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->major->name_ar}}</td>
                                    <td>{{$row->city->name_ar}}</td>
                                    <td>
                                        <span class="badge @if($row->banned==0) badge-success @else badge-danger @endif">
                                            {{$row->banned==0?'مفعل':'غير مفعل'}}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="button-list">
                                            <a href="{{route('admin.company.show',$row->id)}}">
                                                <button class="btn btn-info waves-effect waves-light"> <i class="fa fa-eye mr-1"></i> <span>عرض</span> </button>
                                            </a>
                                            @if($row->banned==0)
                                                <form class="ban" data-id="{{$row->id}}" method="POST" action="{{ route('admin.user.ban',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-archive mr-1"></i> <span>حظر</span> </button>
                                                </form>
                                            @else
                                                <form class="activate" data-id="{{$row->id}}" method="POST" action="{{ route('admin.user.activate',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-user-clock mr-1"></i> <span>تفعيل</span> </button>
                                                </form>
                                            @endif

                                            @if($row->site_show==1)
                                                <form class="site_disappear" data-id="{{$row->id}}" method="POST" action="{{ route('admin.company.site_disappear',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-archive mr-1"></i> <span>اخفاء من الموقع</span> </button>
                                                </form>
                                            @else
                                                <form class="site_show" data-id="{{$row->id}}" method="POST" action="{{ route('admin.company.site_show',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-user-clock mr-1"></i> <span>إظهار بالموقع</span> </button>
                                                </form>
                                            @endif
                                            @if($row->approved==0)
                                                <form class="approve" data-id="{{$row->id}}" method="POST" action="{{ route('admin.company.approve',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-twitter"></i> <span>تفعيل إضافة الوظائف</span> </button>
                                                </form>
                                            @endif
                                            <a href="{{route('admin.company.edit',$row->id)}}">
                                                <button class="btn btn-warning waves-effect waves-light"> <i class="fa fa-map-pin mr-1"></i> <span>تعديل</span> </button>
                                            </a>
                                            <form class="delete" data-id="{{$row->id}}" method="POST" action="{{ route('admin.user.destroy',[$row->id]) }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-trash"></i> <span>حذف</span> </button>
                                            </form>
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
@endsection
@section('script')
    <script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/vfs_fonts.js')}}"></script>
    <!-- third party js ends -->
    <!-- Datatables init -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $(document).on('click', '.ban', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية الحظر ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية الحذف ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
        $(document).on('click', '.activate', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "تأكيد عملية التفعيل ؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'نعم !',
                cancelButtonText: 'ﻻ , الغى العملية!',
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    $("form[data-id='" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
    </script>
@endsection
