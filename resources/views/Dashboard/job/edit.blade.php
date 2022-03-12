@extends('Dashboard.layouts.master')
@if($row->type=='new')
    @section('title', 'تعديل وظيفة')
@else
    @section('title', 'تعديل وظيفة')
@endif
@section('styles')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link href="{{asset('assets/libs/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
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
                        <form method="POST" action="{{route('admin.job.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('PUT')
                            <input hidden name="writer_id" value="{{auth()->id()}}">


                            <div class="form-group">
                                <label class="control-label">التخصص</label>
                                <select name="major_id" class="form-control select2">
                                    <option selected value="{{$row->major_id}}">{{$row->major->name_ar}}</option>
                                    @foreach(\App\Models\Major::where('type','major')->get() as $major)
                                        <option value="{{$major->id}}">{{$major->name_ar}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="job_title">المسمي الوظيفي*</label>
                                <input type="text" value="{{$row->job_title}}" name="job_title" required class="form-control" id="job_title">
                            </div>
                            <div class="form-group">
                                <label class="control-label">المؤهل المطلرب</label>
                                <select name="qualification_type" class="form-control select2">
                                    <option selected value="{{$row->qualification_type}}">{{$row->qualification_type}}</option>
                                    <option value="secondary">ثانوي</option>
                                    <option value="diploma">شهادة دباوم</option>
                                    <option value="bachelor">بكالوريوس</option>
                                    <option value="ma">ماجيستير</option>
                                    <option value="phd">دكتوراه</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">طبيعة العمل </label>
                                <select name="working_type" class="form-control select2">
                                    <option selected value="{{$row->working_type}}">{{$row->working_type}}</option>
                                    <option value="full_time">دوام كامل</option>
                                    <option value="part_time">دوام جزئي</option>
                                    <option value="remotely">العمل من المنزل</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>موعد بداية العرض</label>
                                <div class="input-group">
                                    <input value="{{$row->start_date}}" type="text" name="start_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                            <div class="form-group">
                                <label>موعد نهاية العرض</label>
                                <div class="input-group">
                                    <input value="{{$row->end_date}}" type="text" name="end_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>

                            <div class="form-group">
                                <label class="control-label">المستوي</label>
                                <select name="level" class="form-control select2">
                                    <option selected value="{{$row->level}}">{{$row->level}}</option>
                                    <option value="fresh_graduate">حديث التخرج</option>
                                    <option value="average">متوسط</option>
                                    <option value="high">عالي</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">الجنس</label>
                                <select name="sex" class="form-control select2">
                                    <option selected value="{{$row->sex}}">{{$row->sex}}</option>
                                    <option value="male">ذكر</option>
                                    <option value="female">أنثي</option>
                                    <option>كلاهما</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">عدد سنوات الخبرة </label>
                                <input type="number" value="{{$row->experience_years}}" min="0" class="form-control" name="experience_years"   />
                            </div>

                            <div class="form-group">
                                <label class="control-label">الراتب المطلوب</label>
                                <input type="number" value="{{$row->expected_salary}}" min="0" class="form-control" name="expected_salary"   />
                            </div>

                            <div class="form-group">
                                <label for="description">متطلبات المظيفة*</label>
                                <textarea name="description" required class="form-control" id="description">{{$row->description}}</textarea>
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
    <script src="{{asset('assets/libs/dropify/dist/js/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>


    <script src="{{asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
@endsection
