<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CenterManagements;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->paginate(100);
        //adding cwnter details insted of id 
         foreach ($notifications as $n) {
                $data = $n->data;
                if (!empty($data['center_id'])) {
                    $center = CenterManagements::find($data['center_id']);
                    $data['center_name'] = $center ? $center->center_name : 'Unknown';
                    $n->data = $data; 
                }
            }
            
    
        return view('notifications.index', compact('notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'notifiable_type' => 'required|string|max:255',
            'notifiable_id' => 'required|integer',
            'data' => 'required|json',
        ]);

        Notification::create([
            'id' => Str::uuid(),
            'type' => $request->type,
            'notifiable_type' => $request->notifiable_type,
            'notifiable_id' => $request->notifiable_id,
            'data' => $request->data,
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

}


