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

    public function store(Request $request) {
        try {
            $data = $request->all();
            $data['created_by'] = Auth::user()->id;
            $booking = BookingList::create($data);

            return redirect()->route('booking.index')->withSuccess(__('Info booking added successfully.'));

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
