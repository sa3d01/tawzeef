<div class="row">
    <div class="col-xl-4">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('admin.contact.index')}}" class="dropdown-item">المزيد</a>
                </div>
            </div>
            <h4 class="header-title mb-3">رسائل تواصل الأعضاء</h4>
            <div class="inbox-widget">
                @foreach(\App\Models\Contact::where('read',false)->get() as $contact)
                    <div class="inbox-item">
                    <a href="#">
                        <div class="inbox-item-img"><img style="height: 40px;width: 40px" src="{{$contact->user->avatar}}" class="rounded-circle" alt="{{$contact->user->profile->foundation_name}}"></div>
                        <h5 class="inbox-item-author mt-0 mb-1">{{$contact->user->name}}</h5>
                        <p class="inbox-item-text">{{\Illuminate\Support\Str::limit($contact->message,100)}}</p>
                        <p class="inbox-item-date">{{\Carbon\Carbon::parse($contact->created_at)->diffForHumans()}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-8">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-3">آخر الوظائف</h4>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الشركة</th>
                        <th>تاريخ الاعلان</th>
                        <th>تاريخ الانتهاء</th>
                        <th>حالة الاعلان</th>
                        <th>التخصص</th>
{{--                        <th>المزيد</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Job::latest()->take(7)->get() as $job)
                    <tr>
                        <td>{{$job->id}}</td>
                        <td>
                            <a href="{{route('admin.company.show',$job->company_id)}}">
                            {{$job->company->profile->foundation_name}}
                            </a>
                        </td>
                        <td>{{\Carbon\Carbon::parse($job->created_at)->format('Y-M-d')}}</td>
                        <td>{{\Carbon\Carbon::parse($job->end_date)->format('Y-M-d')}}</td>
                        <td><span class="badge @if($job->end_date>\Carbon\Carbon::now()) badge-danger  @else badge-warning @endif">{{$job->getStatusArabic()}}</span></td>
                        <td>{{$job->major->name_ar}}</td>
{{--                        <td>--}}
{{--                            <a href="{{route('admin.job.show',$job->id)}}">--}}
{{--                                 <i class="fa fa-eye mr-1"></i> <span>عرض</span>--}}
{{--                            </a>--}}
{{--                        </td>--}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->

</div>
