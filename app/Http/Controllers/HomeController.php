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
        
        //Summary items
        $ttlitems = ItemList::count();
        $ttllowitems = ItemList::select(DB::raw('((current_stock/initial_stock)*100) percent_stock '))
                    ->whereRaw('((current_stock/initial_stock)*100) <= 50 and ((current_stock/initial_stock)*100) > 25')
                    ->count();
        $ttlnoitems = ItemList::select(DB::raw('((current_stock/initial_stock)*100) percent_stock '))
                    ->whereRaw('((current_stock/initial_stock)*100) <= 25')
                    ->count();

        $items = DB::select("
            select * from
            (select a.id,a.location_id,b.name location,a.category_id,a.subcategory_id,c.name category,a.item_name,a.initial_stock,a.current_stock,((a.current_stock/a.initial_stock)*100) percent_stock from item_list a
            left join item_location b
            on a.location_id = b.id
            left join item_category c
            on a.category_id = c.id)e
            where percent_stock > 50
        ");

        $lowitems = DB::select("
            select * from
            (select a.id,a.location_id,b.name location,a.category_id,a.subcategory_id,c.name category,a.item_name,a.initial_stock,a.current_stock,((a.current_stock/a.initial_stock)*100) percent_stock from item_list a
            left join item_location b
            on a.location_id = b.id
            left join item_category c
            on a.category_id = c.id)e
            where percent_stock <= 50 and percent_stock > 25
        ");

        $noitems = DB::select("
            select * from
            (select a.id,a.location_id,b.name location,a.category_id,a.subcategory_id,c.name category,a.item_name,a.initial_stock,a.current_stock,((a.current_stock/a.initial_stock)*100) percent_stock from item_list a
            left join item_location b
            on a.location_id = b.id
            left join item_category c
            on a.category_id = c.id)e
            where percent_stock <= 25
        ");

        // dd($ttllowitems,$ttlnoitems);

        return view('home.index', (compact('ttlitems','ttllowitems','ttlnoitems','items','lowitems','noitems')));
    }
}