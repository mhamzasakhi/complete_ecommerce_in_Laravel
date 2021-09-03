<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Notification;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->paginate(25);
        return view('admin-views.notification.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'title is required!',
        ]);

        $notification = new Notification;
        $notification->title = $request->title;
        $notification->description = $request->description;

        if ($request->has('image')) {
            $notification->image = ImageManager::upload('notification/', 'png', $request->file('image'));
        } else {
            $notification->image = 'null';
        }

        $notification->status = 1;
        $notification->save();

        try {
            Helpers::send_push_notif_to_topic($notification);
        } catch (\Exception $e) {
            Toastr::warning('Push notification failed!');
        }

        Toastr::success('Notification sent successfully!');
        return back();
    }

    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('admin-views.notification.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'title is required!',
        ]);

        $notification = Notification::find($id);
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->image = ImageManager::update('notification/', $notification->image, 'png', $request->file('image'));
        $notification->save();

        Toastr::success('Notification updated successfully!');
        return back();
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $notification = Notification::find($request->id);
            $notification->status = $request->status;
            $notification->save();
            $data = $request->status;
            return response()->json($data);
        }
    }

    public function delete(Request $request)
    {
        $notification = Notification::find($request->id);
        ImageManager::delete('/notification/' . $notification['image']);
        $notification->delete();
        return response()->json();
    }
}
