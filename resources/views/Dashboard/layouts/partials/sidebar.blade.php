<div id="sidebar-menu">
    <ul class="metismenu" id="side-menu">
        <li class="menu-title">محتويات النظام</li>
        <li>
            <a href="{{route('admin.home')}}">
                <i class="mdi mdi-view-dashboard"></i>
                <span> الرئيسية </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.user.index')}}">
                <i class="mdi mdi-human"></i>
                <span> إدارة المستخدمين </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.company.index')}}">
                <i class="mdi mdi-desktop-tower"></i>
                <span> إدارة الشركات </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.major.index')}}">
                <i class="mdi mdi-access-point"></i>
                <span> إدارة التخصصات </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.contact.index')}}">
                <i class="mdi mdi-mailbox"></i>
                <span> إدارة رسائل التواصل </span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);">
                <i class="mdi mdi-share-variant"></i>
                <span> إعدادات أخرى </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level nav" aria-expanded="false">
                <li>
                    <a href="{{route('admin.settings.edit')}}">الإعدادات العامة</a>
                </li>
                <li>
                    <a href="{{route('admin.bank.index')}}">الحسابات البنكية</a>
                </li>
                <li>
                    <a href="{{route('admin.contact_type.index')}}">أنواع التواصل</a>
                </li>
                <li>
                    <a href="{{route('admin.hiring_agent.index')}}">وكالات التوظيف</a>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">الصفحات
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'about','for'=>'all'])}}">عن التطبيق</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'bank','for'=>'all'])}}"> صفحة الحسابات البنكية</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'contact','for'=>'all'])}}"> تواصل معنا</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'hiring_principles','for'=>'all'])}}">مبدأ عمل التوظيف</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'who_finding_jobs','for'=>'all'])}}">أشخاص وجدوا وظائف</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'terms','for'=>'user'])}}">الشروط والأحكام للموظفين</a>
                        </li>
                        <li>
                            <a href="{{route('admin.page.edit',['type'=>'terms','for'=>'company'])}}">الشروط والأحكام للشركات</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" aria-expanded="false">الدول والمدن
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-third-level nav" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.city.index')}}">المدن</a>
                        </li>
                        <li>
                            <a href="{{route('admin.country.index')}}">الدول</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

    </ul>

</div>
