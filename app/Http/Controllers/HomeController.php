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


        $barexpenses = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item) b
            on a.month = b.monthname)c
            group by month,category
            order by id)d
        ");
        $expenses = collect($barexpenses)->pluck('sumprice')->toArray();

        $barcategory = new ExpenseItem;
        $barcategory->max = (max(array_values($expenses)));
        $barcategory->stepsize = ((max(array_values($expenses))) / 5);   

        // dd($expenses);

        $barfnb = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item where category = 'FnB') b
            on a.month = b.monthname)c
            group by month
            order by id)d
        ");
        $resultbarfnb = collect($barfnb)->pluck('sumprice','month')->toArray();

        $barhousekeeping = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item where category = 'Housekeeping') b
            on a.month = b.monthname)c
            group by month
            order by id)d
        ");
        $resultbarhousekeeping = collect($barhousekeeping)->pluck('sumprice','month')->toArray();

        $barmaintenance = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item where category = 'Maintenance') b
            on a.month = b.monthname)c
            group by month
            order by id)d
        ");
        $resultmaintenance = collect($barmaintenance)->pluck('sumprice','month')->toArray();

        $barlandscape = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item where category = 'Landscape') b
            on a.month = b.monthname)c
            group by month
            order by id)d
        ");
        $resultlandscape = collect($barlandscape)->pluck('sumprice','month')->toArray();

        $barstaff = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item where category = 'Staff') b
            on a.month = b.monthname)c
            group by month
            order by id)d
        ");
        $resultstaff = collect($barstaff)->pluck('sumprice','month')->toArray();

        $barlain = DB::select("
            select month, round(sumprice,2) as sumprice from    
            (select id, month, category, sum(total_price) as sumprice, purchase_date from
            (select * from dd_month a
            left join 
            (select category,total_price, monthname(purchase_date) as monthname, purchase_date from expense_item where category = 'Lain-lain') b
            on a.month = b.monthname)c
            group by month
            order by id)d
        ");
        $resultlain = collect($barlain)->pluck('sumprice','month')->toArray();

        $barmonthlabel = new ExpenseItem;
        $barmonthlabel->labels = (array_keys($resultbarfnb));

        $barmonthdata = new ExpenseItem;
        $barmonthdata->max = (max(array_values($expenses)));
        $barmonthdata->fnb = (array_values($resultbarfnb));
        $barmonthdata->hk = (array_values($resultbarhousekeeping));
        $barmonthdata->maintenance = (array_values($resultmaintenance));
        $barmonthdata->landscape = (array_values($resultlandscape));
        $barmonthdata->staff = (array_values($resultstaff));
        $barmonthdata->lain = (array_values($resultlain));

        $ttlcurrybooking = BookingList::select(DB::raw('count(*) as totalyear'))
                    ->whereRaw('year(check_out) = year(curdate())')
                    ->count();

        $ttlcurrmbooking = BookingList::select(DB::raw('count(*) as totalmonth'))
                    ->whereRaw('month(check_out) = month(curdate())')
                    ->count();

        // dd($ttlcurrbooking);

        return view('home.index', (compact(
            'ttlitems',
            'ttllowitems',
            'ttlnoitems',
            'items',
            'lowitems',
            'noitems',
            'barmonthlabel',
            'barmonthdata',
            'barcategory',
            'ttlcurrybooking',
            'ttlcurrmbooking'
            )
        ));
    }
}