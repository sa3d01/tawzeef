<div class="row">
    @foreach(\App\Models\User::whereType('COMPANY')->latest()->take(8)->get() as $company)
        <div class="col-xl-3 col-md-6">
            <div class="card-box widget-user">
                <div>
                    <div class="avatar-lg float-left mr-3">
                        <img src="{{$company->avatar}}" class="img-fluid rounded-circle" alt="user">
                    </div>
                    <div class="wid-u-info">
                        <h5 class="mt-0">{{$company->profile?$company->profile->foundation_name:""}}</h5>
                        <p class="text-muted mb-1 font-13 text-truncate">{{$company->email}}</p>
                        <small class="text-warning"><b>{{$company->major?$company->major->name_ar:""}}</b></small>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    @endforeach

</div>
<!-- end row -->
