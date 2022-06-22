@extends('Dashboard.layouts.master')
@section('title', 'إضافة تقرير وظيفة')
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
                        <form method="POST" action="{{route('admin.salary.store')}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="major_id">التخصص*</label>
                                <select name="major_id" required class="form-control" id="major_id">
                                    @foreach(\App\Models\Major::where(['type'=>'major','banned'=>0])->get() as $major)
                                        <option value="{{$major->id}}">{{$major->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">المسمي الوظيفي*</label>
                                <input type="text" name="position" required class="form-control" id="position">
                            </div>
                            <div class="form-group">
                                <label for="average_experience">عدد سنوات الخبرة*</label>
                                <input type="text" name="average_experience" required class="form-control" id="average_experience">
                            </div>
                            <div class="form-group">
                                <label for="average_lowest_salary">متوسط الحد الأدني*</label>
                                <input type="text" name="average_lowest_salary" required class="form-control" id="average_lowest_salary">
                            </div>
                            <div class="form-group">
                                <label for="average_salary">المتوسط*</label>
                                <input type="text" name="average_salary" required class="form-control" id="average_salary">
                            </div>
                            <div class="form-group">
                                <label for="average_highest_salary">متوسط الحد الأقصي*</label>
                                <input type="text" name="average_highest_salary" required class="form-control" id="average_highest_salary">
                            </div>
                            <div class="form-group text-right mb-0">
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                    تأكيد
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
