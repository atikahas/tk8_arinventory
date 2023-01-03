<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\BookingList;
use App\Models\ExpenseItem;

class HomeController extends Controller
{
    public function index() 
    {
        $booking = DB::table('booking_list')
                    ->select(DB::raw('guest_name as title, check_in as start, check_out as end'))
                    ->get();

        $arrbooking = $booking->toArray();

        // dd($arrbooking);

        return view('home.index', (compact('arrbooking')));
    }
}