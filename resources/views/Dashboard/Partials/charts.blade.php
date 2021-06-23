<div class="row">
    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title mt-0">الأعضاء</h4>
            <div class="widget-chart text-center">
                <div data-users="{{$all_users_count}}" data-companies="{{$all_companies_count}}" id="morris-donut-users" dir="ltr" style="height: 245px;" class="morris-chart"></div>
                <ul class="list-inline chart-detail-list mb-0">
                    <li class="list-inline-item">
                        <h5 style="color: #f05050;"><i class="fa fa-circle mr-1"></i>المستخدمين</h5>
                    </li>
                    <li class="list-inline-item">
                        <h5 style="color: #648b55;"><i class="fa fa-circle mr-1"></i>الشركات</h5>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- end col -->


    <div class="col-xl-8">
        <div class="card-box">
            <h4 class="header-title mt-0">إحصائيات الوظائف خلال أسبوع ماضى</h4>
            <div hidden id="last_week_jobs">
                @foreach($last_week_jobs as $last_week_job)
                    <div data-job="{{$last_week_job}}"></div>
                @endforeach
            </div>
            <div data-jobs="{{$last_week_jobs}}" id="morris-line-jobs" dir="ltr" style="height: 280px;" class="morris-chart"></div>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
