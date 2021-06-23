@extends('Dashboard.layouts.master')
@section('title', 'الإحصائيات')
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('Dashboard.Partials.main-cards')
            @include('Dashboard.Partials.charts')
            @include('Dashboard.Partials.new_companies')
            @include('Dashboard.Partials.new_jobs')
        </div>
    </div>
@endsection
@section('script')
    <script>
        let users=document.getElementById('morris-donut-users').getAttribute('data-users');
        let companies=document.getElementById('morris-donut-users').getAttribute('data-companies');
        Morris.Donut({
            element: 'morris-donut-users',
            resize: true,
            colors: [
                '#f05050',
                '#648b55',
            ],
            data: [
                {label:"المستخدمين", value:users},
                {label:"الشركات", value:companies},
            ]
        });


        let jobs=[];
        let last_week_jobs=$('#last_week_jobs');
        last_week_jobs.find('div').each(function(){
            let obj = JSON.parse($(this).attr('data-job'));
            jobs.push(obj);
        });
        const groups = jobs.reduce((dates, job) => {
            const date =new Date(job.created_at).getDate();
            if (!dates[date]) {
                dates[date] = [];
            }
            dates[date].push(job);
            return dates;
        }, {});
        const groupArrays = Object.keys(groups).map((date) => {
            return {
                date,
                jobs: groups[date]
            };
        });
        let jobs_data=[];
        let active_jobs=0;
        let expired_jobs=0;
        let i=0;
        let o=0;
        let now=new Date();
        for (i ; i<groupArrays.length ; i++){
            for (o ; o<groupArrays[i]['jobs'].length ; o++){
                var end_date=groupArrays[i]['jobs'][o].end_date;
                var end_date_stamp=Date.parse(end_date);
                if (new Date(end_date_stamp).toLocaleDateString() > now.toLocaleDateString()){
                    active_jobs++;
                }else{
                    expired_jobs++;
                }
            }
            jobs_data.push({ day: groupArrays[i]['date'],active: active_jobs, expired: expired_jobs});
            o=0;
            active_jobs=0;
            expired_jobs=0;
        }
        console.log(jobs_data)
        new Morris.Line({
            element: 'morris-line-jobs',
            data: jobs_data,
            xkey: 'day',
            parseTime: false,
            ykeys: ['active','expired'],
            labels: ['active','expired'],
            lineColors: ['#214185','#db110d']
        });
    </script>
@endsection
