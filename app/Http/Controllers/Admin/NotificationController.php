<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends MasterController
{
    public function __construct(Notification $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function clearAdminNotifications()
    {
        $unread_notifications = Notification::where(['type' => 'admin', 'read' => 'false'])->get();
        foreach ($unread_notifications as $unread_notification) {
            $unread_notification->update([
                'read' => 'true'
            ]);
        }
        return redirect()->back();
    }

    public function readNotification($id)
    {
        $unread_notification = Notification::find($id);
        $unread_notification->update([
            'read' => 'true'
        ]);
        return redirect()->back();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.notification.index', compact('rows'));
    }

    public function store(Request $request)
    {
        $data['title'] = 'رسالة إدارية';
        $data['note_ar'] = $request['note_ar'];
        $data['note_en'] = $request['note_en'];
        foreach ($request['types'] as $type) {
            $usersIds = User::where('type', $type)->pluck('id')->toArray();
            $this->model->create([
                'receivers' => $usersIds,
                'admin_notify_type' => $type,
                'type' => 'admin',
                'note_ar' => $data['note_ar'],
                'note_en' => $data['note_en']
            ]);
        }
        return redirect()->back()->with('success', 'تم الارسال بنجاح');
    }
}
