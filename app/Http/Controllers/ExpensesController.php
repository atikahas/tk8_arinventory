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
        // $expenses = DB::select("
        //     select a.*,b.name category, c.name subcategory from expense_item a
        //     left join item_category b
        //     on a.category_id = b.id
        //     left join item_subcategory c
        //     on a.subcategory_id = c.id
        // ");

        $expenses = ExpenseItem::all();
        
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
        
        // dd($groups, $ecategory, $emonthfood, $emonthcutleries ,$resultcutleries);

        return view('expense.summary', (compact('ecategory')));
    }
}
