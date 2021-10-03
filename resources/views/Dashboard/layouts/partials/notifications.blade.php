<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
        <i class="fe-bell noti-icon"></i>
        <span class="badge badge-danger rounded-circle noti-icon-badge">{{$unread_notifications_count}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
        <!-- item-->
        @if(count($notifications)>0)
        <div class="dropdown-item noti-title">
            <h5 class="m-0">
                <span class="float-right">
                    <a href="{{route('admin.clear-all-notifications')}}" class="text-dark">
                        <small>حذف الكل</small>
                    </a>
                </span>الإشعارات
            </h5>
        </div>
        @endif
        @if(count($notifications)>0)
        <div class="slimscroll noti-scroll">

        </div>
        @else
            <div class="slimscroll noti-scroll">
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <div class="notify-icon bg-primary">
                        <i class="mdi mdi-bed-empty"></i>
                    </div>
                    <p class="notify-details"> ! ﻻ يوجد اشعارات جديدة</p>
                </a>
            </div>
        @endif
    </div>
</li>
