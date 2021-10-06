@extends('Dashboard.layouts.master')
@if($row->type=='new')
    @section('title', 'تعديل خبر')
@else
    @section('title', 'تعديل تدوينة')
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
                        <form method="POST" action="{{route('admin.blog.update',$row->id)}}" enctype="multipart/form-data" data-parsley-validate novalidate>
                            @csrf
                            @method('PUT')
                            <input hidden name="type" value="{{$row->type}}">
                            <input hidden name="writer_id" value="{{auth()->id()}}">

                            <div class="form-group">
                                <label for="title_ar">العنوان باللغة العربية*</label>
                                <input type="text" value="{{$row->title_ar}}" name="title_ar" required class="form-control" id="title_ar">
                            </div>
                            <div class="form-group">
                                <label for="title_en">العنوان باللغة الانجليزية*</label>
                                <input type="text" value="{{$row->title_en}}" name="title_en" required class="form-control" id="title_en">
                            </div>

                            <div class="form-group">
                                <label for="note_ar">النص باللغة العربية*</label>
                                <textarea name="note_ar" required class="form-control" id="note_ar">{{$row->note_ar}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="note_en">العنوان باللغة الانجليزية*</label>
                                <textarea name="note_en" required class="form-control" id="note_en">{{$row->note_en}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">الشعار</label>
                                <div class="card-box">
                                    <input name="media" id="input-file-now-custom-1 image" type="file" class="dropify"  data-default-file="{{$row->media}}" />
                                </div>
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
        CKEDITOR.replace( 'note_ar' );
        CKEDITOR.replace( 'note_en' );
    </script>
    <!-- Validation js (Parsleyjs) -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection
