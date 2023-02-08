<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\ExpenseItem;
use App\Models\ExpenseReport;

class ExpensesController extends Controller
{
    public function index() 
    {
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

    public function edit(ExpenseItem $expense)
    {
        return view('expense.edit', ['expense' => $expense]);
    }

    public function update(Request $request, ExpenseItem $expense)
    {
        $data = $request->except(['_token']);
        $data['updated_by'] = Auth::user()->id;
        $expense->update($data);

        return redirect()->route('expenses.index')->withSuccess(__('Items updated successfully.'));
    }

    public function destroy(Request $request, ExpenseItem $expense) {
        try {
            $expense->delete();
            return response()->json(['status' => 'success', 'message' => 'Item Deleted']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function summary() 
    {

        return view('expense.summary');
    }

    public function report() 
    {
        // $expensesreport = ExpenseReport::all();
        // $expensesreport1 = DB::select("
        //     select id,title,month,year
        //     from
        //     (select * from
        //     (select title,monthyear, SUBSTRING(monthyear, 6, 7) as monthno, SUBSTRING(monthyear, 1, 4) as year from expense_report)a
        //     left join dd_month b
        //     on a.monthno = b.id)c
        // ");

        $expenses = ExpenseReport::selectRaw('id,title,SUBSTRING(monthyear, 6, 7) as monthno, SUBSTRING(monthyear, 1, 4) as year')->get();

        // dd($expensesreport,$expensesreport1, $expenses);

        return view('expense.report', (compact('expenses')));
    }

    public function createreport() 
    {
        return view('expense.create-report');
    }

    public function storereport(Request $request) {
        try {
            $data = $request->all();
            $data['created_by'] = Auth::user()->id;
            $expenses = ExpenseReport::create($data);

            return redirect()->route('expenses.create.report')->withSuccess(__('Report expenses created successfully.'));

        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function showreport(ExpenseReport $expenses)
    {
        $expenseslist = DB::select("
        select * from expense_item
        where SUBSTRING(purchase_date, 1, 7) = '".$expenses->monthyear."'
        ");

        $expensescategory = DB::select("
        select * from expense_item
        where SUBSTRING(purchase_date, 1, 7) = '".$expenses->monthyear."'
        group by category
        ");

        $expensessubcategory = DB::select("
        select * from expense_item
        where SUBSTRING(purchase_date, 1, 7) = '".$expenses->monthyear."'
        group by category,subcategory
        ");

        $expensesitem = DB::select("
        select *, sum(quantity) totalquantity, sum(total_price) sumprice from expense_item
        where SUBSTRING(purchase_date, 1, 7) = '".$expenses->monthyear."'
        group by category,subcategory,item_name
        ");

        $expensetotal= DB::select("
        select *,sum(total_price) sumprice from expense_item
        where SUBSTRING(purchase_date, 1, 7) = '".$expenses->monthyear."'
        group by category
        ");

        $expensesum = DB::select("
        select sum(total_price) sumprice  from expense_item
        where SUBSTRING(purchase_date, 1, 7) = '".$expenses->monthyear."'
        ");

        // dd($expensesitem);

        return view('expense.show-report', [
            'expenses'=> $expenses,
            'expensescategory' => $expensescategory,
            'expensessubcategory' => $expensessubcategory,
            'expensesitem' => $expensesitem,
            'expenseslist' => $expenseslist,
            'expensetotal' => $expensetotal,
            'expensesum' => $expensesum
        ]);
    }
}
