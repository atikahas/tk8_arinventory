<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\ExpenseItem;

class ExpensesController extends Controller
{
    public function index() 
    {
        $expenses = DB::select("
            select a.*,b.name category, c.name subcategory from expense_item a
            left join item_category b
            on a.category_id = b.id
            left join item_subcategory c
            on a.subcategory_id = c.id
        ");

        return view('expense.index', (compact('expenses')));
    }

    public function create() 
    {
        return view('expense.create');
    }

    public function store(Request $request) {
        try {
            if($request->has('expenses')) {
                foreach($request->input('expenses') as $expenses) {
                    $expenses['created_by'] = Auth::user()->id;
                    ExpenseItem::create($expenses);
                }
            }

            return redirect()->route('expenses.create')->withSuccess(__('List expenses added successfully.'));

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function summary() 
    {
        $ecategory = DB::select("
            select category, sum(total_price) sumprice from
            (select a.*,b.name category, c.name subcategory from expense_item a
            left join item_category b
            on a.category_id = b.id
            left join item_subcategory c
            on a.subcategory_id = c.id)d
            group by category
        ");

        $groups = DB::table('expense_item')
                  ->select('category_id', DB::raw('round(sum(total_price), 2) as total, item_category.name as category'))
                  ->leftJoin('item_category', 'expense_item.category_id', '=', 'item_category.id')
                  ->groupBy('category_id')
                  ->pluck('total', 'category')->all();

        $polarcategory = new ExpenseItem;
        $polarcategory->labels = (array_keys($groups));
        $polarcategory->dataset = (array_values($groups));
        $polarcategory->max = (max(array_values($groups)));
        $polarcategory->stepsize = ((max(array_values($groups))) / 5);      

        $emonthasset = DB::table('expense_item')
                  ->select('category_id', DB::raw('round(sum(total_price), 2) as total, item_category.name as category, monthname(expense_item.purchase_date) as month'))
                  ->leftJoin('item_category', 'expense_item.category_id', '=', 'item_category.id')
                  ->groupBy('month')
                  ->groupBy('category')
                  ->where('category_id','1')
                  ->pluck('total', 'month')->all();

         $emonthcutleries = DB::select("
                SELECT a.MONTH as bulan,b.id,`name`,c.total
                FROM
                (SELECT 1 a,MONTH FROM `ar_inventory`.`dd_month`) a
                LEFT JOIN
                (SELECT 1 a,id,`name` FROM `ar_inventory`.`item_category`) b
                USING(a)
                LEFT JOIN
                (SELECT `category_id` id,MONTHNAME(purchase_date) MONTH,ROUND(SUM(total_price),2) total FROM `ar_inventory`.`expense_item`
                GROUP BY `category_id`,MONTHNAME(purchase_date)) c
                USING(id,MONTH)
                where name='Cutleries'
            ");
        $resultcutleries = collect($emonthcutleries)->pluck('total','bulan')->toArray();

        $emonthfacility = DB::table('expense_item')
                  ->select('category_id', DB::raw('round(sum(total_price), 2) as total, item_category.name as category, monthname(expense_item.purchase_date) as month'))
                  ->leftJoin('item_category', 'expense_item.category_id', '=', 'item_category.id')
                  ->groupBy('month')
                  ->groupBy('category')
                  ->where('category_id','3')
                  ->pluck('total', 'month')->all();

        $emonthfood = DB::table('expense_item')
                  ->select('category_id', DB::raw('round(sum(total_price), 2) as total, item_category.name as category, monthname(expense_item.purchase_date) as month'))
                  ->leftJoin('item_category', 'expense_item.category_id', '=', 'item_category.id')
                  ->groupBy('month')
                  ->groupBy('category')
                  ->where('category_id','4')
                  ->pluck('total', 'month')->all();

        $emonthmaintenance = DB::select("
                SELECT a.MONTH as bulan,b.id,`name`,c.total
                FROM
                (SELECT 1 a,MONTH FROM `ar_inventory`.`dd_month`) a
                LEFT JOIN
                (SELECT 1 a,id,`name` FROM `ar_inventory`.`item_category`) b
                USING(a)
                LEFT JOIN
                (SELECT `category_id` id,MONTHNAME(purchase_date) MONTH,ROUND(SUM(total_price),2) total FROM `ar_inventory`.`expense_item`
                GROUP BY `category_id`,MONTHNAME(purchase_date)) c
                USING(id,MONTH)
                where name='Maintenance'
            ");
          $resultmaintenance = collect($emonthmaintenance)->pluck('total','bulan')->toArray();

        $barmonthlabel = new ExpenseItem;
        $barmonthlabel->labels = (array_keys($resultcutleries));

        $barmonthdata = new ExpenseItem;
        $barmonthdata->max = (max(array_values($groups)));
        $barmonthdata->asset = (array_values($emonthasset));
        $barmonthdata->cutleries = (array_values($resultcutleries));
        $barmonthdata->maintenance = (array_values($resultmaintenance));

        

        // dd($groups, $ecategory, $emonthfood, $emonthcutleries ,$resultcutleries);

        return view('expense.summary', (compact('ecategory','polarcategory','barmonthlabel','barmonthdata')));
    }
}
