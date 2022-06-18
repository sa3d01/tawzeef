<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogSeen;
use App\Models\CompanySeen;
use App\Models\Contact;
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobRequired;
use App\Models\JobSubscribe;
use App\Models\Membership;
use App\Models\Message;
use App\Models\Notification;
use App\Models\PremiumRequest;
use App\Models\Profile;
use App\Models\Qualification;
use App\Models\Skill;
use App\Models\Socials;
use App\Models\TrainingCourse;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    // todo:fetch users excel

    public function allUsers(Request $request)
    {
        $columns_list = array(
            0 =>'id',
            1 =>'name',
            2 =>'phone',
            3=> 'email',
            4=> 'major',
            5=> 'city',
            6=> 'hear_by',
            7=> 'completedProfileRatio',
            8=> 'status',
            9=> 'options',
        );

        $totalDataRecord = User::whereType('USER')->where('deleted_at',null)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $user_data = User::whereType('USER')->where('deleted_at',null)->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        }
        else {
            $search_text = $request->input('search.value');

            $user_data =  User::whereType('USER')->where('deleted_at',null)->where('phone','LIKE',"%{$search_text}%")
                ->orWhere('email', 'LIKE',"%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();

            $totalFilteredRecord = User::whereType('USER')->where('deleted_at',null)->where('phone','LIKE',"%{$search_text}%")
                ->orWhere('email', 'LIKE',"%{$search_text}%")
                ->count();
        }

        $data_val = array();
        if(!empty($user_data))
        {
            foreach ($user_data as $user_val)
            {
                $datashow =  route('admin.user.show',$user_val->id);
                $dataedit =  route('admin.user.edit',$user_val->id);
                if ($user_val->banned==0){
                    $statusClass=' badge-success ';
                    $statusText=' مفعل ';
                }else{
                    $statusClass=' badge-danger ';
                    $statusText=' غير مفعل ';
                }
//        {{--                                            @if($row->banned==0)--}}
//        {{--                                                <form class="ban" data-id="{{$row->id}}" data-signature="ban#{{$row->id}}" method="POST" action="{{ route('admin.user.ban',[$row->id]) }}">--}}
//        {{--                                                    @csrf--}}
//        {{--                                                    {{ method_field('POST') }}--}}
//        {{--                                                    <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-archive mr-1"></i> <span>حظر</span> </button>--}}
//        {{--                                                </form>--}}
//        {{--                                            @else--}}
//        {{--                                                <form class="activate" data-id="{{$row->id}}" data-signature="activate#{{$row->id}}" method="POST" action="{{ route('admin.user.activate',[$row->id]) }}">--}}
//        {{--                                                    @csrf--}}
//        {{--                                                    {{ method_field('POST') }}--}}
//        {{--                                                    <button class="btn btn-success waves-effect waves-light"> <i class="fa fa-user-clock mr-1"></i> <span>تفعيل</span> </button>--}}
//        {{--                                                </form>--}}
//        {{--                                            @endif--}}
//        {{--                                            <form class="delete" data-id="{{$row->id}}" data-signature="delete#{{$row->id}}" method="POST" action="{{ route('admin.user.destroy',[$row->id]) }}">--}}
//        {{--                                                @csrf--}}
//        {{--                                                {{ method_field('DELETE') }}--}}
//        {{--                                                <button class="btn btn-danger waves-effect waves-light"> <i class="fa fa-trash"></i> <span>حذف</span> </button>--}}
//        {{--                                            </form>--}}
                $usernestedData['id'] = $user_val->id;
                $usernestedData['name'] = $user_val->name();
                $usernestedData['phone'] = $user_val->phone;
                $usernestedData['email'] = $user_val->email;
                $usernestedData['major'] = $user_val->major->name_ar;
                $usernestedData['city'] = $user_val->city->name_ar;
                $usernestedData['hear_by'] = $user_val->hear_by->name_ar;
                $usernestedData['completedProfileRatio'] = $user_val->completedProfileRatio();
                $usernestedData['status'] = "&emsp;<span class='badge {$statusClass}'>{$statusText}</span>";
                $usernestedData['options'] = "&emsp;<div class='button-list'>&emsp;<a href='{$datashow}'><button class='btn btn-info waves-effect waves-light'><i class='fa fa-eye mr-1'></i><span>عرض</span></button></a></div>";
//                $usernestedData['options'] = "&emsp;<a href='{$datashow}' class='showdata' title='SHOW DATA' ><span class='showdata glyphicon glyphicon-list'></span></a>&emsp;<a href='{$dataedit}' class='editdata' title='EDIT DATA' ><span class='editdata glyphicon glyphicon-edit'></span></a>";
                $data_val[] = $usernestedData;

            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );
        return json_encode($get_json_data);
    }
    public function index()
    {
       //$rows = User::where('type','USER')->paginate(300);
        return view('Dashboard.user.index');
    }
    public function show($id):object
    {
        $user=$this->model->find($id);
        return view('Dashboard.user.show', compact('user'));
    }
    public function ban($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'banned'=>1,
            ]
        );
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'banned'=>0,
            ]
        );
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }

    public function approve($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'approved'=>1,
            ]
        );
        $user->refresh();
        $user->refresh();
        return redirect()->back()->with('updated');
    }

    public function destroy($id)
    {
        $user=$this->model->find($id);
        $this->relatedTablesToUser($id);
        $user->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }
    public function relatedTablesToUser($user_id)
    {
        $banks=Bank::where('user_id',$user_id)->get();
        foreach ($banks as $bank){
            $bank->delete();
        }
        $blogs=Blog::where('writer_id',$user_id)->get();
        foreach ($blogs as $blog){
            $blog->delete();
        }
        $blog_comments=BlogComment::where('user_id',$user_id)->get();
        foreach ($blog_comments as $blog_comment){
            $blog_comment->delete();
        }
        $blog_seen=BlogSeen::where('user_id',$user_id)->get();
        foreach ($blog_seen as $blog_seen_1){
            $blog_seen_1->delete();
        }
        $company_seen=CompanySeen::where('user_id',$user_id)->get();
        foreach ($company_seen as $company_seen_1){
            $company_seen_1->delete();
        }
        $contacts=Contact::where('user_id',$user_id)->get();
        foreach ($contacts as $contact){
            $contact->delete();
        }
        $cvs=Cv::where('user_id',$user_id)->get();
        foreach ($cvs as $cv){
            $cv->delete();
        }
        $experiences=Experience::where('user_id',$user_id)->get();
        foreach ($experiences as $experience){
            $experience->delete();
        }
        $jobs=Job::where('company_id',$user_id)->get();
        foreach ($jobs as $job){
            $job->delete();
        }
        $job_requiredes=JobRequired::where('user_id',$user_id)->get();
        foreach ($job_requiredes as $job_requirede){
            $job_requirede->delete();
        }
        $job_subscribes=JobSubscribe::where('user_id',$user_id)->get();
        foreach ($job_subscribes as $job_subscribe){
            $job_subscribe->delete();
        }
        $memberships=Membership::where('user_id',$user_id)->get();
        foreach ($memberships as $membership){
            $membership->delete();
        }
        $messages_senders=Message::where('sender_id',$user_id)->get();
        foreach ($messages_senders as $messages_sender){
            $messages_sender->delete();
        }
        $messages_receivers=Message::where('receiver_id',$user_id)->get();
        foreach ($messages_receivers as $messages_receiver){
            $messages_receiver->delete();
        }
        $notifications=Notification::where('receiver_id',$user_id)->get();
        foreach ($notifications as $notification){
            $notification->delete();
        }
        $premium_requests=PremiumRequest::where('user_id',$user_id)->get();
        foreach ($premium_requests as $premium_request){
            $premium_request->delete();
        }
        $profiles=Profile::where('user_id',$user_id)->get();
        foreach ($profiles as $profile){
            $profile->delete();
        }
        $qualifications=Qualification::where('user_id',$user_id)->get();
        foreach ($qualifications as $qualification){
            $qualification->delete();
        }
        $skills=Skill::where('user_id',$user_id)->get();
        foreach ($skills as $skill){
            $skill->delete();
        }
        $socials=Socials::where('user_id',$user_id)->get();
        foreach ($socials as $social){
            $social->delete();
        }
        $training_courses=TrainingCourse::where('user_id',$user_id)->get();
        foreach ($training_courses as $training_course){
            $training_course->delete();
        }
        $verifies=VerifyUser::where('user_id',$user_id)->get();
        foreach ($verifies as $verifie){
            $verifie->delete();
        }
    }


}
