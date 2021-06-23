@extends('Dashboard.layouts.master')
@section('title', 'التخصصات')
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
                        <a href="{{route('admin.major.create')}}">
                            <button type="button" class="btn btn-block btn-sm btn-success waves-effect waves-light">إضافة</button>
                        </a>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>الإسم</th>
{{--                                <th>التخصص الرئيسي</th>--}}
                                <th>الشعار</th>
                                <th>الحالة</th>
                                <th>العمليات المتاحة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{$row->name_ar}}</td>
{{--                                    <td>{{$row->parent?$row->parent->name_ar:""}}</td>--}}
                                    <td data-toggle="modal" data-target="#imgModal{{$row->id}}">
                                        <img width="50px" height="50px" class="img_preview" src="{{ $row->image}}">
                                    </td>
                                    <div id="imgModal{{$row->id}}" class="modal fade" role="img">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <img data-toggle="modal" data-target="#imgModal{{$row->id}}" class="img-preview" src="{{ $row->image}}" style="max-height: 500px">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>
                                        <span class="badge @if($row->banned==0) badge-success @else badge-danger @endif">
                                            {{$row->banned==0?'مفعل':'غير مفعل'}}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="button-list">
{{--                                            <a href="{{route('admin.user.show',$row->id)}}">--}}
{{--                                                <button class="btn btn-info waves-effect waves-light"> <i class="fa fa-eye mr-1"></i> <span>عرض</span> </button>--}}
{{--                                            </a>--}}
                                            @if($row->banned==0)
                                                <form class="ban" data-id="{{$row->id}}" method="POST" action="{{ route('admin.major.ban',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-archive mr-1"></i> <span>حظر</span> </button>
                                                </form>
                                            @else
                                                <form class="activate" data-id="{{$row->id}}" method="POST" action="{{ route('admin.major.activate',[$row->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-user-clock mr-1"></i> <span>تفعيل</span> </button>
                                                </form>
                                            @endif
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
