@extends('Dashboard.layouts.master')
@section('title', 'بيانات شركة')
@section('styles')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mt-0 mb-3">المعلومات الشخصية</h4>
                        <img class="card-img-top img-fluid" style="max-height: 400px" src="{{$user->avatar}}" alt="avatar">
                        <div class="card-body">
                            <h4 class="card-title">{{$user->name()}}</h4>
                            <p class="card-text">ID : {{$user->id}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>البريد : </strong><span>{{$user->email}}</span></li>
                            <li class="list-group-item"><strong>الهاتف : </strong><span>{{$user->phone}}</span></li>
                            <li class="list-group-item"><strong>الدولة : </strong><span>{{$user->country->name_ar}}</span></li>
                            <li class="list-group-item"><strong>المدينة : </strong><span>{{$user->city->name_ar}}</span></li>
                            <li class="list-group-item"><strong>التخصص : </strong><span>{{$user->major->name_ar}}</span></li>
                            <li class="list-group-item"><strong>سمع عنا عن طريق : </strong><span>{{$user->hear_by?$user->hear_by->name_ar:""}}</span></li>
                            <li class="list-group-item"><strong>عدد موظفين الشركة : </strong><span>{{$user->members_count}}</span></li>
                            <li class="list-group-item"><strong>تاريخ الانضمام : </strong><span>{{$user->created_at}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mt-0 mb-3">بيانات أخري</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>طبيعة العمل : </strong><span>{{$user->profile->working_type}}</span></li>
                            <li class="list-group-item"><strong>العنوان : </strong><span>{{$user->profile->address}}</span></li>
                            <li class="list-group-item"><strong>وصف : </strong><span>{{$user->profile->note}}</span></li>
                            <li class="list-group-item"><strong>السجل التجاري : </strong>
                                    <iframe  src="{{$user->profile->commercial_file}}">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

