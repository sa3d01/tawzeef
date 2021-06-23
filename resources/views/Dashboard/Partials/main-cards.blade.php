{{--                CARDS--}}
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card-box">
            <h4 class="header-title mt-0 mb-4">المستخدمين</h4>
            <div class="widget-chart-1">
                <div class="widget-chart-box-1 float-left" dir="ltr">
                    <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                           data-bgColor="#eb346e" value="{{round(($new_users_count/$all_users_count)*100)}}"
                           data-skin="tron" data-angleOffset="180" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="widget-detail-1 text-right">
                    <h2 class="font-weight-normal pt-2 mb-1"> {{$new_users_count}} </h2>
                    <p class="text-muted mb-1">خلال هذا الأسبوع</p>
                </div>
            </div>
        </div>
    </div><!-- end col -->

</div>
<!-- end row -->
