@extends('Dashboard.layouts.master')
@section('title', 'بيانات مستخدم')
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
                            <h4 class="card-title">{{$user->profile->first_name.' '.$user->profile->last_name}}</h4>
                            <p class="card-text">ID : {{$user->id}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>البريد : </strong><span>{{$user->email}}</span></li>
                            <li class="list-group-item"><strong>الهاتف : </strong><span>{{$user->phone}}</span></li>
                            <li class="list-group-item"><strong>الدولة : </strong><span>{{$user->country->name_ar}}</span></li>
                            <li class="list-group-item"><strong>المدينة : </strong><span>{{$user->city->name_ar}}</span></li>
                            <li class="list-group-item"><strong>التخصص : </strong><span>{{$user->major->name_ar}}</span></li>
                            <li class="list-group-item"><strong>تاريخ الميلاد : </strong><span>{{$user->birthdate}}</span></li>
                            <li class="list-group-item"><strong>تاريخ الانضمام : </strong><span>{{$user->created_at}}</span></li>
                        </ul>
                    </div>
                </div>
                @if($user->qualification)
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mt-0 mb-3">المؤهلات العلمية</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>المؤهل : </strong><span>{{$user->qualification->qualification_type}}</span></li>
                            <li class="list-group-item"><strong>الموسسة : </strong><span>{{$user->qualification->foundation_name}}</span></li>
                            <li class="list-group-item"><strong>الدولة : </strong><span>{{$user->qualification->country->name_ar}}</span></li>
                            <li class="list-group-item"><strong>المدينة : </strong><span>{{$user->qualification->city->name_ar}}</span></li>
                            <li class="list-group-item"><strong>نظام حساب المتوسط : </strong><span>{{$user->qualification->average_calculation_system}}</span></li>
                            <li class="list-group-item"><strong>تاريخ التخرج : </strong><span>{{$user->qualification->graduation_date}}</span></li>
                            <li class="list-group-item"><strong>التقدير : </strong><span>{{$user->qualification->graduation_degree}}</span></li>
                            <li class="list-group-item"><strong>التخصص : </strong><span>{{$user->qualification->specialization}}</span></li>
                            <li class="list-group-item"><strong>شهادة التخرج : </strong>
                                    <img class="card-img-top img-fluid" style="max-height: 100px;max-width: 100px" src="{{$user->qualification->graduation_file}}">
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>


        </div>
    </div>
@endsection

