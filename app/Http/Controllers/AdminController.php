<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'user')
            {
                return view('home.index');
            }
            elseif ($usertype == 'admin')
            {
                return view('admin.index');
            }
            else
            {
                return redirect()->back()->with('error', 'Unauthorized access');
            }
        }

    }

    public function home()
    {
        return view('home.index');
    }

    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {
        // Validate and process the room creation form submission
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|in:single,double,suite',
            'wifi' => 'required|string|in:yes,no',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        // Handle the room creation logic
        $data = new Room();
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->file('image');
        if ($image) {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }


        $data->save();

        return redirect()->back()->with('success', 'Room created successfully');
    }
    public function view_rooms()
    {
        $rooms = Room::all();
        return view('admin.view_rooms', compact('rooms'));
    }
    public function room_delete($id)
    {
        $room = Room::findOrFail($id);
        if ($room) {
            $room->delete();
            return redirect()->back()->with('success', 'Room deleted successfully');
        }
        return redirect()->back()->with('error', 'Room not found');
    }
    public function room_update($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.room_update', compact('room'));
    }
    public function edit_room($id)
    {
        $room = Room::findOrFail($id);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found');
        }

        $request = request();

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|in:single,double,suite',
            'wifi' => 'required|string|in:yes,no',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update the room details
        $room->room_title = $request->title;
        $room->description = $request->description;
        $room->price = $request->price;
        $room->wifi = $request->wifi;
        $room->room_type = $request->type;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $room->image = $imagename;
        }

        $room->save();

        return redirect()->route('view_rooms')->with('success', 'Room updated successfully');
    }
}
