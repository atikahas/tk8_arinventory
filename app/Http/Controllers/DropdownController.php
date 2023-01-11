<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    public function getLocation(Request $request) {
        $location = DB::table('item_location')->where($request->all())->get();
        return response()->json($location);
    }

    public function getCategory(Request $request) {
        $category = DB::table('item_category')->where('id','!=','4')->where('id','!=','5')->get();
        return response()->json($category);
    }

    public function getCategoryExpenses(Request $request) {
        $category = DB::table('item_category')->where($request->all())->get();
        return response()->json($category);
    }

    public function getSubCategory(Request $request) {
        $subcategory = DB::table('item_subcategory')->where($request->all())->get();
        return response()->json($subcategory);
    }

    public function getExpenseCategory(Request $request) {
        $category = DB::table('expense_category')->where($request->all())->get();
        return response()->json($category);
    }

    public function getExpenseSubCategory(Request $request) {
        $subcategory = DB::table('expense_subcategory')->where($request->all())->get();
        return response()->json($subcategory);
    }

    public function getExpenseName(Request $request) {
        $name = DB::table('expense_name')->where($request->all())->get();
        return response()->json($name);
    }

    public function getPublicItem(Request $request) {
        $item = DB::table('expense_item')->where($request->all())->get();
        return response()->json($item);
    }
}
