<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\BookingList;

class BookingController extends Controller
{
    public function index() 
    {
        $booking = DB::table('booking_list')
                    ->select(DB::raw('guest_name as title, check_in as start, check_out as end'))
                    ->get();
        $arrbooking = $booking->toArray();

        return view('booking.index', (compact('arrbooking')));
    }

    public function create() 
    {
        return view('booking.create');
    }
}
