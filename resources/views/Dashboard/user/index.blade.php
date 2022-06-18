@extends('Dashboard.layouts.master')
@section('title', 'المستخدمين')
@section('styles')
    <!-- css and js for DataTables Server-side Processing -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>


{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>--}}

{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.6/css/scroller.dataTables.min.css"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.20/b-1.6.1/sl-1.3.1/datatables.min.css"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="Editor-1.9.2/css/editor.dataTables.css">--}}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
{{--                            <tr>--}}
                                <th>الإسم</th>
                                <th>رقم الجوال</th>
                                <th>البريد الالكتروني</th>
                                <th>التخصص</th>
                                <th>المدينة</th>
                                <th>من اين سمعت عنا</th>
                                <th>نسبةاكتمال السيرة الذاتية</th>
                                <th>الحالة</th>
                                <th>العمليات المتاحة</th>
{{--                            </tr>--}}
                            </thead>
{{--                            <tbody>--}}
{{--                            @foreach($rows as $row)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$row->name()}}</td>--}}
{{--                                    <td>{{$row->phone}}</td>--}}
{{--                                    <td>{{$row->email}}</td>--}}
{{--                                    <td>{{$row->major->name_ar}}</td>--}}
{{--                                    <td>{{$row->city->name_ar}}</td>--}}
{{--                                    <td>{{$row->hear_by->name_ar}}</td>--}}
{{--                                    <td>{{$row->completedProfileRatio() }} %</td>--}}
{{--                                    <td>--}}
{{--                                        <span class="badge @if($row->banned==0) badge-success @else badge-danger @endif">--}}
{{--                                            {{$row->banned==0?'مفعل':'غير مفعل'}}--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="button-list">--}}
{{--                                            <a href="{{route('admin.user.show',$row->id)}}">--}}
{{--                                                <button class="btn btn-info waves-effect waves-light"> <i class="fa fa-eye mr-1"></i> <span>عرض</span> </button>--}}
{{--                                            </a>--}}
{{--                                            @if($row->banned==0)--}}
{{--                                                <form class="ban" data-id="{{$row->id}}" data-signature="ban#{{$row->id}}" method="POST" action="{{ route('admin.user.ban',[$row->id]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    {{ method_field('POST') }}--}}
{{--                                                    <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-archive mr-1"></i> <span>حظر</span> </button>--}}
{{--                                                </form>--}}
{{--                                            @else--}}
{{--                                                <form class="activate" data-id="{{$row->id}}" data-signature="activate#{{$row->id}}" method="POST" action="{{ route('admin.user.activate',[$row->id]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    {{ method_field('POST') }}--}}
{{--                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-user-clock mr-1"></i> <span>تفعيل</span> </button>--}}
{{--                                                </form>--}}
{{--                                            @endif--}}
{{--                                            <form class="delete" data-id="{{$row->id}}" data-signature="delete#{{$row->id}}" method="POST" action="{{ route('admin.user.destroy',[$row->id]) }}">--}}
{{--                                                @csrf--}}
{{--                                                {{ method_field('DELETE') }}--}}
{{--                                                <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-trash"></i> <span>حذف</span> </button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
                        </table>
{{--                        {{$rows->links()}}--}}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
{{--    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>--}}

{{--    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.20/b-1.6.1/sl-1.3.1/datatables.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

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
                    $("form[data-signature='ban#" + id + "']").submit();
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
                    $("form[data-signature='delete#" + id + "']").submit();
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
                    $("form[data-signature='activate#" + id + "']").submit();
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax":{
                    "url": "{{ route('admin.allUsers') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "name" },
                    { "data": "phone" },
                    { "data": "email" },
                    { "data": "major" },
                    { "data": "city" },
                    { "data": "hear_by" },
                    { "data": "completedProfileRatio" },
                    { "data": "status" },
                    { "data": "options" }
                ]
            });
        });
    </script>

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#datatable').DataTable( {--}}
{{--                serverSide: true,--}}
{{--                ordering: false,--}}
{{--                searching: false,--}}
{{--                ajax: "{{ route('users.index') }}",--}}
{{--                ajax: function ( data, callback, settings ) {--}}
{{--                    var out = [];--}}

{{--                    for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {--}}
{{--                        out.push( [ i+'-1', i+'-2', i+'-3', i+'-4', i+'-5' ] );--}}
{{--                    }--}}

{{--                    setTimeout( function () {--}}
{{--                        callback( {--}}
{{--                            draw: data.draw,--}}
{{--                            data: out,--}}
{{--                            recordsTotal: 5000000,--}}
{{--                            recordsFiltered: 5000000--}}
{{--                        } );--}}
{{--                    }, 50 );--}}
{{--                },--}}
{{--                scrollY: 200,--}}
{{--                scroller: {--}}
{{--                    loadingIndicator: true--}}
{{--                },--}}
{{--            } );--}}
{{--        } );--}}
{{--    </script>--}}


{{--    <script>--}}
{{--        $(function() {--}}
{{--            var Table = $('#datatable').DataTable({--}}
{{--                "order": [[ 0, "desc" ]],--}}
{{--                "oLanguage": {--}}
{{--                    "sSearch": "بحث",--}}
{{--                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",--}}
{{--                    "sProcessing":   "جارٍ التحميل...",--}}
{{--                    "sZeroRecords":  "لم يعثر على أية سجلات",--}}
{{--                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",--}}
{{--                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",--}}
{{--                    "oPaginate": {--}}
{{--                        "sFirst":    "الأول",--}}
{{--                        "sPrevious": "السابق",--}}
{{--                        "sNext":     "التالي",--}}
{{--                        "sLast":     "الأخير"--}}
{{--                    }--}}
{{--                },--}}
{{--                "iDisplayLength": -1,--}}
{{--                "sPaginationType": "full_numbers",--}}
{{--            });--}}
{{--            var rows=Table.rows().data();--}}
{{--            $(--}}
{{--                ".filters-groups .date-picker-max, .filters-groups .date-picker-min"--}}
{{--            ).change(function() {--}}
{{--                var val = parseInt((new Date(this.value).getTime() / 1000).toFixed(0));--}}
{{--                var op = "min";--}}
{{--                if ($(this).hasClass("date-picker-max")) {--}}
{{--                    op = "max";--}}
{{--                }--}}
{{--                Table.rows().every(function() {--}}
{{--                    var row_id=this.data()[0];--}}
{{--                    var date = Date.parse(this.data()[1])/1000;--}}
{{--                    if (date) {--}}
{{--                        if (op === "min") {--}}
{{--                            if (date < val) {--}}
{{--                                $('#'+row_id).hide();--}}
{{--                            } else {--}}
{{--                                $('#'+row_id).show();--}}
{{--                            }--}}
{{--                        } else {--}}
{{--                            if (date > val) {--}}
{{--                                $('#'+row_id).hide();--}}
{{--                            } else {--}}
{{--                                $('#'+row_id).show();--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--                Table.draw();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
