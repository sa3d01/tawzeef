@extends('Dashboard.layouts.master')
@section('title', 'المستخدمين')
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
                                <th>رقم الجوال</th>
                                <th>البريد الالكتروني</th>
                                <th>التخصص</th>
                                <th>المدينة</th>
                                <th>من اين سمعت عنا</th>
                                <th>نسبةاكتمال السيرة الذاتية</th>
                                <th>الحالة</th>
                                <th>العمليات المتاحة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows->lazy() as $row)
                                @php($user=\App\Models\User::find($row['id']))
                                <tr>
                                    <td>{{$user->name()}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->major->name_ar}}</td>
                                    <td>{{$user->city->name_ar}}</td>
                                    <td>{{$user->hear_by->name_ar}}</td>
                                    <td>{{$user->completedProfileRatio() }} %</td>
                                    <td>
                                        <span class="badge @if($user->banned==0) badge-success @else badge-danger @endif">
                                            {{$user->banned==0?'مفعل':'غير مفعل'}}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="button-list">
                                            <a href="{{route('admin.user.show',$user->id)}}">
                                                <button class="btn btn-info waves-effect waves-light"> <i class="fa fa-eye mr-1"></i> <span>عرض</span> </button>
                                            </a>
                                            @if($user->banned==0)
                                                <form class="ban" data-id="{{$user->id}}" method="POST" action="{{ route('admin.user.ban',[$user->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-archive mr-1"></i> <span>حظر</span> </button>
                                                </form>
                                            @else
                                                <form class="activate" data-id="{{$user->id}}" method="POST" action="{{ route('admin.user.activate',[$user->id]) }}">
                                                    @csrf
                                                    {{ method_field('POST') }}
                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-user-clock mr-1"></i> <span>تفعيل</span> </button>
                                                </form>
                                            @endif
                                            <form class="delete" data-id="{{$user->id}}" method="POST" action="{{ route('admin.user.destroy',[$user->id]) }}">
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
{{--                        {{$rows->links()}}--}}
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
