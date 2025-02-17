<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    
    public function book_ticket(Request $request){
        $evId = $request->event_id; 

        // checking if seats available 
        $event = Event::where('id', $evId)->where('seats_count', '>', 0)->first();
        if ($event) {
            $event->decrement('seats_count'); // decrement 1 seat count 

            // new booking 
            $booking = new Booking;
            $booking->user_id = Auth::id();
            $booking->event_id =  $evId;
            $booking->save();

            // on success 
            return response()->json(['status' => true, 'msg' => 'Ticket Booked Successfully.']);
        }else{
            // seats not available 
            return response()->json(['status' => false, 'msg' => 'Seats not available']);
        }
    }
}
