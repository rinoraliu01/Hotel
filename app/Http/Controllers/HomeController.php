<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallary;
use App\Models\Contact;

class HomeController extends Controller
{

        /**
     * Show the "Our Rooms" page.
     */
    public function our_rooms()
    {
        $room = Room::all();
        return view('home.our_rooms', compact('room'));
    }

    /**
     * Show the "Hotel Gallery" page.
     */
    public function hotel_gallery()
    {
        $gallary = Gallary::all();
        return view('home.hotel_gallery', compact('gallary'));
    }

    /**
     * Show the "Hotel Contact" page.
     */
    public function hotel_contact()
    {
        return view('home.hotel_contact');
    }

    /**
     * Show the details of a specific room.
     */
    public function room_details($id)
    {
        $room = Room::findOrFail($id);
        return view('home.room_details', compact('room'));
    }

    /**
     * Handle the booking of a room.
     */
    public function add_booking(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($id);

        $booking = new Booking();
        $booking->room_id = $room->id;
        $booking->name = $request->input('name');
        $booking->email = $request->input('email');
        $booking->phone = $request->input('phone');

        $check_in = $request->input('check_in');
        $check_out = $request->input('check_out');
        // Check if the room is already booked for the given dates
        $isBooked = Booking::where('room_id',$id)
        ->where('check_in','<=',$check_out)
        ->where('check_out','>=',$check_in)
        ->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'Room is already booked for the selected dates.');
        }
        else
        {
            $booking->check_in = $request->input('check_in');
            $booking->check_out = $request->input('check_out');
            $booking->save();

            return redirect()->back()->with('success', 'Room booked successfully!');
        }

    }

    /**
     * Handle contact form submission.
     */
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->message = $request->input('message');
        $contact->save();

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }


}
