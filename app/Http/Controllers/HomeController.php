<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $events = Event::all();
        return view('welcome', compact('events'));
    }
    public function bookings(){
        $uid = Auth::id();
        $bookings = DB::table('bookings')->join('events', 'events.id', 'bookings.event_id')->where('bookings.user_id', $uid)->select('events.*')->paginate(2);
        return view('my_bookings', compact('bookings'));
    }
}
