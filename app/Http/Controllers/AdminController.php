<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallary;
use App\Models\Contact;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function index()
    {
        if (Auth::id())
        {
            $usertype = Auth()->user()->usertype;
            if ($usertype == 'user')
            {
                // Show user home page
                $room = Room::all();

                $gallary = Gallary::all();

                return view('home.index', compact('room', 'gallary'));
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
    // Show the home page
    public function home()
    {
        $gallary = Gallary::all();
        $room = Room::all();
        return view('home.index', compact('room', 'gallary'));
    }

    // Show the create room form
    public function create_room()
    {
        return view('admin.create_room');
    }

    // Handle the room creation logic
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

    // Show the view rooms page
    public function view_rooms()
    {
        $rooms = Room::all();
        return view('admin.view_rooms', compact('rooms'));
    }

    // Handle the room deletion logic
    public function room_delete($id)
    {
        $room = Room::findOrFail($id);
        if ($room) {
            $room->delete();
            return redirect()->back()->with('success', 'Room deleted successfully');
        }
        return redirect()->back()->with('error', 'Room not found');
    }

    // Show the room update form
    public function room_update($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.room_update', compact('room'));
    }

    // Handle the room update logic
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

    // View all bookings
    public function bookings()
    {
        $bookings = Booking::all();
        return view('admin.booking', compact('bookings'));
    }

    // Handle the booking deletion logic
    public function delete_booking($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking) {
            $booking->delete();
            return redirect()->back()->with('success', 'Booking deleted successfully');
        }
        return redirect()->back()->with('error', 'Booking not found');
    }

    // Handle the booking approval logic
    public function approve_booking($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking) {
            $booking->status = 'Approved';
            $booking->save();
            return redirect()->back()->with('success', 'Booking approved successfully');
        }
        return redirect()->back()->with('error', 'Booking not found');
    }

    // Handle the booking rejection logic
    public function reject_booking($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking) {
            $booking->status = 'Rejected';
            $booking->save();
            return redirect()->back()->with('success', 'Booking rejected successfully');
        }
        return redirect()->back()->with('error', 'Booking not found');
    }

    // View the gallery
    public function view_gallary()
    {
        $gallary = Gallary::all();
        return view('admin.gallary', compact('gallary'));
    }

    // Handle the add gallery logic
    public function add_gallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('gallery', $imagename);

        $gallery = new Gallary();
        $gallery->image = $imagename;
        $gallery->save();

        return redirect()->back()->with('success', 'Image added to gallery successfully');
    }

    // Handle the delete gallery logic
    public function delete_gallery($id)
    {
        $gallery = Gallary::findOrFail($id);
        if ($gallery) {
            $gallery->delete();
            return redirect()->back()->with('success', 'Image deleted from gallery successfully');
        }
        return redirect()->back()->with('error', 'Image not found');
    }

    // View messages
    public function messages()
    {
        $messages = Contact::all();
        return view('admin.messages', compact('messages'));
    }

    // View mails
    public function send_mail($id)
    {
        $message = Contact::findOrFail($id);
        return view('admin.send_mail', compact('message'));
    }

    // Handle the mail sending logic
    public function mail(Request $request, $id)
    {
        $message = Contact::findOrFail($id);

        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'endline' => $request->endline
        ];
        Notification::send($message, new SendEmailNotification($details));
        return redirect()->back()->with('success', 'Mail sent successfully');

    }
}
