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

    public function getSubCategory(Request $request) {
        $subcategory = DB::table('item_subcategory')->where($request->all())->get();
        return response()->json($subcategory);
    }
}
