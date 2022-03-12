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

class CompanyController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('type','COMPANY')->latest()->get();
        return view('Dashboard.company.index', compact('rows'));
    }
    public function show($id):object
    {
        $user=$this->model->find($id);
        return view('Dashboard.company.show', compact('user'));
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
