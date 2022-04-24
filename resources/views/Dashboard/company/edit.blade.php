@extends('Dashboard.layouts.master')
@if($row->type=='new')
    @section('title', 'تعديل شركة')
@else
    @section('title', 'تعديل شركة')
@endif
@section('styles')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link href="{{asset('assets/libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-box">
                        <form method="POST" action="{{route('admin.company.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="foundation_name">إسم الشركة*</label>
                                <input type="text" value="{{$row->profile->foundation_name}}" name="foundation_name" required class="form-control" id="foundation_name">
                            </div>
                            <div class="form-group">
                                <label class="control-label">طبيعة العمل </label>
                                <select name="working_type" class="form-control select2">
                                    <option selected value="{{$row->profile->working_type}}">{{$row->profile->working_type}}</option>
                                    <option value="full_time">دوام كامل</option>
                                    <option value="part_time">دوام جزئي</option>
                                    <option value="remotely">العمل من المنزل</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">التخصص</label>
                                <select name="major_id" class="form-control select2">
                                    <option selected value="{{$row->major_id}}">{{$row->major->name_ar}}</option>
                                    @foreach(\App\Models\Major::where('type','major')->get() as $major)
                                        <option value="{{$major->id}}">{{$major->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    تعديل
                                </button>
                            </div>
                        </form>
                    </div>
                </div><!-- end col -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
