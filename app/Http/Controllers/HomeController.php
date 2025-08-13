<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::findOrFail($id);
        return view('home.room_details', compact('room'));
    }

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
}
