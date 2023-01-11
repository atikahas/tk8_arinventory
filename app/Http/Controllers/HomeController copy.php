<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BookingList;
use App\Models\ExpenseItem;
use App\Models\ItemList;

class HomeController extends Controller
{
    public function index() 
    {
        $booking = DB::table('booking_list')
                    ->select(DB::raw('guest_name as title, check_in as start, check_out as end'))
                    ->get();

        $arrbooking = $booking->toArray();

        $ttlcurrentbooking = DB::table('booking_list')->whereRaw('month(check_out) = MONTH(CURRENT_TIMESTAMP)')->count();

        $ttlcurrentpax = BookingList::whereRaw('month(check_out) = MONTH(CURRENT_TIMESTAMP)')->sum('guest_pax');

        $ttlitemtype = DB::select("
            select category, count(*) as ttl from
            (select a.category_id,b.id,b.name as category from `item_list` a
            left join item_category b
            on a.`category_id` = b.id)c
            group by category_id
        ");

        $summaryhousekeeping = DB::select("
            select * from
            (select a.id,a.location_id,b.name location,a.category_id,a.subcategory_id,c.name category,a.item_name,a.initial_stock,a.current_stock,((a.current_stock/a.initial_stock)*100) percent_stock from item_list a
            left join item_location b
            on a.location_id = b.id
            left join item_category c
            on a.category_id = c.id)e
            where percent_stock < 50 and category = 'Housekeeping'
        ");

        $summarycutleries = DB::select("
            select * from
            (select a.id,a.location_id,b.name location,a.category_id,a.subcategory_id,c.name category,a.item_name,a.initial_stock,a.current_stock,((a.current_stock/a.initial_stock)*100) percent_stock from item_list a
            left join item_location b
            on a.location_id = b.id
            left join item_category c
            on a.category_id = c.id)e
            where percent_stock < 50 and category = 'Cutleries'
        ");

        return view('home.index', (compact('arrbooking','ttlcurrentbooking','ttlcurrentpax','ttlitemtype','summaryhousekeeping', 'summarycutleries')));
    }
}